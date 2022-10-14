import { NestedTreeControl } from '@angular/cdk/tree';
import { HttpErrorResponse, HttpParams } from '@angular/common/http';
import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { MatTreeNestedDataSource } from '@angular/material/tree';
import { Categories } from 'src/app/models/categories';
import { Product } from 'src/app/models/product';
import { ProductsService } from 'src/app/services/products.service';
import { ProductsComponent } from '../products.component';

@Component({
  selector: 'app-filters',
  templateUrl: './filters.component.html',
  styleUrls: ['./filters.component.scss']
})
export class FiltersComponent implements OnInit  {


  protected treeControl = new NestedTreeControl<Categories>(category => category.children);
  protected filtersData = new MatTreeNestedDataSource<Categories>();

  @Output() productsUpdate = new EventEmitter<Product[]>();

  private selectedFilters : {
    maxPrice?: number,
    Colors?: [],
    Categories?:[],
    Sizes?:[],
  } ={}


  
  constructor(protected productsService : ProductsService) {
  }

  ngOnInit(): void {

    //fetching products
      this.productsService.getCategories().subscribe({
          next :(result) => {
            this.filtersData.data = this._processData(result);
          },
          error :(e : HttpErrorResponse) => console.error(e.error.text)
        })
  }

  hasChild = (_: number, node: Categories) => !!node.children && node.children.length > 0;

  _processData(data, parent = null) {
    data.forEach((item:any) => {
      if (parent !== null) {
        item.parent = {name: parent.name};
      } else {
        item.parent = null;
      }
      if (item.children) {
        this._processData(item.children, item);
      }
    });
    return data;
  }

  formatLabel(value: number) {
    if (value >= 1000) {
      return Math.round(value / 1000) + 'k';
    }

    return value;
  }
  updateMaxPrice(event) {
    this.selectedFilters.maxPrice = event.value;
  }

  selectFilter(filter:string, parent:string){
    //we add [] so we can send lists as query params
    parent = parent +'[]'
    if (this.selectedFilters[parent]){
        this.selectedFilters[parent].includes(filter) ?
          this.selectedFilters[parent].splice(this.selectedFilters[parent].indexOf(filter),1):
          this.selectedFilters[parent].push(filter);
    }
    else
      this.selectedFilters[parent]=[filter]

    if (this.selectedFilters[parent].length == 0)
      delete this.selectedFilters[parent]
  }

  updateProducts(){
    console.log(this.selectedFilters)
    let queryParams = new HttpParams({ fromObject: this.selectedFilters }); 
    this.productsService.getProducts(queryParams).subscribe({
      next:((results)=>{
        this.productsUpdate.emit(results)
      }),
      error :(e : HttpErrorResponse) => console.error(e.error.text)
    })
  }
}

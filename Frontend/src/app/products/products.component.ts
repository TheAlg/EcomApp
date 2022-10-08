import { NestedTreeControl } from '@angular/cdk/tree';
import { HttpErrorResponse } from '@angular/common/http';
import { Target } from '@angular/compiler';
import { Component, OnInit, ViewChild } from '@angular/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTreeNestedDataSource } from '@angular/material/tree';
import { Categories } from '../models/Categories';
import { Product } from '../models/product';
import { ProductsService } from '../services/products.service';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.scss']
})
export class ProductsComponent implements OnInit {

  public products: Product[] =[];
  pageSize = 10;
  productsLength:number;
  paginatorData = [];


  constructor(protected productsService : ProductsService) {}

  ngOnInit() {
      this.productsService.getProducts().subscribe({
        next:((results:Product[])=>{
          this.products = results
          this.productsLength = results.length;
          this.paginatorData = this.products.slice(0,this.pageSize);
        }),
        error :(e : HttpErrorResponse) => console.error(e.error.text)
      })
      
  }

  onPageChanged(e : PageEvent) {
    let firstCut = e.pageIndex * e.pageSize;
    let secondCut = firstCut + e.pageSize;
    this.paginatorData = this.products.slice(firstCut, secondCut);
  } 

  updateProducts(productList: Product[]) {
    this.products = productList
    this.productsLength = productList.length;
    this.paginatorData = this.products.slice(0,this.pageSize);
}
}









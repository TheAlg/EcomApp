import { HttpErrorResponse } from '@angular/common/http';
import { Component, OnInit, ViewChild } from '@angular/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { Product } from '../models/product';
import { CartService } from '../services/cart.service';
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

  loader :Promise<boolean>;


  constructor(
    protected productsService : ProductsService,
    protected cartService : CartService
    ) {}

  ngOnInit() {
      this.productsService.getProducts().subscribe({
        next:((results:Product[])=>{
          this.products = results
          this.productsLength = results.length;
          this.paginatorData = this.products.slice(0,this.pageSize);
          this.loader = Promise.resolve(true)
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









import { HttpClient, HttpErrorResponse, HttpHeaders, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Categories } from '../models/categories';
import { Product } from '../models/product';
import { API } from '../config/api';  


@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  constructor(private http: HttpClient) 
  {  }


  getProducts(queryParams?:HttpParams) : Observable<Product[]>
  {
    return this.http.get<Product[]>(API.products.products, {params:queryParams,responseType: 'json'})
  }
  
  getCategories() : Observable<Categories[]>
  {
    return this.http.get<Categories[]>(API.products.categories, {responseType: 'json'})

  }
}

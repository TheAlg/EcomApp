import { HttpClient, HttpErrorResponse, HttpHeaders, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Categories } from '../models/categories';
import { Product } from '../models/product';

@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  private products : Product[];
  private categories : Categories[] =[];

  constructor(private http: HttpClient) 
  {  }


  getProducts(queryParams?:HttpParams) : Observable<Product[]>
  {
    return this.http.get<Product[]>('http://localhost:8000/api/v1/items', 
                  {params:queryParams,responseType: 'json'})
  }
  
  getCategories() : Observable<Categories[]>
  {
    return this.http.get<Categories[]>('http://localhost:8000/api/v1/categories', {responseType: 'json'})

  }
}

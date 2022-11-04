import { HttpErrorResponse } from '@angular/common/http';
import { Component, OnInit, ViewChild } from '@angular/core';
import { CartService } from '../services/cart.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.scss']
})
export class CartComponent implements OnInit {

  constructor( protected cartService : CartService ) { }

  loader: Promise<boolean>;

  cart :any ={
    content:[]=[],
  };

  ngOnInit(): void {
    this.cartService.getContent().subscribe({
      next:((results:any)=>{
        this.cart = results;
        this.loader = Promise.resolve(true);
      }),
      error :(e : HttpErrorResponse) => console.error(e.error.text)
    })
  }

  remove(id:number){
    this.cartService.remove(id).subscribe({
      next:(results) => {
        this.cart = results;
      },
      error:(err: HttpErrorResponse) => {
        console.error( err.error.text) //servers response
      }
    })
    
  }



}

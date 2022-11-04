import { Component, OnInit } from '@angular/core';
import { CheckoutService } from 'src/app/services/checkout.service';

@Component({
  selector: 'app-checkout-card',
  templateUrl: './checkout-card.component.html',
  styleUrls: ['./checkout-card.component.scss']
})
export class CheckoutCardComponent implements OnInit {

  constructor(private checkout : CheckoutService) { }

  totalPrice :number;
  count : number;
  shippingFees:number;

  ngOnInit(): void {
    this.checkout.getContent().subscribe(
      (response:any) => {
        this.shippingFees = response.shipping
        this.totalPrice = response.total;
        this.count = response.count
      }
    )
  }

}

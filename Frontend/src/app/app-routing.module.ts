import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CartComponent } from './cart/cart.component';
import { CheckoutFormComponent } from './checkout/checkout-form/checkout-form.component';
import { IndexComponent } from './index/index.component';
import { ProductsComponent } from './products/products.component';


const routes: Routes = [    
  {
    path: '',
    component: IndexComponent
  },
  {
    path: 'products',
    component: ProductsComponent
  },
  {
    path: 'cart',
    component: CartComponent
  },
  {
    path: 'checkout',
    component: CheckoutFormComponent
  },
]



@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

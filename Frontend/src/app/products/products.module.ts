import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProductsComponent } from './products.component';
import { ProductsRoutingModule } from './products-routing.module';
import { AngularMaterialModule } from '../angular-material.module';
import { FiltersComponent } from './filters/filters.component';



@NgModule({
  declarations: [
    ProductsComponent,
    FiltersComponent
  ],
  imports: [
    CommonModule,
    ProductsRoutingModule,
    AngularMaterialModule
  ]
})
export class ProductsModule { }

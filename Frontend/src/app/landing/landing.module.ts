
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';


import { FaqPageComponent } from './components/faq-page/faq-page.component';


const COMPONENTS = [
  FaqPageComponent,
];

@NgModule({
  imports: [
    CommonModule,
  ],
  declarations: [...COMPONENTS]
})
export class LandingModule {}

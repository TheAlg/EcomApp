import { MediaMatcher } from '@angular/cdk/layout';
import { Component, ViewChild } from '@angular/core';
import { MatSidenav } from '@angular/material/sidenav';
import { User } from './models/user';
import { AuthService } from './services/auth.service';
import { CartService } from './services/cart.service';
import { SharedService } from './services/shared.service';



@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls :['./app.component.scss']
}) 
export class AppComponent {

  title = 'AngularEcomm';

  public mobileQuery: MediaQueryList;

  public User: User | Boolean;
  public cart: any;


  @ViewChild('snav') public sidenav: MatSidenav;

  constructor(

    private sidenavService: SharedService,
    private media : MediaMatcher,
    private userService : AuthService,
    private cartService : CartService
    
    ) 
  { 
    this.mobileQuery = this.media.matchMedia('(max-width: 600px)');



  }
  
  ngAfterViewInit(): void {
    this.sidenavService.setSidenav(this.sidenav);
  }

  





}

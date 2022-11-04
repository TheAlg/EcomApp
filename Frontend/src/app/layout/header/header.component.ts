import { Component, OnInit } from '@angular/core';
import { User } from 'src/app/models/user';
import { AuthService } from 'src/app/services/auth.service';
import { CartService } from 'src/app/services/cart.service';
import { SharedService } from 'src/app/services/shared.service';
import { UserService } from 'src/app/services/user.service';


@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {


  User:User | Boolean;
  Cart: any;

  
  constructor(
    private sharedService : SharedService,
    private authService : AuthService,
    private userService : UserService,
    public cartService : CartService,
    ) {
  }

  ngOnInit() {
      //user data
      this.userService.getSession().subscribe(
        (user:User | Boolean) => this.User = user)
  
      //cart data
      this.cartService.getContent().subscribe(
        (value:any)=> {
          this.Cart = value;
        }
      )
  }

  toggleMenu() {
    this.sharedService.toggle();
  }

  logout() {
   // this.User = false;
    this.authService.logout();
    }

}

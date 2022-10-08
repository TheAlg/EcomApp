import { Component, Injector, OnInit, ViewChild } from '@angular/core';
import { AppComponent } from 'src/app/app.component';
import { SharedService } from 'src/app/services/shared.service';


@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {


  constructor(private sharedService : SharedService) {
  }

  ngOnInit() {}

  toggleMenu() {
    this.sharedService.toggle();
  }

}

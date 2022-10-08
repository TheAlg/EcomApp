import { MediaMatcher } from '@angular/cdk/layout';
import { ChangeDetectorRef, Component, Injector, ViewChild } from '@angular/core';
import { MatSidenav } from '@angular/material/sidenav';
import { Subject } from 'rxjs';
import { SharedService } from './services/shared.service';



@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls :['./app.component.scss']
}) 
export class AppComponent {

  title = 'AngularEcomm';

  protected _unsubscribe$: Subject<void> = new Subject();
  public mobileQuery: MediaQueryList;



  @ViewChild('snav') public sidenav: MatSidenav;

  constructor(

    private sidenavService: SharedService,
    private media : MediaMatcher,
    private changeDetectorRef : ChangeDetectorRef,
    
    ) 
  { 
    this.mobileQuery = this.media.matchMedia('(max-width: 600px)');
  }
  
  ngAfterViewInit(): void {
    this.sidenavService.setSidenav(this.sidenav);
  }

  





}

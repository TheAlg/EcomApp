import { Injectable } from '@angular/core';
import { Observable, of, timer  } from 'rxjs';
import { mergeMap } from 'rxjs/operators'
import { PreloadingStrategy, Route } from '@angular/router';


@Injectable()
export class AppPreloadingStrategy implements PreloadingStrategy {
  preload(route: Route, loadMe: () => Observable<any>): Observable<any> {

  if (route.data && route.data['preload']) {

    var delay:number=route.data['delay']

    console.log('preload called on '+route.path+' delay is '+delay);
    return timer(delay).pipe(
      mergeMap( _ => {
        console.log("Loading now "+ route.path + 'just to verify this value x :'+  _ + 'with this one ' + delay);
        return loadMe() ;
        }
      )
    );
  } 
  else 
    {
      console.log('no preload for the path '+ route.path);
      return of(null);
    }
  }
}
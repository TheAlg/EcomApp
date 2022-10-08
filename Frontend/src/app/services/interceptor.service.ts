import { HttpEvent, HttpHandler, HttpInterceptor, HttpRequest, HttpResponse } from '@angular/common/http';
import {Injectable} from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';


@Injectable()
export class MultipartInterceptService implements HttpInterceptor {


 private parseData(multipart: string, boundary: string): any {

    const dataArray: string[] = multipart.split(` — ${boundary}`);
    dataArray.shift();
    dataArray.map((dataBlock: string) => {
       const rowsArray = dataBlock.split(/\r?\n/).filter(Boolean);
       const image = rowsArray.splice(3, rowsArray.length);
       if (image.length < 1) {
          return;
       }
    const headers = dataBlock.split(/\r?\n/).splice(1, 4).filter(Boolean);
 if (headers.length > 1) {
    const pattern = /Content-Type: ([a-z\/+]+)/g;
    const match = pattern.exec(headers[1]);
    if (match === null) {
       throw new Error('Unable to find Content-Type header value');
    }
    const contentType = match[1];
    if (contentType === 'application/pdf') {
     // do smt
     } else if (contentType === 'image/svg+xml') {
     // do smt
    }
   }
 }); 
 }
private parseResponse(response: HttpResponse<any>): HttpResponse<any> {

 const contentTypeHeaderValue = response.headers.get('Content-Type');
 const body = response.body;
 const contentTypeArray = contentTypeHeaderValue ? contentTypeHeaderValue.split(';') : [];
 const contentType = contentTypeArray[0];

 switch (contentType) {
    case 'multipart/form-data':
    if (!body) {
       return response.clone({ body: {} });
    }
   const boundary = body?.split(' — ')[1].split('\r')[0];
   const parsed = this.parseData(body, boundary);
 if (parsed === false) {
    throw new Error('Unable to parse multipart response');
 }
    return response.clone({ body: parsed });
 default:
    return response;
 }
 }
// intercept request and add parse custom response
 public intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
 return next.handle(request).pipe(
    map((response: HttpResponse<any>) => {
    if (response instanceof HttpResponse) {
    return this.parseResponse(response);
    }
   })
 );
 }
}
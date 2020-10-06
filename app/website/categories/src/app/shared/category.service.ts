import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Category } from './category';
import { Observable, throwError } from 'rxjs';
import { retry, catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class CategoryService {
  // Base url
  baseurl = 'http://localhost:8080';

  constructor(private http: HttpClient) { }

  GetList(page?, filterName?): Observable<any> {
    let params = new HttpParams();

    if (page != '') {
      params = params.append('offset', page);
    }

    if (filterName != '') {
      params = params.append('filterName', filterName);
    }

    return this.http.get<Observable<any>>(this.baseurl + '/category', {params})
    .pipe(
      retry(1),
      catchError(this.errorHandl)
    )
  }

  Create(name: string): Observable<Object> {
    return this.http.post(this.baseurl + '/category', {name: name});
  }

  Update(id: number, name: string): Observable<Object> {
    return this.http.patch(this.baseurl + '/category/' + id, {name: name});
  }

  Delete(id): Observable<Object> {
    return this.http.delete(this.baseurl + '/category/' + id);
  }

  errorHandl(error) {
    let errorMessage = '';
    if(error.error instanceof ErrorEvent) {
      // Get client-side error
      errorMessage = error.error.message;
    } else {
      // Get server-side error
      errorMessage = `Message: ${error.message}`;
    }
    console.log(errorMessage);
    return throwError(errorMessage);
 }
}

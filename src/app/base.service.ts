import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class BaseService {
  host = 'http://127.0.0.1:8000/api/products';
  constructor(private http: HttpClient) { }

  getProducts() {
    return this.http.get<any>(this.host);
  }
}

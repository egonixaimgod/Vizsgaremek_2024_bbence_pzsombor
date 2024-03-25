import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class BaseService {
  host = 'http://localhost:8000/api/';
  constructor(private http: HttpClient) { }

  getProducts() {
    let endpoint = 'products';
    let url = this.host + endpoint;

    return this.http.get<any>(url);
  }
}

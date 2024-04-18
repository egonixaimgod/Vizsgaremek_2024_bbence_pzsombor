import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  private apiUrl = 'http://127.0.0.1:8000/api/products'; // Az API URL-je, ahonnan a termékekkel kapcsolatos adatokat kérjük

  constructor(private http: HttpClient) { }

  // Termék lekérdezése azonosító alapján
  getProductById(id: number): Observable<any> {
    const url = `${this.apiUrl}/${id}`;
    return this.http.get<any>(url);
  }

  // Termék frissítése
  updateProduct(id: number, updatedProduct: any): Observable<any> {
    const url = `${this.apiUrl}/${id}`;
    return this.http.put<any>(url, updatedProduct);
  }

  // Egyéb metódusok a termékekkel kapcsolatos műveletekhez, pl. termék létrehozása, törlése, stb.
}

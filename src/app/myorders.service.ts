// order.service.ts
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';
import { AuthService } from './auth.service'; // AuthService importálása

@Injectable({
  providedIn: 'root'
})
export class MyordersService {
  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient, private authService: AuthService) { }

  getOrders(): Observable<any[]> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.authService.token}` // Bearer token hozzáadása
      })
    };

    return this.http.get<any[]>(`${this.apiUrl}/showOrders`, httpOptions).pipe(
      map((response: any[]) => {
        console.log('A rendelések sikeresen lekérve:', response);
        return response;
      }),
      catchError((error: any) => {
        console.error('A rendelések lekérése sikertelen:', error);
        return of([]); // Üres tömb visszaadása hibás esetben
      })
    );
  }

  // További metódusok implementálása itt
}

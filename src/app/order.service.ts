import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AuthService } from './auth.service';
import { HttpHeaders } from '@angular/common/http';
import { catchError, map } from 'rxjs/operators';
import { Observable, of } from 'rxjs'; 

@Injectable({
  providedIn: 'root'
})
export class OrderService {
  public userData: any = {}


  constructor(private http: HttpClient, public authService: AuthService) { }

  
  
  order(userData: any): Observable<boolean> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.authService.token}`
      })
    };
  
    return this.http.post('http://127.0.0.1:8000/api/placeOrder', userData, httpOptions).pipe(
      map((response: any) => {
        console.log('A rendelés sikeres:', response);
        alert("A rendelés sikeres!");
        this.userData = response;
        return true; // Visszatérünk a rendelés sikerességével
      }),
      catchError((error: any) => {
        console.error('A rendelés sikertelen:', error);
        alert("A rendelés sikertelen!");
        this.userData = {};
        return of(false); // Visszatérünk a rendelés sikertelenségével
      })
    );
  }

  getOrders(): Observable<any[]> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.authService.token}` // Include access token in header
      })
    };

    return this.http.get('http://127.0.0.1:8000/api/showOrders', httpOptions).pipe(
      map((response: any) => {
        console.log('A rendelések sikeresen lekérve:', response);
        return response.orders;
      }),
      catchError((error: any) => {
        console.error('A rendelések lekérése sikertelen:', error);
        return of([]);
      })
    );
  }
}

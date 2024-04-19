import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';
import { AuthService } from './auth.service';
import { throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class MyordersitemsService {
  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient, private authService: AuthService) { }

  getOrders(orderId: number): Observable<any[]> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.authService.token}`
      })
    };

    return this.http.get<any[]>(`${this.apiUrl}/showOrderItems/${orderId}`, httpOptions).pipe(
      map((response: any[]) => {
        console.log('A rendelések sikeresen lekérve:', response);
        return response;
      }),
      catchError((error: any) => {
        console.error('A rendelések lekérése sikertelen:', error);
        return of([]);
      })
    );
  }
  deleteOrderItem(orderId: number): Observable<any> {
    const httpOptions = {
        headers: new HttpHeaders({
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${this.authService.token}`
        })
    };

    return this.http.delete<any>(`${this.apiUrl}/deleteOrder/${orderId}`, httpOptions).pipe(
        map((response: any) => {
            console.log('A termék sikeresen törölve a rendelésből:', response);
            return response;
        }),
        catchError((error: any) => {
            console.error('Hiba történt a termék törlése közben:', error);
            return throwError('Valami hiba történt a termék törlése közben.');
        })
    );
}

}

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AuthService } from './auth.service';
import { HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class OrderItemsService {
  public userDataItems: any = {}


  constructor(private http: HttpClient, public authService: AuthService) { }

  
  orderItems(userDataItems: any) {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.authService.token}`
      })
    };

    this.http.post('http://127.0.0.1:8000/api/order_items', userDataItems, httpOptions).subscribe(
      {

        next: (response: any) => {

          console.log('A rendelés sikeres:', response);
          alert("A rendelés sikeres!");
          this.userDataItems = response
        },

        error:
          (error: any) => {
            console.error('A rendelés sikertelen:', error);
            alert("A rendelés sikertelen!");
            this.userDataItems = {}
          }
      })
  }
}

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class OrderItemsService {
  public userDataItems: any = {}

  constructor(private http: HttpClient) { }
  orderItems(userDataItems: any) {
    this.http.post('http://127.0.0.1:8000/api/order_items', userDataItems).subscribe(
      {

        next: (response: any) => {
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

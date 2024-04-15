import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class OrderService {
  public userData: any = {}


  constructor(private http: HttpClient) { }
  order(userData: any) { 
    this.http.post('http://127.0.0.1:8000/api/orders', userData).subscribe(
      {

        next: (response: any) => {

          console.log('A rendelés sikeres:', response);
          alert("A rendelés sikeres!");
          this.userData = response
        },

        error:
          (error: any) => {
            console.error('A rendelés sikertelen:', error);
            alert("A rendelés sikertelen!");
            this.userData = {}
          }
      })
  }
}

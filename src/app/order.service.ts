import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AuthService } from './auth.service';
import { HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class OrderService {
  public userData: any = {}


  constructor(private http: HttpClient, public authService: AuthService) { }

  
  order(userData: any) { 
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.authService.token}`
      })
    };

    this.http.post('http://127.0.0.1:8000/api/placeOrder', userData, httpOptions).subscribe(
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

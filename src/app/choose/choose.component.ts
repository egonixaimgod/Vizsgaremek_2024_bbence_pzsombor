import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { OrderService } from '../order.service';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-choose',
  templateUrl: './choose.component.html',
  styleUrls: ['./choose.component.css']
})
export class ChooseComponent {
   
  userData: any = {
    payment_id: '13',
    order_date: '2024-12-12'
  };

  constructor(private http: HttpClient, public OrderService: OrderService, private AuthService: AuthService) { }

  order() {
    if (this.AuthService.isLoggedIn == true) {
      this.userData.customer_id = this.AuthService.userData.data.id;
      this.OrderService.order(this.userData);
      alert("A rendelés sikeres!");
    } else {
      alert("Kérjük jelentkezzen be!");
    }
  }
}

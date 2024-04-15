import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { OrderService } from '../order.service';


@Component({
  selector: 'app-myorders',
  templateUrl: './myorders.component.html',
  styleUrls: ['./myorders.component.css']
})
export class MyordersComponent {
  userData = {
    customer_id: '123',
    payment_id: '13',
    order_date: '2024-04-15'
  }
  constructor(private http: HttpClient, public OrderService: OrderService) { }
  order() {
    this.OrderService.order(this.userData)
  }
}

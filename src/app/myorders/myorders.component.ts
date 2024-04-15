import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { OrderService } from '../order.service';
import { OrderItemsService } from '../order-items.service';


@Component({ 
  selector: 'app-myorders',
  templateUrl: './myorders.component.html',
  styleUrls: ['./myorders.component.css']
})

export class MyordersComponent {
  constructor (public OrderService: OrderService, public OrderItemsService: OrderItemsService) {}
}


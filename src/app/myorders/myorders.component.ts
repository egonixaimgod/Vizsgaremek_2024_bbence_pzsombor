// myorders.component.ts

import { Component, OnInit } from '@angular/core';
import { MyordersService } from '../myorders.service';
import { MyordersitemsService } from '../myordersitems.service';

@Component({
  selector: 'app-myorders',
  templateUrl: './myorders.component.html',
  styleUrls: ['./myorders.component.css']
})
export class MyordersComponent implements OnInit {
  orders1: any[] = [];
  orders2: any = {};

  constructor(
    private myordersservice: MyordersService,
    private myordersitemsservice: MyordersitemsService
  ) { }

  ngOnInit(): void {
    this.loadOrders1();
  }

  loadOrders1() {
    this.myordersservice.getOrders().subscribe({
      next: (orders: any[]) => {
        this.orders1 = orders;
        console.log('A rendelések sikeresen lekérve:', this.orders1);
        if (this.orders1.length > 0) {
          this.orders1.forEach(order => {
            this.loadOrders2(order.id);
          });
        }
      },
      error: (error: any) => {
        console.error('Hiba történt a rendelések lekérése közben:', error);
      }
    });
  }

  loadOrders2(orderId: number) {
    this.myordersitemsservice.getOrders(orderId).subscribe({
      next: (orders: any[]) => {
        this.orders2[orderId] = orders;
        console.log('A rendeléshez tartozó termékek sikeresen lekérve:', this.orders2[orderId]);
      },
      error: (error: any) => {
        console.error('Hiba történt a termékek lekérése közben:', error);
      }
    });
  }
}

// myproducts.component.ts
import { Component, OnInit } from '@angular/core';
import { MyordersService } from '../myorders.service';

@Component({
  selector: 'app-myorders',
  templateUrl: './myorders.component.html',
  styleUrls: ['./myorders.component.css']
})
export class MyordersComponent implements OnInit {
  orders1: any[] = []; // Tömb az rendelések tárolására

  constructor(private myordersservice: MyordersService) { }

  ngOnInit(): void {
    this.loadOrders1();
  }

  loadOrders1() {
    this.myordersservice.getOrders().subscribe({
      next: (orders: any[]) => {
        this.orders1 = orders;
        console.log('A rendelések sikeresen lekérve:', this.orders1);
      },
      error: (error: any) => {
        console.error('Hiba történt a rendelések lekérése közben:', error);
      }
    });
  }
}

import { Component, OnInit, ChangeDetectorRef } from '@angular/core';
import { OrderService } from '../order.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-myorders',
  templateUrl: './myorders.component.html',
  styleUrls: ['./myorders.component.css']
})
export class MyordersComponent implements OnInit {
  orders$: Observable<any[]> | null = null;
  constructor(public orderService: OrderService, private cdr: ChangeDetectorRef) { }

  orders: any[] = []; 

  ngOnInit(): void {
    this.orders$ = this.orderService.getOrders();
  }

  loadOrders() {
    this.orderService.getOrders().subscribe({
      next: (orders: any[]) => {
        this.orders = orders; 
        this.cdr.detectChanges(); 
      },
      error: (error: any) => {
        console.error('Hiba történt a rendelések lekérése közben:', error);
      }
    });
  }
}

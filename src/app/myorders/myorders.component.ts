// myorders.component.ts
import { Component, OnInit, ChangeDetectorRef } from '@angular/core'; // Import ChangeDetectorRef
import { OrderService } from '../order.service';

@Component({ 
  selector: 'app-myorders',
  templateUrl: './myorders.component.html',
  styleUrls: ['./myorders.component.css']
})
export class MyordersComponent implements OnInit {
  constructor(public orderService: OrderService, private cdr: ChangeDetectorRef) {} // Inject ChangeDetectorRef

  ngOnInit(): void {
    this.loadOrders();
  }

  loadOrders() {
    this.orderService.getOrders().subscribe(
      (orders: any) => {
        console.log('A rendelések sikeresen lekérve:', orders); // Log orders to verify data
        this.orderService.userData = orders.data; // Assuming orders is an object containing the data array
        this.cdr.detectChanges(); // Manually trigger change detection
      },
      (error: any) => {
        console.error('Hiba történt a rendelések lekérése közben:', error);
      }
    );
  }
}

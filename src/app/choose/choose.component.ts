import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { OrderService } from '../order.service';
import { AuthService } from '../auth.service';
import { OrderItemsService } from '../order-items.service';

@Component({
  selector: 'app-choose',
  templateUrl: './choose.component.html',
  styleUrls: ['./choose.component.css']
})
export class ChooseComponent {
   
  userData: any = {
    payment_id: 1,
  };

  userDataItems:any = {
    order_id: 1,
    product_id: 6,
    amount: 88
  }

  constructor(private http: HttpClient, public OrderService: OrderService, private AuthService: AuthService, public OrderItemsService: OrderItemsService) { }

  updatePaymentId(): void {
    // Ha a Futárszolgálat van kiválasztva, akkor payment_id legyen 1, egyébként 2
    this.userData.payment_id = (this.deliveryMethod === 'futarszolgalat') ? 1 : 2;
  }

  deliveryMethod: string = 'futarszolgalat';

  onDeliveryMethodChange(method: string): void {
    this.deliveryMethod = method;
    this.updatePaymentId();
  }
  
  order() {
    if (this.AuthService.isLoggedIn == true) {
      this.userData.customer_id = this.AuthService.userData.data.id;
      this.OrderService.order(this.userData);
      alert("A rendelés sikeres!");
    } else {
      alert("Kérjük jelentkezzen be!");
    }
  }

  order2() {
    if (this.AuthService.isLoggedIn) {
      this.OrderItemsService.orderItems(this.userDataItems);
    } else {
      alert("Kérjük jelentkezzen be!");
    }
  }
  
}

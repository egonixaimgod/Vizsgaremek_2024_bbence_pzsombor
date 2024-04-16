import { Component } from '@angular/core';
import { OrderService } from '../order.service';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-choose',
  templateUrl: './choose.component.html',
  styleUrls: ['./choose.component.css']
})
export class ChooseComponent {
   
  userData: any = {
    "azonosito": 1,
    "payment_id": 1,
    "items": [
      {
        "product_id": 6,
        "amount": 2
      },
      {
        "product_id": 3,
        "amount": 1
      },
      {
        "product_id": 2,
        "amount": 3
      }
    ]
  };

  deliveryMethod: string = 'futarszolgalat';

  constructor(private orderService: OrderService, private authService: AuthService) { }

  updatePaymentId(): void {
    // Ha a Futárszolgálat van kiválasztva, akkor payment_id legyen 1, egyébként 2
    this.userData.payment_id = (this.deliveryMethod === 'futarszolgalat') ? 1 : 2;
  }

  onDeliveryMethodChange(method: string): void {
    this.deliveryMethod = method;
    this.updatePaymentId();
  }
  
  order() {
    // Generálj egy random számot 1000 és 10000 között
    const azonosito = Math.floor(Math.random() * (10000 - 1000 + 1)) + 1000;

    // Állítsd be az "azonosito" értékét a userData objektumban
    this.userData.azonosito = azonosito;

    if (this.authService.isLoggedIn == true) {
      this.orderService.order(this.userData);
      alert("A rendelés sikeres!");
    } else {
      alert("Kérjük jelentkezzen be!");
    }
  }
}

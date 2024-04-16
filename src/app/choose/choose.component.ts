import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { OrderService } from '../order.service';
import { AuthService } from '../auth.service';
import { CartService } from '../cart.service';

@Component({
  selector: 'app-choose',
  templateUrl: './choose.component.html',
  styleUrls: ['./choose.component.css']
})
export class ChooseComponent {
   
  userData: any = {
    "azonosito": 1,
    "payment_id": 1,
    "items": [] // Kezdetben üres tömb
  };

  constructor(private http: HttpClient, public OrderService: OrderService, private AuthService: AuthService, public CartService: CartService) { }

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
    // Generálj egy random számot 1000 és 10000 között
    const azonosito = Math.floor(Math.random() * (10000 - 1000 + 1)) + 1000;

    // Állítsd be az "azonosito" értékét a userData objektumban
    this.userData.azonosito = azonosito;

    // Kosár tartalmának lekérése
    const cartItems = this.CartService.getCartItems();

    // Kosár tartalmának beállítása a userData objektumba
    this.userData.items = cartItems.map(item => {
      return {
        product_id: item.id,
        amount: item.amount
      };
    });

    if (this.AuthService.isLoggedIn == true) {
      // Itt már nincs szükség paraméterként átadni a userData-t, mivel az már tartalmazza a kosár tartalmát
      this.OrderService.order(this.userData);
      alert("A rendelés sikeres!");
    } else {
      alert("Kérjük jelentkezzen be!");
    }
  }
  
}
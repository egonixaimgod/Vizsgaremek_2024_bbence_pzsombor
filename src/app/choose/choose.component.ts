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
    "items": []
  };

  constructor(private http: HttpClient, public OrderService: OrderService, private AuthService: AuthService, public CartService: CartService) { }

  updatePaymentId(): void {
    this.userData.payment_id = (this.deliveryMethod === 'futarszolgalat') ? 1 : 2;
  }

  deliveryMethod: string = 'futarszolgalat';

  onDeliveryMethodChange(method: string): void {
    this.deliveryMethod = method;
    this.updatePaymentId();
  }

  order() {
    const azonosito = Math.floor(Math.random() * (10000 - 1000 + 1)) + 1000;
  
    this.userData.azonosito = azonosito;
  
    const cartItems = this.CartService.getCartItems();
  
    this.userData.items = cartItems.map(item => {
      return {
        product_id: item.id,
        amount: item.amount
      };
    });
  
    if (this.AuthService.isLoggedIn) {
      this.OrderService.order(this.userData).subscribe((success: boolean) => {
        if (success) {
          this.CartService.clearCart(); 
          
        }
      });
    } else {

    }
  }
}
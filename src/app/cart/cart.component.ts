import { Component } from '@angular/core';
import { CartService } from '../cart.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent {
  cartItems: any[];
  totalPrice: number = 0;

  constructor(private cartService: CartService) {
    this.cartItems = this.cartService.getCartItems();
    this.calculateTotalPrice();
  }

  generateImagePath(productName: string): string {
    return `assets/images/${productName}.jpg`;
  }

  removeFromCart(index: number): void {
    this.cartService.removeFromCart(index);
    this.calculateTotalPrice();
  }

  calculateTotalPrice(): void {
    this.totalPrice = this.cartItems.reduce((total, item) => total + (parseInt(item.cost) * item.amount), 0);
  }

  next() { alert("Válasszon szállítási módot!"); }
}

import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private cartItems: any[] = [];

  addToCart(item: any, quantity: number = 1): void {
    const index = this.cartItems.findIndex(cartItem => cartItem.name === item.name);

    if (index !== -1) {
      this.cartItems[index].amount += quantity;
    } else {
      this.cartItems.push({ ...item, amount: quantity });
    }
  }

  getCartItems(): any[] {
    return this.cartItems;
  }

  removeFromCart(index: number): void {
    this.cartItems.splice(index, 1);
  }

  clearCart(): void {
    this.cartItems = [];
  }
  
}


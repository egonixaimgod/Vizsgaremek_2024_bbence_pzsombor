import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private cartItems: any[] = [];

  addToCart(item: any, quantity: number = 1): void {
    // Ellenőrizzük, hogy az adott elem már van-e a kosárban
    const index = this.cartItems.findIndex(cartItem => cartItem.name === item.name);
    
    if (index !== -1) {
      // Ha már van ilyen elem a kosárban, csak növeljük a mennyiséget
      this.cartItems[index].amount += quantity;
    } else {
      // Ha még nincs az adott elem a kosárban, hozzáadjuk
      this.cartItems.push({ ...item, amount: quantity });
    }
  }

  getCartItems(): any[] {
    return this.cartItems;
  }

  removeFromCart(index: number): void {
    this.cartItems.splice(index, 1);
  }
}

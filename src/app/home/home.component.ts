import { Component, OnInit } from '@angular/core';
import { BaseService } from '../base.service';
import { CartService } from '../cart.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  products: any;
  constructor(private api: BaseService, private cartService: CartService) { }

  ngOnInit(): void {
    this.getProducts();
  }
  getProducts() {
    this.api.getProducts().subscribe({
      next: data => {
        this.products = data;
      },
      error: err => {
        console.log('Hiba! A dolgozók letöltése sikertelen!');
      }
    });
  }
  generateImagePath(productName: string): string {
    return `assets/images/${productName}.jpg`;
  }

  onAddToCart(product: any): void {
    this.cartService.addToCart(product);
  }

}

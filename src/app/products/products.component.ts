import { Component, OnInit } from '@angular/core';
import { BaseService } from '../base.service';
import { CartService } from '../cart.service';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {
  products: any;
  quantities: number[] = []; // új sor
  constructor(private api: BaseService, private cartService: CartService) { }

  ngOnInit(): void {
    this.getProducts();
  }
  getProducts() {
    this.api.getProducts().subscribe({
      next: data => {
        this.products = data;
        this.quantities = new Array(this.products.length).fill(1); // új sor
      },
      error: err => {
        console.log('Hiba! A dolgozók letöltése sikertelen!');
      }
    });
  }
  generateImagePath(productName: string): string {
    return `assets/images/${productName}.jpg`;
  }

  onAddToCart(product: any, quantity: number): void {
    this.cartService.addToCart(product, quantity);
  }

}
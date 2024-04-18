import { Component, OnInit } from '@angular/core';
import { BaseService } from '../base.service';
import { CartService } from '../cart.service';
import { HttpClient } from '@angular/common/http';
import { AuthService } from '../auth.service';

export interface Product {
  id:number;
  category_id: number;
  brand_id: number;
  name: string;
  cost: number;
  amount: number;
  description: string;
}

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {
  products: any;
  quantities: number[] = []; 
  newProduct: Product = {
    id:0,
    category_id: 0,
    brand_id: 0,
    name: '',
    cost: 0,
    amount: 0,
    description: '',
  };

  constructor(private api: BaseService, private cartService: CartService, private http: HttpClient, public AuthService: AuthService) { }

  ngOnInit(): void {
    this.getProducts();
  }

  getProducts() {
    this.api.getProducts().subscribe({
      next: data => {
        this.products = data;
        this.quantities = new Array(this.products.length).fill(1);
      },
      error: err => {
        console.log('Hiba! A dolgozók letöltése sikertelen!');
      },
    });
  }

  generateImagePath(productName: string): string {
    return `assets/images/${productName}.jpg`;
  }

  onAddToCart(product: any, quantity: number): void {
    this.cartService.addToCart(product, quantity);
  }

  addProduct(): void {
    this.http.post<any>(this.api.host, this.newProduct)
      .subscribe({
        next: (data) => {
          console.log('Termék sikeresen hozzáadva!', data);
        },
        error: (err) => {
          console.error('Hiba a termék hozzáadása közben:', err);
        },
      });
  }

  onDeleteProduct(product: Product): void {
    const url = `${this.api.host}/${product.id}`;
  
    this.http.delete<any>(url)
      .subscribe({
        next: () => {
          console.log('Termék sikeresen törölve!');
        },
        error: (err) => {
          console.error('Hiba a termék törlése közben:', err);
        },
      });
  }

}

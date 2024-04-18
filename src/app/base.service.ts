import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

export interface Product {
  id:number;
  category_id: number;
  brand_id: number;
  name: string;
  cost: number;
  amount: number;
  description: string;
}

@Injectable({
  providedIn: 'root'
})
export class BaseService {
  host = 'http://127.0.0.1:8000/api/products';
  private selectedProduct!: Product;

  constructor(private http: HttpClient) { }

  getProducts() {
    return this.http.get<any>(this.host);
  }

  setSelectedProduct(product: Product): void { // Új metódus hozzáadása
    this.selectedProduct = product;
  }

  getSelectedProduct(): Product { // Új metódus hozzáadása
    return this.selectedProduct;
  }
}

  import { Component, OnInit } from '@angular/core';
  import { BaseService } from '../base.service';
  import { CartService } from '../cart.service';
  import { HttpClient, HttpHeaders } from '@angular/common/http';
  import { AuthService } from '../auth.service';
  import { Router, RouterLink } from '@angular/router';
  
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

    constructor(private api: BaseService, private cartService: CartService, private http: HttpClient, public AuthService: AuthService, private router: Router) { }

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
      if (this.AuthService.isLoggedIn) {
        this.cartService.addToCart(product, quantity);
        this.router.navigate(['/cart']);
      }
        else {
          alert("Kérjük regisztráljon, illetve jelentkezzen be!")
        }
      
      
    }

    addProduct(): void {
      const httpOptions = {
        headers: new HttpHeaders({
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${this.AuthService.token}`
        })
      };
    
      this.http.post<any>(this.api.host, this.newProduct, httpOptions)
        .subscribe({
          next: (data) => {
            console.log('Termék sikeresen hozzáadva!', data);
            // Frissítés a products tömbben a hozzáadott termékkel
            this.products.push(data);
            // Reset the newProduct object for the form
            this.newProduct = {
              id: 0,
              category_id: 0,
              brand_id: 0,
              name: '',
              cost: 0,
              amount: 0,
              description: '',
            };
          },
          error: (err) => {
            console.error('Hiba a termék hozzáadása közben:', err);
          },
        });
    }
    

    onDeleteProduct(product: Product): void {
      const url = `${this.api.host}/${product.id}`;
      const httpOptions = {
        headers: new HttpHeaders({
          'Authorization': `Bearer ${this.AuthService.token}`
        })
      };
    
      this.http.delete<any>(url, httpOptions)
        .subscribe({
          next: () => {
            console.log('Termék sikeresen törölve!');
            // Termék törlése a products tömbből
            this.products = this.products.filter((p: Product) => p.id !== product.id);
          },
          error: (err) => {
            console.error('Hiba a termék törlése közben:', err);
          },
        });
    }
    

    editProduct(product: Product): void {
      this.api.setSelectedProduct(product);
    }

  }

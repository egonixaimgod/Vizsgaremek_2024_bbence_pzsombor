import { Component } from '@angular/core';
import { OnInit } from '@angular/core';
import { BaseService } from '../base.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../auth.service';

export interface Product {
  id: number;
  category_id: number;
  brand_id: number;
  name: string;
  cost: number;
  amount: number;
  description: string;
}

@Component({
  selector: 'app-product-edit',
  templateUrl: './product-edit.component.html',
  styleUrls: ['./product-edit.component.css']
})

export class ProductEditComponent implements OnInit {
  editedProduct!: Product;

  constructor(private api: BaseService, private http: HttpClient, private AuthService: AuthService) { }

  ngOnInit(): void {
    this.editedProduct = { ...this.api.getSelectedProduct() };
  }

  updateProduct(): void {
    const httpOptions = { // Definiáljuk a httpOptions objektumot
      headers: new HttpHeaders({
        'Authorization': `Bearer ${this.AuthService.token}`
      })
    };

    this.http.put<any>(`${this.api.host}/${this.editedProduct.id}`, this.editedProduct, httpOptions) // Adjuk hozzá a httpOptions objektumot a put kéréshez
      .subscribe({
        next: (data) => {
          console.log('Termék sikeresen frissítve!', data);
          alert("Termék sikeresen frissítve!");
        },
        error: (err) => {
          console.error('Hiba a termék frissítése közben:', err);
          alert('Hiba a termék frissítése közben:');
        },
      });
  }
}

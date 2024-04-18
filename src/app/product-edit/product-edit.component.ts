import { Component, OnInit } from '@angular/core';
import { BaseService } from '../base.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../auth.service';
import { Router } from '@angular/router';

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

  constructor(private api: BaseService, private http: HttpClient, private authService: AuthService, private router: Router) { }

  ngOnInit(): void {
    this.editedProduct = { ...this.api.getSelectedProduct() };
  }

  updateProduct(): void {
    const httpOptions = { // Definiáljuk a httpOptions objektumot
      headers: new HttpHeaders({
        'Authorization': `Bearer ${this.authService.token}`
      })
    };

    this.http.put<any>(`${this.api.host}/${this.editedProduct.id}`, this.editedProduct, httpOptions) // Adjuk hozzá a httpOptions objektumot a put kéréshez
      .subscribe({
        next: (data) => {
          console.log('Termék sikeresen frissítve!', data);
          alert("Termék sikeresen frissítve!");
          this.reloadCurrentRoute(); // Útvonal újratöltése
        },
        error: (err) => {
          console.error('Hiba a termék frissítése közben:', err);
          alert('Hiba a termék frissítése közben:');
        },
      });
  }

  // Útvonal újratöltése
  reloadCurrentRoute() {
    const currentUrl = this.router.url;
    this.router.navigateByUrl('/', { skipLocationChange: true }).then(() => {
      this.router.navigate([currentUrl]);
    });
  }
}

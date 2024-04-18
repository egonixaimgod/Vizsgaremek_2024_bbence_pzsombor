import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ProductService } from '../product.service';

@Component({
  selector: 'app-product-edit',
  templateUrl: './product-edit.component.html',
  styleUrls: ['./product-edit.component.css']
})
export class ProductEditComponent implements OnInit {
  productId: number = 1;
  product: any = {}; 

  constructor(private route: ActivatedRoute, private router: Router, private productService: ProductService) { }

  ngOnInit(): void {
    // Az URL-ből kinyerjük a termék azonosítóját
    this.productId = +this.route.snapshot.paramMap.get('id');
    // Betöltjük a termék adatait
    this.loadProduct();
  }

  loadProduct(): void {
    // Itt betöltjük a termék adatait a termék szolgáltatás segítségével
    // A productService-nek meg kell valósítania egy olyan metódust, ami betölti a termék adatait az adatbázisból
    this.productService.getProductById(this.productId).subscribe((product: any) => {
      this.product = product;
    });
  }

  saveProduct(): void {
    // Itt mentjük el a módosított termék adatait a termék szolgáltatás segítségével
    // A productService-nek meg kell valósítania egy olyan metódust, ami elmenti a módosított termék adatait az adatbázisba
    this.productService.updateProduct(this.productId, this.product).subscribe(() => {
      console.log('Termék sikeresen frissítve!');
      // Visszairányítás a termék listához
      this.router.navigate(['/products']);
    });
  }

  goBack(): void {
    // Visszairányítás a termék listához
    this.router.navigate(['/products']);
  }
}

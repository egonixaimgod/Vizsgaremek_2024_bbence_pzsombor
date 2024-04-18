import { Component, ViewChild } from '@angular/core';
import { NgForm } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Router, RouterLink } from '@angular/router';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent {
  @ViewChild('signupForm') signupForm!: NgForm;

  userData = {
    name: '',
    email: '',
    password: '',
    confirm_password: '',
    address: '',
    city: '',
    postal_code: '',
    phone: ''
  };

  constructor(private http: HttpClient, private router: Router) {}

  register() {
    if (this.signupForm.invalid) {
      alert("Kérem, töltse ki az összes mezőt helyesen!");
      return;
    }
  
    this.http.post('http://127.0.0.1:8000/api/auth/register', this.userData)
      .subscribe((response) => {
        console.log('Regisztráció sikeres:', response);
        alert("Gratulálok! Sikeres regisztráció!");
        this.router.navigate(['/login']); // Továbbnavigálás a bejelentkezési oldalra
      }, (error) => {
        console.error('Regisztráció sikertelen:', error);
        alert("Sajnos hibás regisztráció, ellenőrizd az adataid!");
      });
  }
  
}

import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent {
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

  constructor(private http: HttpClient) {}

  register() {
    this.http.post('http://127.0.0.1:8000/api/auth/register', this.userData)
      .subscribe((response) => {
        console.log('Regisztráció sikeres:', response);
        alert("Gratulálok! Sikeres regiszráció! :)");
      }, (error) => {
        console.error('Regisztráció sikertelen:', error);
        alert("Sajnos hibás regisztráció, ellenőrizd az adataid! :(");
      });
  }
}

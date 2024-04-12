import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  userData = {
    email: '',
    password: ''
  };

  constructor(private http: HttpClient, public authService: AuthService) {}

  login() {
    this.http.post('http://127.0.0.1:8000/api/auth/login', this.userData)
      .subscribe((response) => {
        console.log('Bejelentkezés sikeres:', response);
        alert("A bejelentkezés sikeres! :)");
        this.authService.isLoggedIn = true;
      }, (error) => {
        console.error('Bejelentkezés sikertelen:', error);
        alert("A bejelentkezés sikertelen! :(");
      });
  }
}

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

  constructor(private http: HttpClient, public authService: AuthService) { }

  login() {
    this.authService.login(this.userData)
  }
}

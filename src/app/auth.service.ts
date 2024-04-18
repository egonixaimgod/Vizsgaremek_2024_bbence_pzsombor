import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  public isLoggedIn = false;
  public isAdmin = false;
  public userData: any = {};
  public token: any;

  constructor(private http: HttpClient) { }

  login(userData: any) {
    this.http.post('http://127.0.0.1:8000/api/auth/login', userData).subscribe(
      {
        next: (response: any) => {
          console.log('Bejelentkezés sikeres:', response);
          alert("A bejelentkezés sikeres!");
          this.isLoggedIn = true;
          this.userData = response;
          this.token = response.token;
          console.log(this.token);

          if (this.userData.data.admin == 1) {
            this.isAdmin = true;
          } else {
            this.isAdmin = false;
          }
          console.log(this.userData.data.admin);
        },
        error: (error: any) => {
          console.error('Bejelentkezés sikertelen:', error);
          alert("A bejelentkezés sikertelen!");
          this.isLoggedIn = false;
          this.userData = {};
        }   
      }
    );
  }

  updateProfile(userData: any) {
    return this.http.put('http://127.0.0.1:8000/api/updateProfile', userData);
  }
}

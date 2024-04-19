import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http'; 
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  public isLoggedIn = false;
  public isAdmin = false;
  public userData: any = {};
  public token: any;

  constructor(private http: HttpClient, private router: Router) {
    this.checkLoggedInStatus();
  }

  checkLoggedInStatus() {
    const storedUserData = localStorage.getItem('userData');
    if (storedUserData) {
      this.userData = JSON.parse(storedUserData);
      this.isLoggedIn = true;
      this.token = this.userData.token;
    }
  }

  login(userData: any) {
    this.http.post('http://127.0.0.1:8000/api/auth/login', userData).subscribe(
      {
        next: (response: any) => {
          console.log('Bejelentkezés sikeres:', response);
          alert("A bejelentkezés sikeres!");
          this.isLoggedIn = true;
          this.userData = response;
          this.token = response.token;
          localStorage.setItem('userData', JSON.stringify(this.userData)); 
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
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${this.token}`
      })
    };
    return this.http.put('http://127.0.0.1:8000/api/auth/updateProfile', userData, httpOptions);
  }

  deleteProfile() {
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${this.token}`
      })
    };
    return this.http.delete('http://127.0.0.1:8000/api/auth/deleteProfile', httpOptions);
  }

  getProfile() {
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${this.token}`
      })
    };
    return this.http.get<any>('http://127.0.0.1:8000/api/auth/profile', httpOptions);
  }

  logout(): void {
    this.isLoggedIn = false;
    this.isAdmin = false;
    this.userData = {};
    localStorage.removeItem('userData');
  }

  reloadAndNavigate(): void {
    
    window.location.reload();
    
    
    setTimeout(() => {
      
      this.router.navigateByUrl('/home');
    }, 2000); 
  }
}

// profile-edit.component.ts

import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';

export interface UserProfile {
  id: number;
  name: string;
  email: string;
  address: string;
  city: string;
  postal_code: string;
  phone: string;
}

@Component({
  selector: 'app-profile-edit',
  templateUrl: './profile-edit.component.html',
  styleUrls: ['./profile-edit.component.css']
})
export class ProfileEditComponent implements OnInit {
  editedProfile: UserProfile = {
    id: 0,
    name: '',
    email: '',
    address: '',
    city: '',
    postal_code: '',
    phone: ''
  };

  constructor(private authService: AuthService, private http: HttpClient, private router: Router) { }

  ngOnInit(): void {
    this.authService.getProfile().subscribe({
      next: (profile: UserProfile) => {
        this.editedProfile = profile;
      },
      error: (error: any) => {
        console.error('Profil lekérése sikertelen:', error);
      }
    });
  }

  updateProfile(): void {
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${this.authService.token}`
      })
    };

    this.http.put<any>('http://127.0.0.1:8000/api/auth/updateProfile', this.editedProfile, httpOptions)
      .subscribe({
        next: (data) => {
          console.log('Profil sikeresen frissítve!', data);
          alert("Profil sikeresen frissítve!");
          this.reloadCurrentRoute();
        },
        error: (err) => {
          console.error('Hiba a profil frissítése közben:', err);
          alert('Hiba a profil frissítése közben:');
        }
      });
  }

  reloadCurrentRoute() {
    const currentUrl = this.router.url;
    this.router.navigateByUrl('/', { skipLocationChange: true }).then(() => {
      this.router.navigate([currentUrl]);
    });
  }
}

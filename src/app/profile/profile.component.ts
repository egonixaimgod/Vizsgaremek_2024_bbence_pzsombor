import { Component } from '@angular/core';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
}) 
export class ProfileComponent {
  constructor(public authservice: AuthService) { }

  updateProfile() {
    this.authservice.updateProfile(this.authservice.userData).subscribe(
      {
        next: (response: any) => {
          console.log('Profil frissítése sikeres:', response);
          alert("A profil frissítése sikeres!");
        },
        error: (error: any) => {
          console.error('Profil frissítése sikertelen:', error);
          alert("A profil frissítése sikertelen!");
        }   
      }
    );
  }
}

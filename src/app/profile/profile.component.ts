import { Component } from '@angular/core';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
}) 
export class ProfileComponent {
  editing = false;

  constructor(public authservice: AuthService) { }

  updateProfile() {
    this.authservice.updateProfile(this.authservice.userData).subscribe(
      {
        next: (response: any) => {
          console.log('Profil frissítése sikeres:', response);
          alert("A profil frissítése sikeres!");
          this.editing = false;
        },
        error: (error: any) => {
          console.error('Profil frissítése sikertelen:', error);
          alert("A profil frissítése sikertelen!");
        }   
      }
    );
  }

  deleteProfile() {
    if (confirm("Biztosan törölni szeretné a profilját?")) {
      this.authservice.deleteProfile().subscribe(
        {
          next: (response: any) => {
            console.log('Profil törlése sikeres:', response);
            alert("A profil törlése sikeres!");
            // Ide írhatod a további teendőket, pl. visszairányítás, stb.
          },
          error: (error: any) => {
            console.error('Profil törlése sikertelen:', error);
            alert("A profil törlése sikertelen!");
          }   
        }
      );
    }
  }
}

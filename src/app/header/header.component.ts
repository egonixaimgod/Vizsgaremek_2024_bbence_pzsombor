import { Component } from '@angular/core';
import { AuthService } from '../auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {
  constructor(public authService: AuthService, private router: Router) {}
  onLogout(event: MouseEvent): void {
    event.preventDefault(); // Az esemény alapértelmezett működésének megakadályozása (navigáció)
    this.authService.logout();
    this.router.navigate(['/home']); // Az átirányítás a '/home' útvonalra
}



}

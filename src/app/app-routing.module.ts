import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { ProductsComponent } from './products/products.component';
import { AboutComponent } from './about/about.component';
import { CartComponent } from './cart/cart.component';
import { LoginComponent } from './login/login.component';
import { SignupComponent } from './signup/signup.component';
import { ChooseComponent } from './choose/choose.component';
import { ProfileComponent } from './profile/profile.component';
import { MyordersComponent } from './myorders/myorders.component';

const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'home', component: HomeComponent },
  { path: 'products', component: ProductsComponent },
  { path: 'about', component: AboutComponent },
  { path: 'cart', component: CartComponent },
  { path: 'login', component: LoginComponent },
  { path: 'signup', component: SignupComponent },
  { path: 'choose', component: ChooseComponent },
  { path: 'profile', component: ProfileComponent },
  { path: 'orders', component: MyordersComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { PortfolioComponent } from './portfolio/portfolio.component';
import { UserComponent } from './user/user.component';
import { LoginComponent } from './login/login.component';

const routes: Routes = [
  { path: "", component: HomeComponent},
  { path: "login", component: LoginComponent},
  { path: "portfolio", component: PortfolioComponent},
  { path: "user", component: UserComponent},
  { path: "user/:id", component: UserComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {useHash:true} )], //***** usehash à enlever  */
  exports: [RouterModule]
})
export class AppRoutingModule { }

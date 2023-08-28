import { Component } from '@angular/core';
import { LoginViewModel } from './../model/login-view-model';
import { LoginService } from './../services/api/login.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

  loginViewModel: LoginViewModel = new LoginViewModel();
  loginError: string = "";

  constructor( 
          private loginService: LoginService,
          private router : Router
      ){ }

  onLoginClick(event:any){
    this.loginService.login(this.loginViewModel).subscribe({
      next:(response) => { console.log(response);
                        },
      error: (err:Error) => {
                              console.log("Error");
                              this.loginError="Mdp ou email invalides";
                        },
      complete: ()=> this.router.navigateByUrl("/user")
    })
  }




}

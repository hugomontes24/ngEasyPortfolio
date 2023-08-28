import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { LoginViewModel } from '../../model/login-view-model';
import { Observable, map } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  currentUsername: string = '';

  constructor(private httpClient: HttpClient) { };


  public login( loginViewModel : LoginViewModel ): Observable<any> {
    return this.httpClient.post<any>(`http://localhost/angular/ngEasyPortfolio/src/app/services/api/login.php?action=login`, JSON.stringify( loginViewModel), {responseType: "json"} )
    .pipe(map(user => {
      if(user){
        this.currentUsername = user.username ;
      }
      return user ;
    }))
  }

  public logout(){
    this.currentUsername = '';
  }




}

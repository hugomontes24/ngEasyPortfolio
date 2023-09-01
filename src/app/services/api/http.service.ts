import { Injectable } from "@angular/core";
import { Observable } from "rxjs";
import { HttpClient, HttpHeaders } from "@angular/common/http";

@Injectable({
    providedIn: 'root'
})

export class HttpService {

    constructor ( private http: HttpClient ) {}

    getData( table: string, id: number ): Observable<any> {
        let currentUser = {token: ""};
        let headers = new HttpHeaders();
        headers = headers.set("Authorization", "Bearer ");
            
        return this.http.get(`http://localhost/angular/ngEasyPortfolio/src/app/services/api/token/login.php?action=read&id=${id}`, {responseType: "json"} );
    }






    
}
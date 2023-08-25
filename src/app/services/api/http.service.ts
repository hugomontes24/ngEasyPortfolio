import { Injectable } from "@angular/core";
import { Observable } from "rxjs";
import { HttpClient } from "@angular/common/http";

@Injectable({
    providedIn: 'root'
})

export class HttpService {

    constructor ( private http: HttpClient ) {}

    getData( table: string ): Observable<any> {

        return this.http.get(`http://localhost/angular/ngEasyPortfolio/src/app/services/api/${table}.php?action=readAll`);
    }
}
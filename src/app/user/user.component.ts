import { Component, OnInit } from '@angular/core';
import { User } from '../model/user';
import { HttpService } from '../services/api/http.service';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.scss']
})
export class UserComponent implements OnInit {

  table: string = "user";
  users!: User[];
  newUser = new User();

  constructor ( private httpService: HttpService ) {}

  ngOnInit(): void {
    this.getUsers();

  }

  getUsers(){
    this.httpService.getData(this.table).subscribe({
      next: (data: any) => console.log(data),
      error: (err: Error)=> console.log("Error"),
      complete: ()=> console.log("completed")
    })
  }

}

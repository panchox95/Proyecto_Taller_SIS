import { Component, OnInit} from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
    providers: [UserService]
})
export class LoginComponent implements OnInit {

  public user: User;
  public token;
  public identity;


  constructor(
      private _userService: UserService
  ) {
      this.user = new User(1,'pepe','salinas','pepe@gmail.com','pepe123');
  }

  ngOnInit() {
    console.log('sucessfully');
    let user=this._userService.getIdentity();
    console.log(user.first_name);
  }

  onSubmit(form){
    console.log(this.user);
    this._userService.singup(this.user).subscribe(
      response => {
        //token
        this.token=response;
        localStorage.setItem('token',this.token);

        //Objeto Ususario identificado
          this._userService.singup(this.user, true).subscribe(
              response => {
                  //token
                  this.identity=response;
                  localStorage.setItem('identity', JSON.stringify(this.identity));

              },
              error => {
                  console.log(<any>error);
              }
          )

      },
        error => {
        console.log(<any>error);
        }
    );
  }


}

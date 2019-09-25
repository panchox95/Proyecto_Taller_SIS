// @ts-ignore
import { Component, OnInit} from '@angular/core';
// @ts-ignore
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';

// @ts-ignore
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
  public status: string;


  constructor(
      private _userService: UserService,
    private _route: ActivatedRoute,
      private _router: Router,
  ) {
      this.user = new User(1,'','','','');
  }

  ngOnInit() {
    console.log('sucessfully');
    this.logout();
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

  logout(){

      this._route.params.subscribe(params => {

          let logout =+params['sure'];

          if(logout==1){
              localStorage.removeItem('identity');
              localStorage.removeItem('token');

              this.identity=null;
              this.token=null;

              //redireccion
              this._router.navigate(['home']);
          }

      })

  }

}

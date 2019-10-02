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
      this.user = new User('','','','','');
  }

  ngOnInit() {
    console.log('login.component cargado correctamente!!');
    this.logout();
  }

  onSubmit(form){
    this._userService.signup(this.user).subscribe(
      response => {
        //Token
        console.log(response);
        console.log (response.status);
        if(response.status != 'ERROR'){
          this.status = 'SUCCESS';
          this.token = response.token;
          sessionStorage.setItem('token', this.token);
          this._router.navigate(['']);
        } else{
          this.status = 'ERROR';
        }
      },
      error => {
        console.log(<any> error);
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

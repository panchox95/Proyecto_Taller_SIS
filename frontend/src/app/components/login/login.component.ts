// @ts-ignore
import { Component, OnInit} from '@angular/core';
// @ts-ignore
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import * as jwt_decode from "jwt-decode";
import { stringify } from 'querystring';
import {
  AuthService,
  FacebookLoginProvider,
  GoogleLoginProvider
} from 'angular-6-social-login';

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
  public rol;
  public status: string;
  public message: string;


  constructor(
    private _userService: UserService,
    private _route: ActivatedRoute,
    private _router: Router,
    private socialAuthService: AuthService
  ) {
      this.user = new User('','','','','');
  }



  ngOnInit() {
    console.log('login.component cargado correctamente!!');
    this.logout();
  }

  onSubmit(form){
    console.log(this.user);
    console.log('estado: ', this.status);
    this._userService.signup(this.user).subscribe(
      response => {
        // Token
        // console.log(response);
        console.log('response rol: ',response);
        this.message = response.message;
        if(response.rol == 'Admin'){
          this.rol=response.rol;
          localStorage.setItem('rol', this.rol);
          sessionStorage.setItem('rol', this.rol);
          console.log ('rol admin?: ', this.rol);
        } else {
          // this.rol.delete();
        }

        console.log ('rol: ', this.rol);

        if(response.status != 'ERROR'){
          this.status = 'SUCCESS';
          this.token = response.token;

          console.log ('message: ', this.message);
          localStorage.setItem('token', this.token);
          sessionStorage.setItem('token', this.token);

          //objeto usuario identificado
          this._userService.signup(this.user, true).subscribe(
            response => {

              this.identity=response;
              localStorage.setItem('identity', JSON.stringify(this.identity));

            },
            error => {
              console.log(<any> error);

            }
          );
          this._router.navigate(['']);
        } else{
          this.status = 'ERROR';
        }

        /*
        this.token=response;
        console.log('estadossss: ', response.status);
        localStorage.setItem('token', this.token);

        if(response.status != 'ERROR'){
          this.status = 'SUCCESS';
          this.token = response.token;
          sessionStorage.setItem('token', this.token);
          this._router.navigate(['']);
        } else{
          this.status = 'ERROR';

        }
        //objeto usuario identificado
        this._userService.signup(this.user, true).subscribe(
          response => {

            this.identity=response;
            localStorage.setItem('identity', JSON.stringify(this.identity));

          },
          error => {
            console.log(<any> error);

          }
        );

        /*
        if(response.status != 'ERROR'){
          this.status = 'SUCCESS';
          this.token = response.token;
          sessionStorage.setItem('token', this.token);
          this._router.navigate(['']);
        } else{
          this.status = 'ERROR';
        }
        */

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
              localStorage.removeItem('rol');

              this.identity=null;
              this.token=null;
              this.rol=null;

              //redireccion
              this._router.navigate(['home']);
          }

      })

  }

  public socialSignIn(socialPlatform : string) {
    let socialPlatformProvider;
    if(socialPlatform == "facebook"){
      socialPlatformProvider = FacebookLoginProvider.PROVIDER_ID;
    }else if(socialPlatform == "google"){
      socialPlatformProvider = GoogleLoginProvider.PROVIDER_ID;
    }
    this.socialAuthService.signIn(socialPlatformProvider).then(
      (userData) => {
        console.log(socialPlatform+" sign in data : " , userData);
        // Now sign-in with userData
        // ...

      }
    );
  }

}

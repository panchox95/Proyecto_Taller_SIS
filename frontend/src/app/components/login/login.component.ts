// @ts-ignore
import { Component, OnInit} from '@angular/core';
// @ts-ignore
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { stringify } from 'querystring';

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
    console.log(this.user);
    console.log('estados: ', this.status);
    this._userService.signup(this.user).subscribe(
      response => {
        // Token
        // console.log(response);
        // console.log (response.status);

        if(response.status != 'ERROR'){
          this.status = 'SUCCESS';
          this.token = response.token;
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

              this.identity=null;
              this.token=null;

              //redireccion
              this._router.navigate(['home']);
          }

      })

  }

}

// @ts-ignore
import {Component, OnInit, DoCheck} from '@angular/core';
import { UserService } from './services/user.service';

// @ts-ignore
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
    providers: [UserService]
})
export class AppComponent implements OnInit, DoCheck{

  public identity;
  public token;
  public rol;
  public nombre; apellido;

  constructor(
    // tslint:disable-next-line:variable-name
      private _userService: UserService
  ){

    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();

  }

  ngOnInit(){

    console.log('app.component cargado');
    if(this.token != null){
      this._userService.getDatos(this.token).subscribe(
        response =>{
          this.nombre = response.datos.rol;
          this.apellido = response.datos.username;
          //console.log(this.rol);
        },
        error => {
          console.log(<any>error);
        }
      );}

  }



  ngDoCheck() {
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();

  }


}

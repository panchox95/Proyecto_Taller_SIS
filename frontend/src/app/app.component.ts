// @ts-ignore
import {Component, OnInit, DoCheck} from '@angular/core';
import { UserService } from './services/user.service';
import { PerfilService } from './services/perfil.service';
import { Articulo } from './models/articulo';
import { ArticuloService } from './services/articulo.service';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons';


// @ts-ignore
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
    providers: [UserService,PerfilService, ArticuloService]
})
export class AppComponent implements OnInit, DoCheck{

  public identity;
  public token;
  public rol;
  public first_name;
  public last_name;
  public nombre; apellido;
  public articulo: Articulo;
  faShoppingCart=faShoppingCart;


  constructor(
    // tslint:disable-next-line:variable-name
      private _userService: UserService,
      private _articuloService: ArticuloService,
      private _route: ActivatedRoute,
      private _router: Router,
  ){
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();
    this.articulo = new Articulo(0,'','',0, 0,0,'','');
  }

  ngOnInit(){

    console.log('app.component cargado');
    if(this.token != null){
      this._userService.getDatos(this.token).subscribe(
        response =>{
          console.log('datos: ', response);
          this.first_name = response.data.first_name;
          this.last_name = response.data.last_name;
          console.log('bienvenido: ', this.first_name);
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

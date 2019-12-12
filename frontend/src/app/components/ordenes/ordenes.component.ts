import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { Articulo } from '../../models/articulo';
import { UserService } from '../../services/user.service';
import * as jwt_decode from "jwt-decode";
import {Carritolista} from '../../models/carritolista';
import {Carrito} from '../../models/carrito';
import { error } from 'selenium-webdriver';
import { ArticuloService } from '../../services/articulo.service';
import { ComentarioProducto } from '../../models/comentarioproducto';
import { ComentarioService } from '../../services/comentario.service';

@Component({
  selector: 'app-ordenes',
  templateUrl: './ordenes.component.html',
  styleUrls: ['./ordenes.component.css'],
  providers: [UserService, ArticuloService, ComentarioService]
})
export class OrdenesComponent implements OnInit {
  public articulo: Articulo;
  public identity;
  public token;
  public rol;
  public comentarioproducto: ComentarioProducto;
  public puntaje;
  public status_compra: string;

  public page_title: string;
  public PrecioTotal;
  public carritolista: Carritolista;

  constructor(
      private _route: ActivatedRoute,
      private _router: Router,
      private _userService: UserService,
      private _articuloService: ArticuloService,
      private _comentarioService: ComentarioService
  ){
  this.page_title='Ordenes Realizadas';
  this.token=_userService.getToken();
}

  ngOnInit() {
    this.getOrders()
  }

  getOrders(){
    let id_usuario: string;
    const datos=jwt_decode(localStorage.getItem('token'));
    id_usuario = datos.id_user;
    this._userService.checkOrdenes(id_usuario).subscribe(
      response => {
        console.log('ordenes: ', response.productos);
        console.log('Precio: ', response.totalPrice);
        this.carritolista=response.productos;
        this.PrecioTotal=response.totalPrice;
      },
      error => {
        console.log(<any>error);
      }
    );
  }

}

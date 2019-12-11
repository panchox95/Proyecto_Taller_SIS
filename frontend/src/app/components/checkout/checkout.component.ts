
import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {UserService} from '../../services/user.service';
import {ArticuloService} from '../../services/articulo.service';
import {ComentarioService} from '../../services/comentario.service';
import {Articulo} from '../../models/articulo';
import {ComentarioProducto} from '../../models/comentarioproducto';
import * as jwt_decode from "jwt-decode";
import {NgForm} from '@angular/forms';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent implements OnInit {

  public articulo: Articulo;
  public identity;
  public token;
  public rol;
  public comentarioproducto: ComentarioProducto;
  public puntaje;
  public status_compra: string;
  public message: string;

  public page_title: string;
  public PrecioTotal;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
  ) {
    this.page_title='CheckOut';
    this.token=_userService.getToken();
  }

  ngOnInit() {
    this.getCheckout();
  }

  getCheckout(){
    let id_usuario: string;
    const datos=jwt_decode(localStorage.getItem('token'));
    id_usuario = datos.id_user;
    this._userService.getCheckout(id_usuario).subscribe(
      response => {
        console.log('Total a Pagar: ', response);
        this.PrecioTotal=response;
      },
      error => {
        console.log(<any>error);
      }
    );
  }

  postCheckout(CheckoutForm: NgForm){
    let id_usuario: string;
    const datos=jwt_decode(localStorage.getItem('token'));
    id_usuario = datos.id_user;
    console.log('estado: ', this.status_compra);
    this._userService.postCheckout( request).subscribe(
      response => {
        console.log('Total a Pagar: ', response);
        this.PrecioTotal=response;
      },
      error => {
        console.log(<any>error);
      }
    );
  }

}

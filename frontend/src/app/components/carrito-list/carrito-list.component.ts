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

function stripeTokenHandler(token: any) {
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  // Submit the form
}

@Component({
  selector: 'app-carrito-list',
  templateUrl: './carrito-list.component.html',
  styleUrls: ['./carrito-list.component.css'],
  providers: [UserService, ArticuloService, ComentarioService]
})
export class CarritoListComponent implements OnInit {
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
  ) {
    this.page_title='Tu carrito de compras';
    this.token=_userService.getToken();
  }

  ngOnInit() {
    this.getShop();
    this.loadStripe();
  }

  getShop(){
    let id_usuario: string;
    const datos=jwt_decode(localStorage.getItem('token'));
    id_usuario = datos.id_user;
    this._userService.checkCarrito(id_usuario).subscribe(
      response => {
        console.log('carrito: ', response.productos);
        console.log('Precio: ', response.totalPrice);
        this.carritolista=response.productos;
        this.PrecioTotal=response.totalPrice;
      },
      error => {
        console.log(<any>error);
      }
    );
  }

  eliminar1articulo(id_producto) {
    let id_usuario: string;
    const datos=jwt_decode(localStorage.getItem('token'));
    id_usuario = datos.id_user;
    console.log('jp funciona');
    console.log(id_usuario, id_producto);
    const a = new Carrito(parseInt(id_usuario), id_producto);
    this._articuloService.delete1Articulo(a).subscribe(
      response => {
        console.log('compra: ', response);
        if(response.status =='SUCCESS'){

          this.status_compra='SUCCESS';

        } else{
          this.status_compra='ERROR';
          //this._router.navigate(['home']);
        }
      },
      error => {
        console.log(<any>error);
      }
    );
  }

  deleteallArticulo(id_producto) {
    let id_usuario: string;
    const datos=jwt_decode(localStorage.getItem('token'));
    id_usuario = datos.id_user;
    console.log('jp funciona');
    console.log(id_usuario, id_producto);
    const a = new Carrito(parseInt(id_usuario), id_producto);
    this._articuloService.deleteallArticulo(a).subscribe(
      response => {
        console.log('compra: ', response);
        if(response.status =='SUCCESS'){

          this.status_compra='SUCCESS';

        } else{
          this.status_compra='ERROR';
          //this._router.navigate(['home']);
        }
      },
      error => {
        console.log(<any>error);
      }
    );
  }

  loadStripe() {

    if(!window.document.getElementById('stripe-script')) {
      var s = window.document.createElement("script");
      s.id = "stripe-script";
      s.type = "text/javascript";
      s.src = "https://checkout.stripe.com/checkout.js";
      window.document.body.appendChild(s);
    }
  }

  pay(amount) {

    let id_usuario: string;
    const datos=jwt_decode(localStorage.getItem('token'));
    id_usuario = datos.id_user;
    let id_token;
    let a: UserService;
    a = this._userService;
    let handler = (<any>window).StripeCheckout.configure({
      key: 'pk_test_JSjGYK2ckIyzVDkKwLc342Qj00g36Ffq9E',
      locale: 'auto',
      token: function (token: any) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log(token);
        id_token = token;
         alert('Compra Realizada con Exito');
        console.log('Pruebas Jawar' ,id_token);
       // stripeTokenHandler(token);
        a.postcheckout(id_usuario).subscribe(
          response => {
            console.log('respuesta: ', response);
          },
          error => {
            console.log('la putisima: ', <any>error);
          }
        );
             }
    });

    handler.open({
      name: 'Checkout',
      description: 'Pago de la compra ',
      amount: amount * 100
    });

  }



}

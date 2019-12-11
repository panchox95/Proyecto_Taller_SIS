
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
    this.loadStripe();
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
        console.log('jp', <any>error);
      }
    );
    console.log('jp funciona mierda');
  }

  // postCheckout(CheckoutForm: NgForm){
  //   let id_usuario: string;
  //   const datos=jwt_decode(localStorage.getItem('token'));
  //   id_usuario = datos.id_user;
  //   console.log('estado: ', this.status_compra);
  //   this._userService.postCheckout( request).subscribe(
  //     response => {
  //       console.log('Total a Pagar: ', response);
  //       this.PrecioTotal=response;
  //     },
  //     error => {
  //       console.log(<any>error);
  //     }
  //   );
  // }
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

    var handler = (<any>window).StripeCheckout.configure({
      key: 'pk_test_aeUUjYYcx4XNfKVW60pmHTtI',
      locale: 'auto',
      token: function (token: any) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log(token)
        alert('Token Created!!');
      }
    });

    handler.open({
      name: 'Demo Site',
      description: '2 widgets',
      amount: amount * 100
    });

  }

}

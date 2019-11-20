import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { Articulo } from '../../models/articulo';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-carrito-list',
  templateUrl: './carrito-list.component.html',
  styleUrls: ['./carrito-list.component.css'],
  providers: [UserService]
})
export class CarritoListComponent implements OnInit {

  public page_title: string;
  public token;
  public articulo: Articulo;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
  ) {
    this.page_title='Tu carrito de compras';
    this.token=_userService.getToken();
  }

  ngOnInit() {
    this.getShop();
  }

  getShop(){
    this._userService.checkCarrito(this.token).subscribe(
      response => {
        console.log('carrito: ', response);
      },
      error => {
        console.log(<any>error);
      }
    );
  }

}

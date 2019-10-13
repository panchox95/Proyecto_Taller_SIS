import { Component, OnInit, Input} from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Articulo } from '../../models/articulo';
import { ArticuloService } from '../../services/articulo.service';

@Component({
  selector: 'app-articulo-detail',
  templateUrl: './articulo-detail.component.html',
  styleUrls: ['./articulo-detail.component.css'],
  providers: [UserService, ArticuloService]
})
export class ArticuloDetailComponent implements OnInit {

  public articulo: Articulo;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _articuloService: ArticuloService
) {

  }

  ngOnInit() {
    this.getArticulo();
  }

  getArticulo(){
    this._route.params.subscribe(params => {
      let id = +params['id_producto'];

      this._articuloService.getArticulo(id).subscribe(
        response => {
          if(response=='SUCCESS'){
            console.log(response);
            this.articulo=response.articulo;
          } else{
            this._router.navigate(['home']);
          }
        },
        error => {
          console.log(<any>error);
        }
      );
    });
  }

}

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
  public identity;
  public token;
  public rol;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _articuloService: ArticuloService
) {
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();
  }

  ngOnInit() {
    this.getArticulo();
  }

  ngDoCheck() {
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();
  }

  getArticulo(){
    this._route.params.subscribe(params => {
      let id = +params['id_producto'];

      this._articuloService.getArticulo(id).subscribe(
        response => {
          console.log('Resultado: ', response.data);

          if(response.status =='SUCCESS'){
            this.articulo=response.data;
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

import { Component, OnInit, Input} from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Articulo } from '../../models/articulo';
import { ArticuloService } from '../../services/articulo.service';
import { ComentarioProducto } from '../../models/comentarioproducto';
import { ComentarioService } from '../../services/comentario.service';

@Component({
  selector: 'app-oferta-detail',
  templateUrl: './oferta-detail.component.html',
  styleUrls: ['./oferta-detail.component.css'],
  providers: [UserService, ArticuloService, ComentarioService]
})
export class OfertaDetailComponent implements OnInit {

  public articulo: Articulo;
  public identity;
  public token;
  public rol;
  public comentarioproducto: ComentarioProducto;
  public puntaje;
  public status_compra: string;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _articuloService: ArticuloService,
    private _comentarioService: ComentarioService
) {
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();
  }

  ngOnInit() {
    this.getArticulo();
    this.getComentario();
    this.getPuntaje();
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

  getPuntaje(){
    this._route.params.subscribe(params => {
      let id = +params['id_producto'];

      this._articuloService.getPuntaje(id).subscribe(
        response => {
          console.log('Puntaje: ', response.puntaje);

          if(response.status =='SUCCESS'){
            this.puntaje=Math.round(response.puntaje);
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

  getComentario(){
    this._route.params.subscribe(params => {
      let id = +params['id_producto'];

      this._comentarioService.getComentarios(id).subscribe(
        response => {
          console.log('Comentarios: ', response.ofertas);

          if(response.status =='SUCCESS'){
            this.comentarioproducto=response.ofertas;
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

  buyArticulo(id){
    this._articuloService.buyArticulo(id).subscribe(
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

}

import { Component, OnInit, Input} from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Servicio } from '../../models/servicio';
import { ServicioService } from '../../services/servicio.service';
import { ComentarioServicio } from '../../models/comentarioservicio';
import { ComentarioService } from '../../services/comentario.service';
import { OfertaService } from '../../services/oferta.service';
import { OfertaServicio } from '../../models/ofertaservicio';

@Component({
  selector: 'app-ofertaservicio-detail',
  templateUrl: './ofertaservicio-detail.component.html',
  styleUrls: ['./ofertaservicio-detail.component.css'],
  providers: [UserService, ServicioService, ComentarioService, OfertaService]
})
export class OfertaservicioDetailComponent implements OnInit {

  public servicio: Servicio;
  public identity;
  public token;
  public rol;
  public comentarioservicio: ComentarioService;
  public puntaje;
  public status_compra: string;
  public descuento;
  public ofertaservicio: OfertaServicio;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _servicioService: ServicioService,
    private _comentarioService: ComentarioService,
    private _ofertaService: OfertaService
) {
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();
  }

  ngOnInit() {

    this.getServicio();
    this.getPuntaje();
    this.getComentario();
  }

  ngDoCheck() {
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();
  }

  getServicio(){
    this._route.params.subscribe(params => {
      let id = +params['id_servicio'];

      this._servicioService.getServicio(id).subscribe(
        response => {
          console.log('Resultado: ', response.data);

          if(response.status =='SUCCESS'){
            this.servicio=response.data;
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
      let id = +params['id_servicio'];

      this._servicioService.getPuntaje(id).subscribe(
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
      let id = +params['id_servicio'];

      this._comentarioService.getComentarioService(id).subscribe(
        response => {
          console.log('Comentarios-Servicio: ', response.comentarios);

          if(response.status =='SUCCESS'){
            this.comentarioservicio=response.comentarios;
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

  buyServicio(id){
    this._servicioService.buyServicio(id).subscribe(
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

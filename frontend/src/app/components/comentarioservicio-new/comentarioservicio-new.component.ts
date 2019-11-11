import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { UserService } from '../../services/user.service';
import { Servicio } from '../../models/servicio';
import { identity } from 'rxjs/internal-compatibility';
import { ServicioService } from '../../services/servicio.service';
import { OfertaProducto } from '../../models/ofertaproducto'; 
import { OfertaService } from '../../services/oferta.service';
import { ComentarioServicio } from '../../models/comentarioservicio';
import { ComentarioService } from '../../services/comentario.service';

@Component({
  selector: 'app-comentarioservicio-new',
  templateUrl: './comentarioservicio-new.component.html',
  styleUrls: ['./comentarioservicio-new.component.css'],
  providers: [UserService, ServicioService, ComentarioService]
})
export class ComentarioservicioNewComponent implements OnInit {

  public page_title: string;
  public identity;
  public token;
  public servicio: Servicio;
  public comentarioservicio: ComentarioServicio;
  public status_comentario: string;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _servicioService: ServicioService,
    private _comentarioService: ComentarioService,
  ) { 
    this.page_title='Creacion de un Comentario';
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
  }

  ngOnInit() {
    if(this.identity==null){
      this._router.navigate(["/login"]);
    }else{
      this.comentarioservicio=new ComentarioServicio(0,0,0,'',null,'');
    }

    this.getArticulo();
  }

  getArticulo(){
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

  onSubmit(form){

    this._comentarioService.createComentarioService(this.token, this.comentarioservicio, this.servicio.id_servicio).subscribe(
      response =>{
        console.log('respuesta: ', response);
        
        if(response.status=='SUCCESS'){

          // this.ofertaproducto=response.articulo;
          this.status_comentario='SUCCESS';
          form.reset();
          // this._router.navigate(['/home']);

        }else{
          this.status_comentario='ERROR';
        }
      },
      error=>{
        console.log(<any>error);
        this.status_comentario='ERROR';
      }
    );

  }

}

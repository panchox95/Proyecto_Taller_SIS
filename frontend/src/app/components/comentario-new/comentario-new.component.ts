import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { UserService } from '../../services/user.service';
import { Articulo } from '../../models/articulo';
import { identity } from 'rxjs/internal-compatibility';
import { ArticuloService } from '../../services/articulo.service';
import { OfertaProducto } from '../../models/ofertaproducto'; 
import { OfertaService } from '../../services/oferta.service';
import { ComentarioProducto } from '../../models/comentarioproducto';
import { ComentarioService } from '../../services/comentario.service';

@Component({
  selector: 'app-comentario-new',
  templateUrl: './comentario-new.component.html',
  styleUrls: ['./comentario-new.component.css'],
  providers: [UserService, ArticuloService, ComentarioService]
})
export class ComentarioNewComponent implements OnInit {

  public page_title: string;
  public identity;
  public token;
  public articulo: Articulo;
  public comentarioproducto: ComentarioProducto;
  public status_comentario: string;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _articuloService: ArticuloService,
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
      this.comentarioproducto=new ComentarioProducto(0,0,0,'',null,'');
    }

    this.getArticulo();
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

  onSubmit(form){

    this._comentarioService.createComentario(this.token, this.comentarioproducto, this.articulo.id_producto).subscribe(
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

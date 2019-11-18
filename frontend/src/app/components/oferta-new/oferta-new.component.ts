import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { UserService } from '../../services/user.service';
import { Articulo } from '../../models/articulo';
import { identity } from 'rxjs/internal-compatibility';
import { ArticuloService } from '../../services/articulo.service';
import { OfertaProducto } from '../../models/ofertaproducto';
import { OfertaService } from '../../services/oferta.service';

@Component({
  selector: 'app-oferta-new',
  templateUrl: './oferta-new.component.html',
  styleUrls: ['./oferta-new.component.css'],
  providers: [UserService, OfertaService]
})
export class OfertaNewComponent implements OnInit {

  public page_title: string;
  public identity;
  public token;
  public articulo: Articulo;
  public status_articulo: string;
  public ofertaproducto: OfertaProducto;
  public status_oferta: string;
  public imagepath: string;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _articuloService: ArticuloService,
    private _ofertaService: OfertaService,
  ) {
    this.page_title='Creacion de una Oferta';
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
  }

  ngOnInit() {

    if(this.identity==null){
      this._router.navigate(["/login"]);
    }else{
      this.ofertaproducto=new OfertaProducto(0,0,'',null, '../../../assets/img/producto.png' );
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

    this._ofertaService.createOferta(this.token, this.ofertaproducto, this.articulo.id_producto).subscribe(
      response =>{
        console.log('respuesta: ', response);

        if(response.status=='SUCCESS'){

          // this.ofertaproducto=response.articulo;
          this.status_oferta='SUCCESS';
          console.log('estado: ', this.status_oferta);
          form.reset();
          // this._router.navigate(['/home']);

        }else{
          this.status_oferta='ERROR';
        }
      },
      error=>{
        console.log(<any>error);
        this.status_oferta='ERROR';
      }
    );

    /*this._articuloService.create(this.token,this.articulo).subscribe(
        response=>{

          if(response.status=='SUCCESS'){

              this.articulo=response.articulo;
              this.status_articulo='SUCCESS';
              console.log('estado: ', this.status_articulo);
              form.reset();
              // this._router.navigate(['/home']);

          }else{

            this.status_articulo='ERROR';

          }


        },error =>{
          console.log(<any>error);
          this.status_articulo='ERROR';
        }
    );*/
  }

}

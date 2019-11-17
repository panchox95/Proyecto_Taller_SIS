import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { UserService } from '../../services/user.service';
import { Servicio } from '../../models/servicio';
import { identity } from 'rxjs/internal-compatibility';
import { ServicioService } from '../../services/servicio.service';
import { OfertaServicio } from '../../models/ofertaservicio'; 
import { OfertaService } from '../../services/oferta.service';

@Component({
  selector: 'app-ofertaservicio-new',
  templateUrl: './ofertaservicio-new.component.html',
  styleUrls: ['./ofertaservicio-new.component.css'],
  providers: [UserService, ServicioService, OfertaService]
})
export class OfertaServicioNewComponent implements OnInit {
  
  public page_title: string;
  public identity;
  public token;
  public servicio: Servicio;
  public ofertaservicio: OfertaServicio;
  public status_oferta: string;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _servicioService: ServicioService,
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
      this.ofertaservicio=new OfertaServicio(0,0,'',null);
    }

    this.getServicio();
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

  onSubmit(form){

    this._ofertaService.createOfertaServicio(this.token, this.ofertaservicio, this.servicio.id_servicio).subscribe(
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
  }

}

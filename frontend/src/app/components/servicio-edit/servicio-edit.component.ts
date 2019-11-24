import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ServicioService } from 'src/app/services/servicio.service';
import { Servicio } from '../../models/servicio'
import { Response } from 'selenium-webdriver/http';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';

@Component({
  selector: 'app-usuario-edit',
  templateUrl: '../servicio-new/servicio-new.component.html',
  styleUrls: ['../servicio-new/servicio-new.component.css'],
  providers: [UserService, ServicioService]
})
export class ServicioEditComponent implements OnInit {

  public page_title: string;
  public servicio: Servicio;
  public token;
  public status_servicio;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _servicioService: ServicioService
) {
  this.token=this._userService.getToken();
  this.page_title='Editar Servicio';
  }

  ngOnInit() {
    this._route.params.subscribe(params => {
      let id = +params['id_servicio'];
      this.getServicio(id);
    });
  }

  getServicio(id){
    
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
    
  }

  onSubmit(form){
    console.log('ide: ', this.servicio.id_servicio);
    this._servicioService.updateServicio(this.token, this.servicio, this.servicio.id_servicio).subscribe(
      response => {
        console.log('editado: ', response);
        if(response.status =='SUCCESS'){
          this.status_servicio='SUCCESS';
          this.servicio=response.articulo;
          //this._router.navigate(['/articulo', this.articulo.id_producto]);
        } else{
          this.status_servicio='ERROR';
          //this._router.navigate(['home']);
        }
      },
      error => {
        console.log(<any>error);
      }
    );
  }

}

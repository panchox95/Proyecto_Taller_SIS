import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Servicio } from '../../models/servicio';
import { ServicioService } from '../../services/servicio.service';

@Component({
  selector: 'app-servicio-list',
  templateUrl: './servicio-list.component.html',
  styleUrls: ['./servicio-list.component.css'],
  providers: [UserService, ServicioService]
})
export class ServicioListComponent implements OnInit {

  public title: string;
  public servicio: Array<Servicio>;
  public total;
  public per_page;
  public current_page;
  public last_page;
  public next_page_url;
  public prev_page_url;
  public rol;
  public token;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _servicioService: ServicioService
  ) { 
    this.title='Inicio';
    this.token=_userService.getToken();
  }

  ngOnInit() {
    this.getServicios();
  }

  getServicios(){
    this._route.params.subscribe(
      params =>{
        let page = +params['page'];

        // console.log(this.rol);
        this._servicioService.getServicios(page).subscribe(
          response =>{
            console.log('resultado: ', response);
            //  console.log(this.rol)
            this.total = response.servicios.total;
            this.per_page = response.servicios.per_page;
            this.current_page = response.servicios.current_page; 
            this.last_page = response.servicios.last_page;
            this.next_page_url = response.servicios.next_page_url;
            this.prev_page_url = response.servicios.prev_page_url;
            this.servicio = response.servicios.data;

            if(page>this.last_page){
              console.log(page);
              console.log(this.last_page);
              this._router.navigate(['listaservicio',this.last_page]);
            }
          },
          error => {
            console.log(<any>error);
          }
        );

      }

    );
  }

}

import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Articulo } from '../../models/articulo';
import { ArticuloService } from '../../services/articulo.service';

@Component({
  selector: 'app-busqueda-rango',
  templateUrl: './busqueda-rango.component.html',
  styleUrls: ['./busqueda-rango.component.css'],
  providers: [UserService, ArticuloService]
})
export class BusquedaRangoComponent implements OnInit {

  public page_title: string;
  public articulo: Articulo;
  public status_rango: string;

  constructor(
    private _userService: UserService,
    private _articuloService: ArticuloService,
    private _route: ActivatedRoute,
    private _router: Router,
  ) { 
    this.page_title='Busqueda por precios';
    this.articulo = new Articulo(0,'','',0, 0, 0,'','');
  }

  ngOnInit() {
  }

  onSubmit(form){
    this._articuloService.getPrice(this.articulo).subscribe(
      response =>{
        console.log('rango: ', response);
        if(response.status =='SUCCESS'){
          
          
        } else{
          this.status_rango='ERROR';
          form.reset();
        }
      },
      error =>{
        this.status_rango='ERROR';
        console.log(<any> error);
      }

    );
  }

}

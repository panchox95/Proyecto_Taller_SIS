import { Component, OnInit, Input} from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Articulo } from '../../models/articulo';
import { ArticuloService } from '../../services/articulo.service';
import { OfertaProducto } from '../../models/ofertaproducto';
import { OfertaService } from '../../services/oferta.service';
import { OfertaServicio } from '../../models/ofertaservicio';

@Component({
    selector: 'app-default',
    templateUrl: './default.component.html',
    styleUrls: ['./default.component.css'],
    providers: [UserService, OfertaService]
})
export class DefaultComponent implements OnInit {

    public title: string;
    public ofertaproducto: OfertaProducto;
    public ofertaservicio: OfertaServicio;
    public rol;


  constructor(
        private _route: ActivatedRoute,
        private _router: Router,
        private _userService: UserService,
        private _ofertaService: OfertaService,
    ) {
        this.title='Inicio';

    }

    ngOnInit() {
      
      this._ofertaService.getOfertas().subscribe(
        response => {
          console.log('listado producto: ',response.ofertas);
          this.ofertaproducto=response.ofertas;
          
        },
        error => {
          console.log(<any>error);
        }
      );

      this._ofertaService.getOfertasServicio().subscribe(
        response => {
          console.log('listado servicio: ',response.ofertas);
          this.ofertaservicio=response.ofertas;
        },
        error => {
          console.log(<any>error);
        }
      );

    }




}

import { Component, OnInit, Input} from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Articulo } from '../../models/articulo';
import { ArticuloService } from '../../services/articulo.service';

@Component({
    selector: 'app-default',
    templateUrl: './default.component.html',
    //styleUrls: ['./default.component.css'],
    providers: [UserService, ArticuloService]
})
export class DefaultComponent implements OnInit {

    public title: string;
    public articulo: Array<Articulo>;

    constructor(
        private _route: ActivatedRoute,
        private _router: Router,
        private _userService: UserService,
        private _articuloService: ArticuloService
    ) {
        this.title='Inicio';

    }

    ngOnInit() {
        console.log('default.component cargado satisfactoriamente');
        this._articuloService.getArticulos().subscribe(
          response=>{
              if(response.status=='success'){
                  this.articulo=response.articulo;
              }
              console.log(response);
          },
            error=>{
              console.log(error);
            }
        );
    }

    


}

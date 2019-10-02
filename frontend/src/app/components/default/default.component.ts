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
    public total;
    public per_page;
    public current_page;
    public last_page;
    public next_page_url;
    public prev_page_url;
    public rol;


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
        this._route.params.subscribe(
          params =>{
            let page = +params['page'];

            // console.log(this.rol);
            this._articuloService.getArticulos().subscribe(
              response =>{
                //console.log(response.users);
                //  console.log(this.rol)


                this.total = response.articulo.total;
                this.per_page = response.articulo.per_page;
                this.current_page = response.articulo.current_page;
                this.last_page = response.articulo.last_page;
                this.next_page_url = response.articulo.next_page_url;
                this.prev_page_url = response.articulo.prev_page_url;
                this.articulo = response.articulo.data;

                if(page>this.last_page){
                  console.log(page);
                  console.log(this.last_page);
                  this._router.navigate(['/lista',this.last_page]);
                }
              },
              error => {
                console.log(<any>error);
              }
            );

          }

        );

        /*
        this._articuloService.getArticulos().subscribe(
          response=>{
              if(response.status=='SUCCESS'){
                  this.articulo=response.articulo;
              }
              console.log(response);
          },
            error=>{
              console.log(error);
            }
        );*/
    }




}

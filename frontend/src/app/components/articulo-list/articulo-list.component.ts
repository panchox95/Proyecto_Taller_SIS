import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Articulo } from '../../models/articulo';
import { ArticuloService } from '../../services/articulo.service';

@Component({
  selector: 'app-articulo-list',
  templateUrl: './articulo-list.component.html',
  styleUrls: ['./articulo-list.component.css'],
  providers: [UserService, ArticuloService]
})
export class ArticuloListComponent implements OnInit {

  public title: string;
  public articulo: Array<Articulo>;
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
        private _articuloService: ArticuloService
    ) {
        this.title='Inicio';
        this.token=_userService.getToken();
    }

    ngOnInit() {
        console.log('default.component cargado satisfactoriamente');
        this.getArticulos();

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

    getArticulos(){
      this._route.params.subscribe(
        params =>{
          let page = +params['page'];

          // console.log(this.rol);
          this._articuloService.getArticulos(page).subscribe(
            response =>{
              //console.log(response.users);
              //  console.log(this.rol)


              this.total = response.productos.total;
              this.per_page = response.productos.per_page;
              this.current_page = response.productos.current_page;
              this.last_page = response.productos.last_page;
              this.next_page_url = response.productos.next_page_url;
              this.prev_page_url = response.productos.prev_page_url;
              this.articulo = response.productos.data;

              if(page>this.last_page){
                console.log(page);
                console.log(this.last_page);
                this._router.navigate(['listaproducto',this.last_page]);
              }
            },
            error => {
              console.log(<any>error);
            }
          );

        }

      );
    }

    deleteArticulo(id){
      this._articuloService.deleteArticulo(this.token, id).subscribe(
        response =>{
          // this._router.navigate['home'];
          this.getArticulos();
        },
        error =>{
          console.log(<any>error);
          
        }
      );
    }

}

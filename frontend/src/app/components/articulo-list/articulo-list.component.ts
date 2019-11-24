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
  public aux: string;

  constructor(
        private _route: ActivatedRoute,
        private _router: Router,
        private _userService: UserService,
        private _articuloService: ArticuloService
    ) {
      this.token=this._userService.getToken();  
      this.title='Inicio';
    }

    ngOnInit() {
      this.aux='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF91c2VyIjoxLCJmaXJzdF9uYW1lIjoiYWRtaW4iLCJsYXN0X25hbWUiOiJhZG1pbiIsImVtYWlsIjoiYWRtaW5AYWRtaW4uY29tIiwiaWF0IjoxNTcyNjE4NDA3LCJleHAiOjE4ODc5Nzg0MDd9.VZrYb3nYPuctN6JYF2IICMdyFqPV64u4PGutzf3nhIE';
      this.getArticulos();
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

    borrarArticulo(id){
      this._articuloService.deleteArticulo(this.aux, id).subscribe(
        response => {
          console.log('borrado: ', response);
          this.getArticulos();
        },
        error => {
          console.log(<any>error);
        }
      );
    }

}

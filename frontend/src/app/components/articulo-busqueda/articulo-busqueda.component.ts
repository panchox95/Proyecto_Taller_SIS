import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Articulo } from '../../models/articulo';
import { ArticuloService } from '../../services/articulo.service';

@Component({
  selector: 'app-articulo-busqueda',
  templateUrl: './articulo-busqueda.component.html',
  styleUrls: ['./articulo-busqueda.component.css'],
  providers: [UserService, ArticuloService]
})
export class ArticuloBusquedaComponent implements OnInit {

  public articulo: Articulo;

  constructor(
    private _userService: UserService,
    private _articuloService: ArticuloService,
    private _route: ActivatedRoute,
    private _router: Router,
  ) { 
    this.articulo = new Articulo(0,'','',0,0,'','');
  }

  ngOnInit() {
  }

  onSubmit(form){
    this._articuloService.findArticulo(this.articulo).subscribe(
      response =>{
        console.log('busqueda: ', response.data.data);
        if(response.status =='SUCCESS'){
          // this.articulo=response.data;
            this.articulo = response.data.data;
            console.log('salida: ', this.articulo);
            //this._router.navigate(['listaproductoo/',this.last_page]);
            form.reset();
        } else{
          form.reset();
        }
      },
      error =>{
        console.log(<any> error);
      }

    );

    /*this._route.params.subscribe(
      params =>{
        let page = +params['current_page'];
        console.log('pagina:', page);
        
        this._articuloService.findArticulo(this.articulo).subscribe(
          response =>{
            //console.log(response.users);
            //  console.log(this.rol)

            console.log(response.articulo.total);
            
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
              this._router.navigate(['listaproducto',this.last_page]);
            }
          },
          error => {
            console.log(<any>error);
          }
        );
      },
      error => {

      }
    );*/
  }

}

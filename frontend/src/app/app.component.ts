// @ts-ignore
import {Component, OnInit, DoCheck} from '@angular/core';
import { UserService } from './services/user.service';
import { PerfilService } from './services/perfil.service';
import { Articulo } from './models/articulo';
import { ArticuloService } from './services/articulo.service';
import { Router, ActivatedRoute, Params} from '@angular/router';

// @ts-ignore
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
    providers: [UserService,PerfilService, ArticuloService]
})
export class AppComponent implements OnInit, DoCheck{

  public identity;
  public token;
  public rol;
  public first_name; 
  public last_name;
  public nombre; apellido;
  public articulo: Articulo;
  public total;
  public per_page;
  public current_page;
  public last_page;
  public next_page_url;
  public prev_page_url;

  constructor(
    // tslint:disable-next-line:variable-name
      private _userService: UserService,
      private _articuloService: ArticuloService,
      private _route: ActivatedRoute,
      private _router: Router,
  ){
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();
    this.articulo = new Articulo(0,'','',0,0,'');
  }

  ngOnInit(){

    console.log('app.component cargado');
    if(this.token != null){
      this._userService.getDatos(this.token).subscribe(
        response =>{
          //console.log(response.data.first_name+' esto');
          this.first_name = response.data.first_name;
          this.last_name = response.data.last_name;
          console.log('bienvenido: ', this.first_name);
        },
        error => {
          console.log(<any>error);
        }
      );}

  }

  ngDoCheck() {
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
    this.rol=this._userService.getRol();

  }

  onSubmit(form){
    this._articuloService.findArticulo(this.articulo).subscribe(
      response =>{
        console.log('busqueda: ', response.data);
        if(response.status =='SUCCESS'){
          // this.articulo=response.data;
          this.total = response.data.total;
            this.per_page = response.data.per_page;
            this.current_page = response.data.current_page;
            this.last_page = response.data.last_page;
            this.next_page_url = response.data.next_page_url;
            this.prev_page_url = response.data.prev_page_url;
            this.articulo = response.data;
            this._router.navigate(['listaproductoo/',this.last_page]);
        } else{
          
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

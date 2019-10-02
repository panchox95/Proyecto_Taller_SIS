import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ArticuloService } from 'src/app/services/articulo.service';
import { Articulo} from '../../models/articulo'
import { Response } from 'selenium-webdriver/http';
@Component({
 selector: 'app-usuario-edit',
  templateUrl: '../articulo-new/articulo-new.component.html',
  styleUrls: ['../articulo-new/articulo-new.component.css'],
  providers: [ArticuloService]
})
export class ArticuloEditComponent implements OnInit {
  title: string;
  public articulo: Articulo;
  public status_articulo: string;
  public nombre;
  public marca;
  public cantidad;
  public precio;
  public descripcion;
  public edit;
  public id;
  public token;
  // @ts-ignore
  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _articuloService: ArticuloService
  ) {}
  ngOnInit() {
    this.edit=true;
    this._route.params.subscribe(
      params =>{
        let id = +params['id'];
        this.id =id;
        this.getArticulo(id);
      }
    );
  }
  getArticulo(id){
    this._articuloService.getArticulo(id).subscribe(
      Response =>{
        if(Response.status == 'SUCCESS'){
          // console.log(Response.user[0]);
          this.articulo = Response.articulo[0];

          this.title = 'Editar '+Response.articulo[0].nombre+' '+Response.articulo[0].marca+' ' +
            ''+Response.articulo[0].cantidad+' '+Response.articulo[0].precio+''+Response.articulo[0].descripcion
            ;
        }
        else{
          this._router.navigate(['']);
        }
      },
      error => {
        console.log(<any>error);

      }
    );
  }
  onSubmit(form){

    this._articuloService.updateArticulo(this.articulo,this.id).subscribe(

      response =>{
        console.log(response);
        if(response.status == 'SUCCESS'){
          this.status_articulo = 'SUCCESS';
          console.log(this.articulo);
          this._router.navigate(['/usuario',this.id]);
        }
      },
      error =>{
        console.log(<any>error)
      }
    );

  }
}

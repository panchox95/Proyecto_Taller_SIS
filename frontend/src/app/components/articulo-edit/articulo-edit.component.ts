import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ArticuloService } from 'src/app/services/articulo.service';
import { Articulo } from '../../models/articulo'
import { Response } from 'selenium-webdriver/http';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';

@Component({
 selector: 'app-usuario-edit',
  templateUrl: '../articulo-new/articulo-new.component.html',
  styleUrls: ['../articulo-new/articulo-new.component.css'],
  providers: [UserService, ArticuloService]
})
export class ArticuloEditComponent implements OnInit {

  public page_title: string;
  public articulo: Articulo;
  public token;
  public status_articulo;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _articuloService: ArticuloService
) {
  this.token=this._userService.getToken();
  this.page_title='Editar Articulo';
  }

  ngOnInit() {
    this._route.params.subscribe(params => {
      let id = +params['id_producto'];
      this.getArticulo(id);
    });
  }

  getArticulo(id){
    
      this._articuloService.getArticulo(id).subscribe(
        response => {
          console.log('Resultado: ', response.data);

          if(response.status =='SUCCESS'){
            this.articulo=response.data;
          } else{
            this._router.navigate(['home']);
          }
          
        },
        error => {
          console.log(<any>error);
        }
      );
    
  }

  onSubmit(form){
    console.log('ide: ', this.articulo.id_producto);
    this._articuloService.updateArticulo(this.token, this.articulo, this.articulo.id_producto).subscribe(
      response => {
        console.log('editado: ', response);
        if(response.status =='SUCCESS'){
          this.status_articulo='SUCCESS';
          this.articulo=response.articulo;
          //this._router.navigate(['/articulo', this.articulo.id_producto]);
        } else{
          this.status_articulo='ERROR';
          //this._router.navigate(['home']);
        }
      },
      error => {
        console.log(<any>error);
      }
    );
  }

}

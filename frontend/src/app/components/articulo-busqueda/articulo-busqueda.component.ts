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
    this.articulo = new Articulo(0,'','',0, 0, 0,'','');
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
  }

}

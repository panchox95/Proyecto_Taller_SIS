import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';
import { Articulo } from '../../models/articulo';
import { Busqueda } from '../../models/busqueda';
import { BusquedaService } from '../../services/busqueda.service';

@Component({
  selector: 'app-busqueda-rango',
  templateUrl: './busqueda-rango.component.html',
  styleUrls: ['./busqueda-rango.component.css'],
  providers: [UserService, BusquedaService]
})
export class BusquedaRangoComponent implements OnInit {

  public page_title: string;
  public identity;
  public token;
  public articulo: Articulo;
  public status_rango: string;
  public busqueda: Busqueda;

  constructor(
      private _route: ActivatedRoute,
      private _router: Router,
      private _userService: UserService,
      private _busquedaService: BusquedaService,
  ) {
    this.page_title='Busqueda de precio';
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
  }

  ngOnInit() {
    if(this.identity==null){
      this._router.navigate(["/login"]);
    }else{
      this.busqueda=new Busqueda(null,null);
    }
  }

  onSubmit(form){
    this._busquedaService.getPrice(this.busqueda).subscribe(
        response=>{

          console.log('Rango: ',response.data.data);
          
          if(response.status=='SUCCESS'){

            this.articulo=response.data.data;
            this.status_rango='SUCCESS';
            form.reset();

          }else{
            this.status_rango='ERROR';
          }

        },error =>{
          console.log(<any>error);
          this.status_rango='ERROR';
        }
    );
  }

}

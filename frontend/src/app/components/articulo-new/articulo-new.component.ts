import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { UserService } from '../../services/user.service';
import { Articulo } from '../../models/articulo';
import { identity } from 'rxjs/internal-compatibility';
import { ArticuloService } from '../../services/articulo.service';

@Component({
  selector: 'app-articulo-new',
  templateUrl: './articulo-new.component.html',
  styleUrls: ['./articulo-new.component.css'],
  providers: [UserService, ArticuloService]
})
export class ArticuloNewComponent implements OnInit {

  public page_title: string;
  public identity;
  public token;
  public articulo: Articulo;
  public status_articulo: string;

  constructor(
      private _route: ActivatedRoute,
      private _router: Router,
      private _userService: UserService,
      private _articuloService: ArticuloService
  ) {
    this.page_title='Crear nuevo articulo';
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
  }

  ngOnInit() {
    if(this.identity==null){
      this._router.navigate(["/login"]);
    }else{
      this.articulo=new Articulo(0,'','',0, 0, 0,'','');
    }
  }

  onSubmit(form){
    this._articuloService.create(this.token,this.articulo).subscribe(
        response=>{

          if(response.status=='SUCCESS'){

              this.articulo=response.articulo;
              this.status_articulo='SUCCESS';
              console.log('estado: ', this.status_articulo);
              form.reset();
              // this._router.navigate(['/home']);

          }else{

            this.status_articulo='ERROR';

          }


        },error =>{
          console.log(<any>error);
          this.status_articulo='ERROR';
        }
    );
  }

}

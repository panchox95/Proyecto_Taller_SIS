import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { UserService } from '../../services/user.service';
import { Articulo } from '../../models/articulo';
import { identity } from 'rxjs/internal-compatibility';

@Component({
  selector: 'app-articulo-new',
  templateUrl: './articulo-new.component.html',
  styleUrls: ['./articulo-new.component.css'],
    providers: [UserService]
})
export class ArticuloNewComponent implements OnInit {

  public page_title: string;
  public identity;
  public token;
  public articulo: Articulo;

  constructor(
      private _route: ActivatedRoute,
      private _router: Router,
      private _userService: UserService
  ) {
    this.page_title='Crear nuevo articulo';
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
  }

  ngOnInit() {
    if(this.identity==null){
      this._router.navigate(["/login"]);
    }else{
      this.articulo=new Articulo(1,'','',1,'',null,null);
    }
  }

  onSubmit(form){
    console.log(this.articulo);
  }

}

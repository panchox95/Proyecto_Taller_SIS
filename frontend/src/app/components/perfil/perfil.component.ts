import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../../models/user';
import { Perfil } from '../../models/perfil';
import { UserService } from '../../services/user.service';
import { PerfilService } from '../../services/perfil.service';
@Component({
  selector: 'app-perfil',
  templateUrl: './perfil.component.html',
  styleUrls: ['./perfil.component.css'],
  providers: [UserService,PerfilService]
})
export class PerfilComponent implements OnInit {

  public perfil: Perfil;
  public status: string;
  public user: User;
  public token: string;
  public rol: string;
  constructor(
    // tslint:disable-next-line:variable-name
    private _route: ActivatedRoute,
    // tslint:disable-next-line:variable-name
    private _router: Router,
    // tslint:disable-next-line:variable-name
    private _userService: UserService
  ) {

    this.perfil = new Perfil('','','','','');
    this.user = new User('','','','','');
    this.token = this._userService.getToken();
    this.rol = this._userService.getRol();

  }
  ngOnInit() {
    console.log(this.perfil);
    // console.log(this._userService.pruebas());
    this._userService.getDatos(this.token).subscribe(
      response => {
        console.log(response);
        if(response.status=='SUCCESS'){
          this.user.email=response.data.email;
          this.user.first_name=response.data.first_name;
          this.user.last_name=response.data.last_name;
          this.perfil.direccion=response.data.direccion;
          this.perfil.telefono=response.data.telefono;

        } else{
          this.status = 'ERROR';
        }
      },
      // tslint:disable-next-line:no-shadowed-variable
      error => {
        console.log(<any> error);
      }
    );
  }

  onSubmit(form){
    
  }

}

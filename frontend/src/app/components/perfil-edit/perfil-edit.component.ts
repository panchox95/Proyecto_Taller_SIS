import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../../models/user';
import { Perfil } from '../../models/perfil';
import { UserService } from '../../services/user.service';
import { PerfilService } from '../../services/perfil.service';
@Component({
  selector: 'app-perfil-edit',
  templateUrl: './perfil-edit.component.html',
  styleUrls: ['./perfil-edit.component.css'],
  providers: [UserService,PerfilService]
})
export class PerfilEditComponent implements OnInit {
  public perfil: Perfil;
  public status: string;
  public user: User;
  public token: string;
  public rol: string;
  public page_title:string;
  constructor(
    
    private _route: ActivatedRoute,
    
    private _router: Router,
    
    private _userService: UserService,

    private _perfilService: PerfilService,
  ) {
    
    this.user = new User('','','','','');
    this.perfil = new Perfil('','','','','',this.user);
    this.token = this._userService.getToken();
    this.rol = this._userService.getRol();
    this.page_title = "Edicion";
   }

  ngOnInit() {
    console.log(this.perfil);
    // console.log(this._userService.pruebas());
    this._userService.getDatos(this.token).subscribe(
      response => {
        console.log(response);
        if(response.status=='SUCCESS'){
          this.perfil.user.email=response.data.email;
          this.perfil.user.first_name=response.data.first_name;
          this.perfil.user.last_name=response.data.last_name;
          this.perfil.direccion=response.data.direccion;
          this.perfil.telefono=response.data.telefono;

          console.log('datos: ',this.perfil);
          

        } else{
          this.status = 'ERROR';
        }
      },
  
      error => {
        console.log(<any> error);
      }
    );

  }
  onSubmit(form){
    console.log(JSON.stringify(this.perfil));
    

    this._perfilService.update(this.token,this.perfil).subscribe(
      response => {
        console.log('editado: ', response);
        if(response.status =='SUCCESS'){
          
          this._router.navigate(['']);
        } else{
          
          this._router.navigate(['/editar-perfil']);
        }
      },
      error => {
        console.log(<any>error);
      }
    );
  }

}

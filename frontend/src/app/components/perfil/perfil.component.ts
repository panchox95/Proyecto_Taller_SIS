import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
@Component({
  selector: 'app-perfil',
  templateUrl: './perfil.component.html',
  styleUrls: ['./perfil.component.css'],
  providers: [UserService]
})
export class PerfilComponent implements OnInit {

  public user: User;
  public status: string;

  constructor(
    // tslint:disable-next-line:variable-name
    private _route: ActivatedRoute,
    // tslint:disable-next-line:variable-name
    private _router: Router,
    // tslint:disable-next-line:variable-name
    private _userService: UserService
  ) {

    this.user = new User('','','','','');

  }
  ngOnInit() {
  }

  onSubmit(form){
    console.log(this.user);
    // console.log(this._userService.pruebas());
    this._userService.update(this.user).subscribe(
      response => {
        console.log(response);
        if(response.status=='SUCCESS'){
          // vaciar el formulario
          this.status = response.status;
          console.log(this.status);
          this.user = new User('','','','','');
          form.reset();

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

}

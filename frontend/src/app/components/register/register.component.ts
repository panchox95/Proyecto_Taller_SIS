import { Component, OnInit, Input} from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
    providers: [UserService]
})
export class RegisterComponent implements OnInit {

  public user: User;
  public status: string;

  constructor(
      private _route: ActivatedRoute,
      private _router: Router,
      private _userService: UserService
  ) {
    this.user = new User(1,'pepe','salinas','pepe@gmail.com','pepe123');
  }

  ngOnInit() {
  }

  onSubmit(form){
    //console.log(this.user);
    //console.log(this._userService.pruebas());
      this._userService.register(this.user).subscribe(
          response => {

            if(response.status=='success'){
              //vaciar el formulario
                this.status = response.status;

                this.user = new User(1,'pepe','salinas','pepe@gmail.com','pepe123');
                form.reset();

            }else{
              this.status='Error';
            }
          },
          error => {
            console.log(<any>error);
          }
      );
  }

}

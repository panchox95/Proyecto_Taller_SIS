// @ts-ignore
import {Component, OnInit, DoCheck} from '@angular/core';
import { UserService } from './services/user.service';

// @ts-ignore
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
    providers: [UserService]
})
export class AppComponent implements OnInit, DoCheck{

  public identity;
  public token;

  constructor(
    // tslint:disable-next-line:variable-name
      private _userService: UserService
  ){

    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();

  }

  ngOnInit(){

    console.log('app.component cargado');

  }



  ngDoCheck() {
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();

  }


}

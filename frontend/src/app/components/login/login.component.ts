import { Component, OnInit} from '@angular/core';
import { Route, ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  constructor(private _route: Route) {

  }

  ngOnInit() {
  }

  addEmail(email){
      console.log(email.value);
      email.value='';
  }
}

import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'frontend';

  addEmail(email){
    console.log(email.value);
    email.value='';
    return 'app-register';
  }
}

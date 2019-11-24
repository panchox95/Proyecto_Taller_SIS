import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { UserService } from '../../services/user.service';
import { Servicio } from '../../models/servicio';
import { identity } from 'rxjs/internal-compatibility';
import { ServicioService } from '../../services/servicio.service';

@Component({
  selector: 'app-servicio-new',
  templateUrl: './servicio-new.component.html',
  styleUrls: ['./servicio-new.component.css'],
  providers: [UserService, ServicioService]
})
export class ServicioNewComponent implements OnInit {

  public page_title: string;
  public identity;
  public token;
  public servicio: Servicio;
  public status_servicio: string;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _servicioService: ServicioService
  ) { 
    this.page_title='Crear nuevo servicio';
    this.identity=this._userService.getIdentity();
    this.token=this._userService.getToken();
  }

  ngOnInit() {
    if(this.identity==null){
      this._router.navigate(["/login"]);
    }else{
      this.servicio=new Servicio(0,'',0,'','');
    }
  }

  onSubmit(form){
    this._servicioService.create(this.token,this.servicio).subscribe(
        response=>{

          console.log('resultado: ', response);
          
          if(response.status=='SUCCESS'){

              this.servicio=response;
              this.status_servicio='SUCCESS';
              console.log('estado: ', this.status_servicio);
              form.reset();
              // this._router.navigate(['/home']);

          }else{

            this.status_servicio='ERROR';

          }


        },error =>{
          console.log(<any>error);
          this.status_servicio='ERROR';
        }
    );
  }

}

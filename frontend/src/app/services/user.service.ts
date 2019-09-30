import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { GLOBAL } from './global';
import { User } from '../models/user';


@Injectable()
export class UserService {
    public url: string;
    public identity;
    public token;

    constructor(
        public _http: HttpClient
    ){
        this.url=GLOBAL.url;
    }

    pruebas(){
        return "Hola mundo";
    }

    register(user): Observable<any>{

        let json=JSON.stringify(user);
        console.log(json+ 'algo');

        let headers= new HttpHeaders().set('Content-Type', 'application/json');

        return this._http.post(this.url+'registro', json, { headers: headers });
    }

    update(user): Observable<any>{

      let json=JSON.stringify(user);
      console.log(json+ 'algo');

      let headers= new HttpHeaders().set('Content-Type', 'application/json');

      return this._http.post(this.url+'actualizacion', json, { headers: headers });
    }

    singup(user, gettoken=null): Observable<any>{

        if(gettoken != null){
            user.gettoken='true';
        }

        let json=JSON.stringify(user);
        console.log(json);

        let headers= new HttpHeaders().set('Content-Type', 'application/json');

        return this._http.post(this.url+'login', json, { headers: headers });
    }

    getIdentity(){

        let identity=JSON.parse(localStorage.getItem('identity'));

        if(identity != 'undefined'){
            this.identity=identity;
        }else{
            this.identity=null;
        }

        return this.identity;

    }

    getToken(){

        let token=localStorage.getItem('token');

        if(token != 'undefined'){
            this.token=token;
        }else{
            this.token=null;
        }

        return this.token;
    }
}

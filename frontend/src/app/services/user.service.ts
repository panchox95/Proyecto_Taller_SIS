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
    public rol;

    constructor(
        public _http: HttpClient
    ){
        this.url=GLOBAL.url;
    }

    register(user): Observable<any>{

        let json=JSON.stringify(user);
        let headers= new HttpHeaders().set('Content-Type', 'application/json');
        return this._http.post(this.url+'registro', json, { headers: headers });
    }

    update(user): Observable<any>{

      let json=JSON.stringify(user);
      let headers= new HttpHeaders().set('Content-Type', 'application/json');
      return this._http.post(this.url+'modificarperfil', json, { headers: headers });
    }

    signup(user, gettoken=null): Observable<any>{

        if(gettoken != null){
            user.gettoken='true';
        }
        let json=JSON.stringify(user);
        console.log(json);
        let headers= new HttpHeaders().set('Content-Type', 'application/json');
        return this._http.post(this.url+'login', json, { headers: headers });
    }

    getIdentity(){

        let identity = JSON.parse(localStorage.getItem('identity'));
        if(identity != 'undefined'){
            this.identity=identity;
        }else{
            this.identity=null;
        }
        return this.identity;

    }

    getToken(){

        let token =localStorage.getItem('token');
        if(token != 'undefined'){
            this.token=token;
        }else{
            this.token=null;
        }
        return this.token;
    }

    getRol(){

        let rol =localStorage.getItem('rol');
        if(rol != 'undefined'){
            this.rol=rol;
        }else{
            this.rol=null;
        }
        return this.rol;
    }

    getDatos(token): Observable<any>{
        let headers = new HttpHeaders()
        .set('Authorization',token);
        return this._http.get(this.url+'verperfil',{headers: headers})
    }

    checkCarrito(token): Observable<any>{
        let headers =new HttpHeaders().set('Content-Type','application/x-www-form-urlencoded').set('Authorization',token);
      return this._http.get(this.url+'shopping-cart', { headers: headers});
    }
}

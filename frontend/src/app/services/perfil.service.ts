import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { GLOBAL } from './global';
import { Perfil } from '../models/perfil';


@Injectable()
export class PerfilService {
    public url: string;
    public identity;
    public token;
    public rol;

    constructor(
        public _http: HttpClient
    ){
        this.url=GLOBAL.url;
    }

    update(token,perfil): Observable<any>{

      let json=JSON.stringify(perfil);

      let headers= new HttpHeaders().set('Content-Type', 'application/json')
      .set('Authorization',token);
      return this._http.put(this.url+'modificarperfil', json, { headers: headers });
    }
    subirfoto(token,foto): Observable<any>{
        let fd = new FormData();
        fd.append('photo',foto);
        fd.append('_token', '{{ csrf_token() }}');
        fd.append('_method', 'PUT');
        console.log(fd);
        let headers= new HttpHeaders().set('Authorization',token);
        return this._http.post(this.url+'subirfoto',fd, { headers: headers });
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
}

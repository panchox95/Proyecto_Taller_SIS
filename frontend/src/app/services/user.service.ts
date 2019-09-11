import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { GLOBAL } from './global';
import { User } from '../models/user';


@Injectable()
export class UserService {
    public url: string;

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
        let params='json'+json;
        let headers= new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded');

        return this._http.post(this.url+'registro', params, { headers: headers });
    }
}
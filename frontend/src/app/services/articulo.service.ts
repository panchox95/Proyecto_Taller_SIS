import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { GLOBAL } from './global';
import { Articulo } from '../models/articulo';
import {headersToString} from "selenium-webdriver/http";


@Injectable()
export class ArticuloService {
    public url: string;

    constructor(
        public _http: HttpClient
    ) {
        this.url = GLOBAL.url;
    }

    pruebas() {
        return "Hola mundo";
    }

    create(token, articulo: Articulo): Observable<any>{

        let json=JSON.stringify(articulo);
        let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);

        return this._http.post(this.url+'crearproducto',json, {headers: headers});
    }

    getArticulos(): Observable<any>{
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.get(this.url+'producto', {headers: headers});
    }
}
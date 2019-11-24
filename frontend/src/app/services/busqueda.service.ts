import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { GLOBAL } from './global';
import { OfertaProducto } from '../models/ofertaproducto';
import { headersToString } from 'selenium-webdriver/http';


@Injectable()
export class BusquedaService {
    public url: string;

    constructor(
        public _http: HttpClient
    ) {
        this.url = GLOBAL.url;
    }

    getPrice(busqueda): Observable <any>{
        let json=JSON.stringify(busqueda);
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.post(this.url+'busquedaprecio', json, { headers: headers});
    }
    
}
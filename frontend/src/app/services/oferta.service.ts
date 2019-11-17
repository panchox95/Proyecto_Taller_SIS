import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { GLOBAL } from './global';
import { OfertaProducto } from '../models/ofertaproducto';
import { headersToString } from 'selenium-webdriver/http';


@Injectable()
export class OfertaService {
    public url: string;

    constructor(
        public _http: HttpClient
    ) {
        this.url = GLOBAL.url;
    }

    createOferta(token, ofertaproducto, id): Observable<any>{
        let json=JSON.stringify(ofertaproducto);
        let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);
        return this._http.post(this.url+'crearoferta/'+id, json, { headers: headers});
    }
    
    getOfertas(): Observable<any>{
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.get(this.url+'listaoferta', { headers: headers })
    }

    createOfertaServicio(token, ofertaservicio, id): Observable<any>{
        let json=JSON.stringify(ofertaservicio);
        let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);
        return this._http.post(this.url+'crearofertaservicio/'+id, json, { headers: headers});
    }
    
}

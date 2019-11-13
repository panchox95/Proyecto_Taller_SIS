import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { GLOBAL } from './global';
import { OfertaProducto } from '../models/ofertaproducto';
import { headersToString } from 'selenium-webdriver/http';
import { ComentarioProducto } from '../models/comentarioproducto';


@Injectable()
export class ComentarioService {
    public url: string;

    constructor(
        public _http: HttpClient
    ) {
        this.url = GLOBAL.url;
    }

    createComentario(token, comentarioproducto, id): Observable<any>{
        let json=JSON.stringify(comentarioproducto);
        let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);
        return this._http.post(this.url+'crearcomentario/'+id, json, { headers: headers});
    }

    getComentarios(id): Observable<any>{
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.get(this.url+'listacomentario/'+id,{ headers: headers})
    }

    createComentarioService(token, comentarioservicio, id): Observable<any>{
        let json=JSON.stringify(comentarioservicio);
        let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);
        return this._http.post(this.url+'crearcomentario/'+id, json, { headers: headers});
    }

    getComentarioService(id): Observable<any>{
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.get(this.url+'listacomentarioservicio/'+id,{ headers: headers})
    }

    
}

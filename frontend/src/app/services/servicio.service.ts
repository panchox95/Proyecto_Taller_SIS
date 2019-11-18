import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { GLOBAL } from './global';
import { Servicio } from '../models/servicio';
import { headersToString } from 'selenium-webdriver/http';

@Injectable()
export class ServicioService {
    public url: string;

    constructor(
        public _http: HttpClient
    ) {
        this.url = GLOBAL.url;
    }

    create(token, servicio: Servicio): Observable<any>{

        let json=JSON.stringify(servicio);
        let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);
        return this._http.post(this.url+'crearservicio',json, {headers: headers});
    }

    getServicios(page): Observable<any>{
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.get(this.url+'listaservicio'+'?page='+page,{headers: headers})
    }

    getServicio(id): Observable<any>{
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.get(this.url+'verservicio/'+id,{ headers: headers})
    }

    findArticulo(servicio: Servicio): Observable<any> {
        let json=JSON.stringify(servicio);
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.post(this.url+'busquedanombre', json, {headers: headers});
    }

    updateServicio(token, servicio, id): Observable <any>{
        let json=JSON.stringify(servicio);
        let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);
        return this._http.put(this.url+'modificarservicio/'+id, json, { headers: headers});
    }

    getPuntaje(id): Observable<any>{
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.get(this.url+'puntajeservicio/'+id,{ headers: headers})
    }

    buyServicio(id): Observable <any>{
        let headers =new HttpHeaders().set('Content-Type','application/json');
        return this._http.get(this.url+'add-to-cart/'+id, { headers: headers});
      }

    deleteArticulo(token, id): Observable <any>{
        let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);
        return this._http.put(this.url+'eliminarproducto/'+id, { headers: headers});
    }
    
}

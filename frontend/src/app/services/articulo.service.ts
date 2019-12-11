import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';
import { GLOBAL } from './global';
import { Articulo } from '../models/articulo';
import { headersToString } from 'selenium-webdriver/http';
import {Carrito} from '../models/carrito';
import {Checkout} from '../models/checkout';


@Injectable()
export class ArticuloService {
    public url: string;

    constructor(
        public _http: HttpClient
    ) {
        this.url = GLOBAL.url;
    }

    create(token, articulo: Articulo): Observable<any>{

        let json=JSON.stringify(articulo);
        let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);

        return this._http.post(this.url+'crearproducto',json, {headers: headers});
    }

    getArticulos(page): Observable<any>{
        let headers =new HttpHeaders().set('Content-Type','application/json');
        //return this._http.get(this.url+'articulo', {headers: headers});
        return this._http.get(this.url+'listaproducto'+'?page='+page,{headers: headers})

    }

  getArticulo(id): Observable<any>{
    let headers =new HttpHeaders().set('Content-Type','application/json');
    return this._http.get(this.url+'verproducto/'+id,{ headers: headers})
  }

  findArticulo(articulo: Articulo): Observable<any> {
    let json=JSON.stringify(articulo);
    let headers =new HttpHeaders().set('Content-Type','application/json');
    return this._http.post(this.url+'busquedanombre', json, {headers: headers});
  }

  updateArticulo(token, articulo, id): Observable <any>{
    let json=JSON.stringify(articulo);
    let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);
    return this._http.put(this.url+'modificarproducto/'+id, json, { headers: headers});
  }

  deleteArticulo(token, id): Observable <any>{
    let headers =new HttpHeaders().set('Content-Type','application/json').set('Authorization',token);
    return this._http.delete(this.url+'BorrarProductoAlaMala/'+id, { headers: headers});
  }

  buyArticulo(data: Carrito): Observable <any>{
      let json=JSON.stringify(data);
    let headers =new HttpHeaders().set('Content-Type','application/json');
    return this._http.post(this.url+'add-to-cart/', json, { headers: headers});
  }

  delete1Articulo(data: Carrito): Observable <any>{
    let json=JSON.stringify(data);
    let headers =new HttpHeaders().set('Content-Type','application/json');
    return this._http.post(this.url+'reduce/', json, { headers: headers});
  }
  deleteallArticulo(data: Carrito): Observable <any>{
    let json=JSON.stringify(data);
    let headers =new HttpHeaders().set('Content-Type','application/json');
    return this._http.post(this.url+'remove/', json, { headers: headers});
  }

  getPuntaje(id): Observable<any>{
    let headers =new HttpHeaders().set('Content-Type','application/json');
    return this._http.get(this.url+'puntajeproducto/'+id,{ headers: headers})
  }

  getPrice(busqueda): Observable <any>{
    let json=JSON.stringify(busqueda);
    let headers =new HttpHeaders().set('Content-Type','application/json');
    return this._http.post(this.url+'busquedaprecio/', json, { headers: headers});
  }

  deleteUsuario(id,json): Observable <any>{
    let headers =new HttpHeaders().set('Content-Type','application/json');
    json = '';
    console.log(id);
    console.log(headers);
    return this._http.put(this.url+'delete/'+id,json,{headers: headers});
  }
}

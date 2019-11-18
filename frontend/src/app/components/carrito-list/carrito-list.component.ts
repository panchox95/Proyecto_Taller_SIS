import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-carrito-list',
  templateUrl: './carrito-list.component.html',
  styleUrls: ['./carrito-list.component.css']
})
export class CarritoListComponent implements OnInit {

  public page_title: string;

  constructor() { 
    this.page_title='Tu carrito de compras';
  }

  ngOnInit() {
  }

}

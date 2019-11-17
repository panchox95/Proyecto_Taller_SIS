import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { UserService } from '../../services/user.service';
import { Servicio } from '../../models/servicio';
import { identity } from 'rxjs/internal-compatibility';
import { ServicioService } from '../../services/servicio.service';
import { OfertaServicio } from '../../models/ofertaservicio'; 
import { OfertaService } from '../../services/oferta.service';

@Component({
  selector: 'app-ofertaservicio-new',
  templateUrl: './ofertaservicio-new.component.html',
  styleUrls: ['./ofertaservicio-new.component.css']
})
export class OfertaservicioNewComponent implements OnInit {
  
  constructor() { }

  ngOnInit() {
  }

}

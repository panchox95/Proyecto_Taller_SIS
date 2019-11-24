import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BusquedaRangoComponent } from './busqueda-rango.component';

describe('BusquedaRangoComponent', () => {
  let component: BusquedaRangoComponent;
  let fixture: ComponentFixture<BusquedaRangoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BusquedaRangoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BusquedaRangoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

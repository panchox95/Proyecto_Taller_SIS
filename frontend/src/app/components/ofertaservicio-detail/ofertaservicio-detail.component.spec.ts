import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OfertaservicioDetailComponent } from './ofertaservicio-detail.component';

describe('OfertaservicioDetailComponent', () => {
  let component: OfertaservicioDetailComponent;
  let fixture: ComponentFixture<OfertaservicioDetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OfertaservicioDetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OfertaservicioDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

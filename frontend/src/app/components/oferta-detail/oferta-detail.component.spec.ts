import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OfertaDetailComponent } from './oferta-detail.component';

describe('OfertaDetailComponent', () => {
  let component: OfertaDetailComponent;
  let fixture: ComponentFixture<OfertaDetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OfertaDetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OfertaDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

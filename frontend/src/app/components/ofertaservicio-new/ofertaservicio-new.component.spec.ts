import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OfertaservicioNewComponent } from './ofertaservicio-new.component';

describe('OfertaservicioNewComponent', () => {
  let component: OfertaservicioNewComponent;
  let fixture: ComponentFixture<OfertaservicioNewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OfertaservicioNewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OfertaservicioNewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OfertaNewComponent } from './oferta-new.component';

describe('OfertaNewComponent', () => {
  let component: OfertaNewComponent;
  let fixture: ComponentFixture<OfertaNewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OfertaNewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OfertaNewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

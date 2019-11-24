import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ComentarioservicioNewComponent } from './comentarioservicio-new.component';

describe('ComentarioservicioNewComponent', () => {
  let component: ComentarioservicioNewComponent;
  let fixture: ComponentFixture<ComentarioservicioNewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ComentarioservicioNewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ComentarioservicioNewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

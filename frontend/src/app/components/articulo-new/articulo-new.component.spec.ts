import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ArticuloNewComponent } from './articulo-new.component';

describe('ArticuloNewComponent', () => {
  let component: ArticuloNewComponent;
  let fixture: ComponentFixture<ArticuloNewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ArticuloNewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ArticuloNewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

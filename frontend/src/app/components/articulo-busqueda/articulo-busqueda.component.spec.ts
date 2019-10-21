import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ArticuloBusquedaComponent } from './articulo-busqueda.component';

describe('ArticuloBusquedaComponent', () => {
  let component: ArticuloBusquedaComponent;
  let fixture: ComponentFixture<ArticuloBusquedaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ArticuloBusquedaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ArticuloBusquedaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

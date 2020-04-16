import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { Categorie.EditComponent } from './categorie.edit.component';

describe('Categorie.EditComponent', () => {
  let component: Categorie.EditComponent;
  let fixture: ComponentFixture<Categorie.EditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Categorie.EditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Categorie.EditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

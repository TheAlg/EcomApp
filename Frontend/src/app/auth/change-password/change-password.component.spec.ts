import { ComponentFixture, TestBed } from '@angular/core/testing';
import { changePasswordComponent } from './change-password.component'



describe('ResetPasswordComponent', () => {
  let component: changePasswordComponent;
  let fixture: ComponentFixture<changePasswordComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ changePasswordComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(changePasswordComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

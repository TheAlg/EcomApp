import { TestBed } from '@angular/core/testing';

import { FormsProviderService } from './services/forms.service';

describe('FormsProviderService', () => {
  let service: FormsProviderService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(FormsProviderService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});

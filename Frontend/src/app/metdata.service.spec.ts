import { TestBed } from '@angular/core/testing';

import { MetdataService } from './services/metdata.service';

describe('MetdataService', () => {
  let service: MetdataService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(MetdataService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});

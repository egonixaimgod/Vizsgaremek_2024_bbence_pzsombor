import { TestBed } from '@angular/core/testing';

import { MyordersService } from './myorders.service';

describe('MyordersService', () => {
  let service: MyordersService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(MyordersService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});

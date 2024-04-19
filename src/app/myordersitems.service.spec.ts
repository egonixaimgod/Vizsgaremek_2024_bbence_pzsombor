import { TestBed } from '@angular/core/testing';

import { MyordersitemsService } from './myordersitems.service';

describe('MyordersitemsService', () => {
  let service: MyordersitemsService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(MyordersitemsService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});

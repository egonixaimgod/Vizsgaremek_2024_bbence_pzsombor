import { TestBed } from '@angular/core/testing';

import { OrderItemsService } from './order-items.service';

describe('OrderItemsService', () => {
  let service: OrderItemsService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(OrderItemsService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});

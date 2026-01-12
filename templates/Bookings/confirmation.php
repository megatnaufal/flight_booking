<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<div class="bg-light min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                
                <div class="card border-0 shadow-sm p-5 mb-4">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle" style="width: 80px; height: 80px;">
                            <i class="bi bi-check-lg display-4"></i>
                        </div>
                    </div>
                    
                    <h2 class="fw-bold mb-2">Booking Confirmed!</h2>
                    <p class="text-muted mb-4">Your flight has been successfully booked and your payment is complete.</p>
                    
                    <div class="card bg-light border-0 p-4 text-start mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <small class="text-muted d-block uppercase fw-bold" style="font-size: 0.75rem;">BOOKING REFERENCE</small>
                                <span class="fs-5 fw-bold text-primary"><?= h($booking->id) ?></span>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block uppercase fw-bold" style="font-size: 0.75rem;">STATUS</small>
                                <span class="badge bg-success px-3 py-2 rounded-pill">Confirmed</span>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block uppercase fw-bold" style="font-size: 0.75rem;">PAYMENT METHOD</small>
                                <span class="fs-6 fw-bold"><?= h($booking->payment_method) ?></span>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h6 class="fw-bold mb-3"><i class="bi bi-airplane-engines me-2"></i>Departure Flight</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fs-5 fw-bold"><?= h($booking->flight->origin_airport?->city) ?> (<?= h($booking->flight->origin_airport?->airport_code) ?>)</div>
                                        <div class="small text-muted"><?= h($booking->flight->departure_time?->format('D, d M Y, H:i')) ?></div>
                                    </div>
                                    <div class="text-center px-4">
                                        <i class="bi bi-arrow-right fs-4 text-muted"></i>
                                    </div>
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold"><?= h($booking->flight->dest_airport?->city) ?> (<?= h($booking->flight->dest_airport?->airport_code) ?>)</div>
                                        <div class="small text-muted"><?= h($booking->flight->arrival_time?->format('D, d M Y, H:i')) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="p-3 bg-white rounded border d-flex justify-content-between">
                                    <span class="small text-muted">Flight Number</span>
                                    <span class="fw-bold"><?= h($booking->flight->flight_number) ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <?php if(isset($returnBooking) && $returnBooking): ?>
                        <hr class="my-4">
                        <h6 class="fw-bold mb-3"><i class="bi bi-airplane-engines me-2"></i>Return Flight</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fs-5 fw-bold"><?= h($returnBooking->flight->origin_airport?->city) ?> (<?= h($returnBooking->flight->origin_airport?->airport_code) ?>)</div>
                                        <div class="small text-muted"><?= h($returnBooking->flight->departure_time?->format('D, d M Y, H:i')) ?></div>
                                    </div>
                                    <div class="text-center px-4">
                                        <i class="bi bi-arrow-right fs-4 text-muted"></i>
                                    </div>
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold"><?= h($returnBooking->flight->dest_airport?->city) ?> (<?= h($returnBooking->flight->dest_airport?->airport_code) ?>)</div>
                                        <div class="small text-muted"><?= h($returnBooking->flight->arrival_time?->format('D, d M Y, H:i')) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="p-3 bg-white rounded border d-flex justify-content-between">
                                    <span class="small text-muted">Flight Number</span>
                                    <span class="fw-bold"><?= h($returnBooking->flight->flight_number) ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <hr class="my-4">
                         
                        <h6 class="fw-bold mb-3"><i class="bi bi-person me-2"></i>Lead Passenger</h6>
                        <div class="d-flex align-items-center bg-white p-3 rounded border">
                            <i class="bi bi-person-circle fs-4 text-secondary me-3"></i>
                            <div>
                                <div class="fw-bold"><?= h($booking->passenger->full_name) ?></div>
                                <div class="small text-muted"><?= h($booking->passenger->phone_number) ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                         <?= $this->Html->link('Back to Home', ['controller' => 'Pages', 'action' => 'display', 'home'], ['class' => 'btn btn-primary py-3 fw-bold']) ?>
                    </div>
                </div>
                
                <p class="small text-muted">A confirmation email has been sent to your registered email address.</p>
                
            </div>
        </div>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<!-- Hexagon Background Section -->
<div class="hexagon-bg">
    <div class="hexagon-shape hex-1"></div>
    <div class="hexagon-shape hex-2"></div>
    <div class="hexagon-shape hex-3"></div>
    <div class="hexagon-shape hex-4"></div>
    <div class="hexagon-shape hex-5"></div>
    <div class="hexagon-shape hex-6"></div>

<!-- Booking Progress Indicator -->
<div class="booking-progress">
    <div class="progress-steps">
        <div class="progress-step completed">
            <div class="step-circle"><i class="bi bi-check"></i></div>
            <div class="step-label">Search</div>
        </div>
        <div class="step-connector completed"></div>
        <div class="progress-step completed">
            <div class="step-circle"><i class="bi bi-check"></i></div>
            <div class="step-label">Details</div>
        </div>
        <div class="step-connector completed"></div>
        <div class="progress-step completed">
            <div class="step-circle"><i class="bi bi-check"></i></div>
            <div class="step-label">Payment</div>
        </div>
        <div class="step-connector completed"></div>
        <div class="progress-step active">
            <div class="step-circle"><i class="bi bi-check"></i></div>
            <div class="step-label">Confirmed</div>
        </div>
    </div>
</div>

<div class="bg-light min-vh-100 py-5" style="position: relative; z-index: 1;">
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
                         
                        <h6 class="fw-bold mb-3"><i class="bi bi-people me-2"></i>Passengers (<?= count($allPassengers ?? []) ?>)</h6>
                        <?php foreach (($allPassengers ?? [$booking->passenger]) as $index => $pax): ?>
                        <div class="d-flex align-items-center bg-white p-3 rounded border <?= $index > 0 ? 'mt-2' : '' ?>">
                            <i class="bi bi-person-circle fs-4 text-secondary me-3"></i>
                            <div class="flex-grow-1">
                                <div class="fw-bold"><?= h($pax->full_name) ?></div>
                                <div class="small text-muted"><?= h($pax->phone_number ?? '-') ?></div>
                            </div>
                            <div class="me-2">
                                <?php if (!empty($pax->seat_number)): ?>
                                    <span class="badge bg-primary">Seat <?= h($pax->seat_number) ?></span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <span class="badge bg-secondary"><?= h($pax->type ?? 'Adult') ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="d-grid gap-2">
                         <?php 
                         $receiptUrl = ['action' => 'downloadReceipt', $booking->id];
                         if (isset($returnBooking) && $returnBooking) {
                             $receiptUrl['?'] = ['return_id' => $returnBooking->id];
                         }
                         ?>
                         <?= $this->Html->link(
                             '<i class="bi bi-download me-2"></i>Download Receipt', 
                             $receiptUrl, 
                             ['class' => 'btn btn-outline-primary py-3 fw-bold', 'escape' => false]
                         ) ?>
                         <?= $this->Html->link('Back to Home', ['controller' => 'Pages', 'action' => 'display', 'home'], ['class' => 'btn btn-primary py-3 fw-bold']) ?>
                    </div>
                </div>
                
                <p class="small text-muted">A confirmation email has been sent to your registered email address.</p>
                
            </div>
        </div>
    </div>
</div>
</div><!-- End Hexagon Background Section -->

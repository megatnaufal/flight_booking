<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var array $departureFlightData
 * @var array $returnFlightData
 * @var float $totalPrice
 */
?>
<div class="bg-light min-vh-100 pb-5">
    
    <!-- Header/Nav handled by layout -->
    
    <div class="container py-4">
        
        <div class="row">
            <!-- Left Column: Payment Methods -->
            <div class="col-md-8">
                <h5 class="fw-bold mb-3">Payment Methods</h5>
                
                <?= $this->Form->create(null, ['url' => ['action' => 'complete', $booking->id]]) ?>
                
                <div class="accordion shadow-sm border-0" id="paymentAccordion">
                    
                    <!-- Card Option -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCard" aria-expanded="true">
                                <div class="d-flex align-items-center w-100 justify-content-between pe-3">
                                    <span>Credit/Debit Card</span>
                                    <div>
                                        <i class="bi bi-credit-card-2-front fs-5 text-primary"></i>
                                        <i class="bi bi-credit-card fs-5 text-danger ms-2"></i>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseCard" class="accordion-collapse collapse show" data-bs-parent="#paymentAccordion">
                            <div class="accordion-body bg-light">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label small text-muted">Card Number</label>
                                        <input type="text" class="form-control" placeholder="0000 0000 0000 0000">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small text-muted">Valid Until</label>
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small text-muted">CVV</label>
                                        <input type="text" class="form-control" placeholder="123">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small text-muted">Card Holder Name</label>
                                        <input type="text" class="form-control" placeholder="Name on Card">
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" name="payment_method" value="Credit/Debit Card" class="btn btn-red-theme w-100 py-3 fw-bold rounded">Pay with Card</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Online Banking Option -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBank" aria-expanded="false">
                                 <div class="d-flex align-items-center w-100 justify-content-between pe-3">
                                    <span>Internet Banking</span>
                                    <span class="text-secondary small">Show</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseBank" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                            <div class="accordion-body bg-light">
                                <div class="row g-2">
                                    <?php 
                                    $banks = [
                                        'Maybank2u' => ['logo' => 'https://www.google.com/s2/favicons?domain=maybank2u.com.my&sz=64', 'label' => 'Maybank2u'],
                                        'CIMB Clicks' => ['logo' => 'https://www.google.com/s2/favicons?domain=cimbclicks.com.my&sz=64', 'label' => 'CIMB Clicks'],
                                        'Public Bank' => ['logo' => 'https://www.google.com/s2/favicons?domain=pbebank.com&sz=64', 'label' => 'Public Bank'],
                                        'RHB Now' => ['logo' => 'https://www.google.com/s2/favicons?domain=rhbgroup.com&sz=64', 'label' => 'RHB Now'],
                                        'AmOnline' => ['logo' => 'https://www.google.com/s2/favicons?domain=ambank.com.my&sz=64', 'label' => 'AmOnline'],
                                        'Hong Leong Connect' => ['logo' => 'https://www.google.com/s2/favicons?domain=hlb.com.my&sz=64', 'label' => 'Hong Leong'],
                                    ];
                                    foreach($banks as $value => $bank): 
                                    ?>
                                    <div class="col-4 col-md-3">
                                        <div class="bg-white p-2 text-center border rounded small h-100 d-flex flex-column align-items-center justify-content-center">
                                            <label class="w-100 cursor-pointer">
                                                <input type="radio" name="bank_name" value="<?= $value ?>" class="mb-2">
                                                <div class="mb-1" style="height: 35px; display: flex; align-items: center; justify-content: center;">
                                                    <img src="<?= $bank['logo'] ?>" alt="<?= $bank['label'] ?>" style="max-height: 32px; max-width: 100%; object-fit: contain;">
                                                </div>
                                                <div class="fw-bold text-truncate" style="font-size: 0.7rem;"><?= $bank['label'] ?></div>
                                            </label>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    
                                    <div class="col-12 mt-4">
                                        <button type="submit" name="payment_method" value="Internet Banking" class="btn btn-red-theme w-100 py-3 fw-bold rounded">Pay with Online Banking</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?= $this->Form->end() ?>
            </div>

            <!-- Right Column: Summary -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        
                        <!-- Header Info -->
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <div class="text-muted small">Airpaz Code</div>
                            <div class="fw-bold fs-5"><?= h($booking->id) ?></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <div class="text-muted small">Payment Status</div>
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Need Payment</span>
                        </div>
                        
                        <!-- Price Detail -->
                        <div class="mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold mb-3">Price Detail</h6>
                             <div class="d-flex justify-content-between align-items-center">
                                <div class="fw-bold fs-5">Total Price</div>
                                <div class="fw-bold fs-4 text-success">RM <?= number_format($totalPrice, 2) ?></div>
                            </div>
                            <div class="text-end small text-muted">Include Tax</div>
                        </div>

                        <!-- Flight Summary -->
                        <div class="mb-4 pb-3 border-bottom">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="fw-bold mb-0">Flight Summary</h6>
                                <!-- Removed Detail Button -->
                            </div>
                            
                            <!-- Departure -->
                            <div class="mb-3">
                                <div class="small fw-bold text-muted">Departure Flight</div>
                                <div class="fw-bold small">
                                    <?= h($departureFlightData['origin_airport_code']) ?> - <?= h($departureFlightData['dest_airport_code']) ?>
                                    <span class="fw-normal text-muted mx-1">|</span> Direct
                                </div>
                                <div class="small text-muted">
                                    <?= (new \DateTime($departureFlightData['departure_time']))->format('D, d M Y') ?> | <?= (new \DateTime($departureFlightData['departure_time']))->format('H:i') ?> - <?= (new \DateTime($departureFlightData['arrival_time']))->format('H:i') ?>
                                </div>
                            </div>

                            <!-- Return (if any) -->
                            <?php if ($returnFlightData): ?>
                            <div class="mb-3">
                                <div class="small fw-bold text-muted">Return Flight</div>
                                <div class="fw-bold small">
                                    <?= h($returnFlightData['origin_airport_code']) ?> - <?= h($returnFlightData['dest_airport_code']) ?>
                                    <span class="fw-normal text-muted mx-1">|</span> Direct
                                </div>
                                <div class="small text-muted">
                                    <?= (new \DateTime($returnFlightData['departure_time']))->format('D, d M Y') ?> | <?= (new \DateTime($returnFlightData['departure_time']))->format('H:i') ?> - <?= (new \DateTime($returnFlightData['arrival_time']))->format('H:i') ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Passengers -->
                        <div class="">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="fw-bold mb-0">Passengers</h6>
                                <!-- Removed Detail Button -->
                            </div>
                             <?php foreach($passengerList as $pax): ?>
                             <div class="d-flex justify-content-between small text-muted mb-1">
                                <div><?= h($pax['name']) ?></div>
                                <div><?= h($pax['type']) ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .cursor-pointer { cursor: pointer; }
    .btn-red-theme {
        background-color: #dc3545;
        color: white;
    }
    .btn-red-theme:hover {
        background-color: #bb2d3b;
        color: white;
    }
</style>

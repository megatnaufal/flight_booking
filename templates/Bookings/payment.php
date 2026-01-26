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
    
    <div class="flight-search-header bg-white shadow-sm py-3 mb-4" style="background: #ffffff !important;">
        <div class="container">
            <h4 class="mb-0 fw-bold text-dark">Payment Methods</h4>
        </div>
    </div>

    <div class="container pb-4 pt-1">
        
        <div class="row">
            <!-- Left Column: Payment Methods -->
            <div class="col-md-8">
                <!-- Title moved to header -->
                
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
                                        <input type="text" name="card_number" class="form-control" placeholder="0000 0000 0000 0000" 
                                            required
                                            pattern="[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}"
                                            maxlength="19"
                                            title="Please enter 16 digits"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\d{4})(?=\d)/g, '$1 ').substring(0, 19)">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small text-muted">Valid Until</label>
                                        <input type="text" name="valid_until" class="form-control" placeholder="MM/YY"
                                            required
                                            pattern="[0-9]{2}/[0-9]{2}"
                                            maxlength="5"
                                            title="Please enter in MM/YY format"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^(\d{2})(\d)/, '$1/$2').substring(0, 5)">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small text-muted">CVV</label>
                                        <input type="text" name="cvv" class="form-control" placeholder="123"
                                            required
                                            pattern="[0-9]{3}"
                                            maxlength="3"
                                            minlength="3"
                                            title="Please enter exactly 3 digits"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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

<footer class="footer-section">
    <div class="container">
        <div class="text-center mb-5 pb-4 border-bottom">
            <p class="text-muted small fw-bold mb-3">Accepted Payment Methods</p>
            <div class="d-flex flex-wrap justify-content-center gap-4 opacity-50">
                <span class="fw-bold">VISA</span> <span class="fw-bold">MasterCard</span> 
                <span class="fw-bold">PayPal</span> <span class="fw-bold">Maybank</span>
                <span class="fw-bold">CIMB</span> <span class="fw-bold">HSBC</span>
                <span class="fw-bold">UOB</span> <span class="fw-bold">BSN</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <h6 class="footer-title">FlyHigh</h6>
                <a href="#" class="footer-link">Home</a>
                <a href="#" class="footer-link">About Us</a>
                <a href="#" class="footer-link">FlyHigh Blog</a>
                <a href="#" class="footer-link">Careers</a>
            </div>
            <div class="col-md-2">
                <h6 class="footer-title">Account</h6>
                <a href="#" class="footer-link">Sign in / Register</a>
                <a href="#" class="footer-link">Forgot Password</a>
            </div>
            <div class="col-md-2">
                <h6 class="footer-title">Support</h6>
                <a href="#" class="footer-link">Help Center</a>
                <a href="#" class="footer-link">How to Book</a>
                <a href="#" class="footer-link">Terms & Conditions</a>
            </div>
            <div class="col-md-2 text-center">
                <h6 class="footer-title">Follow us</h6>
                <div class="d-flex justify-content-center gap-2">
                    <i class="bi bi-facebook fs-5 text-secondary"></i>
                    <i class="bi bi-instagram fs-5 text-secondary"></i>
                    <i class="bi bi-twitter-x fs-5 text-secondary"></i>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <h6 class="footer-title">Our App</h6>
                <div class="mb-2"><span class="badge bg-dark p-2 w-75">Get it on Google Play</span></div>
                <div><span class="badge bg-dark p-2 w-75">Download on App Store</span></div>
            </div>
        </div>
        
        <div class="text-center mt-5 py-4 border-top">
            <p class="text-muted small mb-1">Copyright 2026 FlyHigh.com. All rights reserved.</p>
            <p class="text-muted small" style="font-size: 0.65rem;">Global Airlines Holiday Sdn Bhd Bhd 105929-H</p>
        </div>
    </div>
</footer>

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const collapseCard = document.getElementById('collapseCard');
        const collapseBank = document.getElementById('collapseBank');
        
        // Function to toggle inputs
        function toggleInputs(container, enable) {
            const inputs = container.querySelectorAll('input');
            inputs.forEach(input => {
                input.disabled = !enable;
            });
        }

        // Initially check implementation
        if (collapseBank && collapseBank.classList.contains('show')) {
            if (collapseCard) toggleInputs(collapseCard, false);
        }

        // Listen for events
        if (collapseBank) {
            collapseBank.addEventListener('show.bs.collapse', function () {
                if (collapseCard) toggleInputs(collapseCard, false);
            });
        }

        if (collapseCard) {
            collapseCard.addEventListener('show.bs.collapse', function () {
                toggleInputs(collapseCard, true);
            });
        }
    });
</script>

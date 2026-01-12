<?php
/**
 * @var \App\View\AppView $this
 * @var array $searchResults
 * @var array $departureFlight
 */
$this->Html->css('flights', ['block' => true]);
?>

<div class="flight-search-header">
    <div class="container">
        <?php 
            // Inverted for Return
            $destId = $departureFlight['origin_airport_id'];
            $originId = $departureFlight['dest_airport_id'];
            
            $originName = $originId && isset($airports[$originId]) ? $airports[$originId] : 'Origin';
            $destName = $destId && isset($airports[$destId]) ? $airports[$destId] : 'Destination';
            
            $depDate = $this->request->getQuery('departure');
            $formattedDepDate = $depDate ? (new \DateTime($depDate))->format('D d M') : 'Date';

            $class = $this->request->getQuery('flight_class', 'Economy');
            
            $paxAdult = (int)$this->request->getQuery('passengers_adult', 1);
            $paxChild = (int)$this->request->getQuery('passengers_child', 0);
            $paxInfant = (int)$this->request->getQuery('passengers_infant', 0);
            $totalPax = $paxAdult + $paxChild + $paxInfant;
        ?>

        <!-- Summary Card -->
        <div class="bg-white rounded p-3 d-flex justify-content-between align-items-center shadow-sm" id="searchSummaryCard">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-airplane-engines text-muted fs-4"></i>
                <div class="vl border-start mx-2" style="height: 40px;"></div>
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge bg-success">Return Flight</span>
                        <h6 class="mb-0 fw-bold text-dark"><?= h($originName) ?></h6>
                        <i class="bi bi-arrow-right text-muted small"></i>
                        <h6 class="mb-0 fw-bold text-dark"><?= h($destName) ?></h6>
                    </div>
                    <div class="text-muted small">
                        <?= h($formattedDepDate) ?> <span class="mx-1">|</span> <?= $totalPax ?> Pax <span class="mx-1">|</span> <?= h($class) ?>
                    </div>
                </div>
            </div>
             <!-- Disable changing search from here for now to avoid complexity -->
        </div>
    </div>
</div>

<div class="container pb-5 mt-4">
    <div class="row">
        <!-- Sidebar Filter (Same as Search mostly) -->
        <div class="col-md-3">
            <div class="bg-white p-3 rounded border mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Filter</h6>
                    <a href="#" class="text-danger small text-decoration-none">Reset All</a>
                </div>

                <div class="filter-sidebar">
                    <form id="filterForm" action="<?= $this->Url->build(['action' => 'searchReturn']) ?>" method="get">
                        <!-- Preserve Params -->
                         <?php foreach ($this->request->getQueryParams() as $key => $value): ?>
                            <?php if (!in_array($key, ['airlines', 'time'])): ?>
                                <input type="hidden" name="<?= h($key) ?>" value="<?= h($value) ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <div class="filter-group border-0">
                            <div class="filter-title">Airlines <i class="bi bi-chevron-up"></i></div>
                            <?php 
                                $selectedAirlines = $this->request->getQuery('airlines', []); 
                                if (!is_array($selectedAirlines)) $selectedAirlines = [];
                            ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="airlines[]" value="AirAsia" id="airasia" <?= in_array('AirAsia', $selectedAirlines) ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label small" for="airasia">AirAsia</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="airlines[]" value="Batik Air Malaysia" id="batik" <?= in_array('Batik Air Malaysia', $selectedAirlines) ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label small" for="batik">Batik Air Malaysia</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="airlines[]" value="Firefly" id="firefly" <?= in_array('Firefly', $selectedAirlines) ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label small" for="firefly">FireFly</label>
                            </div>
                             <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="airlines[]" value="Malaysia Airlines" id="mas" <?= in_array('Malaysia Airlines', $selectedAirlines) ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label small" for="mas">Malaysia Airlines</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Selected Departure Flight Summary (Moved Here) -->
            <div class="card border-primary mb-4 bg-light">
                <div class="card-body p-3">
                    <h6 class="text-primary fw-bold mb-3"><i class="bi bi-check-circle-fill me-2"></i> Your Departure Flight</h6>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <img src="<?= h($departureFlight['airline_logo']) ?>" class="rounded-circle bg-white" style="width: 40px; height: 40px; padding: 5px;">
                            <div>
                                <div class="fw-bold"><?= h($departureFlight['airline_name']) ?></div>
                                <div class="small text-muted"><?= h($departureFlight['duration_text']) ?></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold fs-5"><?= (new \DateTime($departureFlight['departure_time']))->format('H:i') ?></div>
                             <div class="small text-muted"><?= h($airports[$departureFlight['origin_airport_id']] ?? '') ?></div>
                        </div>
                        <div class="text-muted small"><i class="bi bi-arrow-right"></i></div>
                        <div class="text-center">
                            <div class="fw-bold fs-5"><?= (new \DateTime($departureFlight['arrival_time']))->format('H:i') ?></div>
                             <div class="small text-muted"><?= h($airports[$departureFlight['dest_airport_id']] ?? '') ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="mb-3 text-dark fw-normal" style="font-size: 1.15rem;">Select Return Flight to <span class="fw-bold"><?= h($destName) ?></span></h6>

            <!-- Flight List -->
            <?php if (empty($searchResults)): ?>
                <div class="alert alert-warning text-center">
                    <h5 class="fw-bold"><i class="bi bi-exclamation-circle me-2"></i> No flights found</h5>
                    <p class="mb-0">Please try different dates.</p>
                </div>
            <?php else: ?>
                <?php foreach ($searchResults as $flight): ?>
                <div class="flight-result-card p-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="badge bg-white border text-primary mb-2 px-2"><?= h($class) ?></div>
                            <div class="d-flex align-items-center mb-2">
                                <img src="<?= h($flight->airline_logo) ?>" alt="Logo" class="airline-logo-sm bg-light rounded-circle">
                                <span class="small fw-bold"><?= h($flight->airline_name) ?></span>
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="d-flex align-items-center justify-content-between text-center">
                                <div>
                                    <div class="flight-time"><?= $flight->departure_time->format('H:i') ?></div>
                                    <div class="small text-muted"><?= h($flight->origin_airport->airport_code) ?></div>
                                </div>
                                <div class="px-2">
                                    <div class="flight-duration"><?= h($flight->duration_text) ?></div>
                                    <div class="small text-muted">Direct</div>
                                </div>
                                <div>
                                    <div class="flight-time"><?= $flight->arrival_time->format('H:i') ?></div>
                                    <div class="small text-muted"><?= h($flight->dest_airport->airport_code) ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 text-end">
                            <div class="flight-price-label">Start from</div>
                            <div class="flight-price-main">RM <?= number_format($flight->base_price, 2) ?></div>
                            <div class="flight-price-total mb-2">Total RM <?= number_format($flight->base_price * 1.1, 2) ?> / Pax</div>
                            
                            <form action="<?= $this->Url->build(['action' => 'selectReturn']) ?>" method="post">
                                <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
                                
                                <!-- Flight Details -->
                                <input type="hidden" name="origin_airport_id" value="<?= h($flight->origin_airport->id) ?>">
                                <input type="hidden" name="dest_airport_id" value="<?= h($flight->dest_airport->id) ?>">
                                <input type="hidden" name="airline_name" value="<?= h($flight->airline_name) ?>">
                                <input type="hidden" name="airline_logo" value="<?= h($flight->airline_logo) ?>">
                                <input type="hidden" name="departure_time" value="<?= $flight->departure_time->format('Y-m-d H:i:s') ?>">
                                <input type="hidden" name="arrival_time" value="<?= $flight->arrival_time->format('Y-m-d H:i:s') ?>">
                                <input type="hidden" name="duration_text" value="<?= h($flight->duration_text) ?>">
                                <input type="hidden" name="base_price" value="<?= h($flight->base_price) ?>">
                                
                                <button type="submit" class="btn btn-red-theme px-4 py-2 rounded">Select</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>

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

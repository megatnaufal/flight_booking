<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var array $departureFlightData
 * @var array|null $returnFlightData
 * @var int $totalPax
 * @var float $totalPrice
 * @var float $taxes
 */
$this->Html->css('flights', ['block' => true]);
?>
<div class="flight-search-header bg-white shadow-sm py-3 mb-4">
    <div class="container">
        <h4 class="mb-0 fw-bold text-dark">Trip Summary</h4>
    </div>
</div>

<div class="container pb-5">
    <?= $this->Form->create($booking) ?>
    <div class="row">
        <!-- Left Column: Flight Summaries -->
        <div class="col-md-8">
            
            <!-- Departure Flight -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Selected Departure Flight</div>
                            <h5 class="fw-bold mb-1">
                                <?= h($departureFlightData['origin_airport_code'] ?? 'KUL') ?> 
                                <i class="bi bi-arrow-right mx-2"></i> 
                                <?= h($departureFlightData['dest_airport_code'] ?? 'LGK') ?>
                            </h5>
                            <div class="text-muted small">
                                <?= (new \DateTime($departureFlightData['departure_time']))->format('D, d M Y') ?> 
                                | <?= (new \DateTime($departureFlightData['departure_time']))->format('H:i') ?> - <?= (new \DateTime($departureFlightData['arrival_time']))->format('H:i') ?> 
                                | Direct
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?= h($departureFlightData['airline_logo']) ?>" class="mb-2" style="width: 40px;">
                            <div class="fw-bold text-danger"><?= h($departureFlightData['airline_name']) ?></div>
                            <div class="small text-muted">Economy</div>
                        </div>
                        
                        <div class="col-md-9">
                            <div class="position-relative py-2">
                                <!-- Vertical Line visual constructed with flex -->
                                <div class="border-start border-2 border-secondary ms-2 ps-4 position-relative">
                                    <!-- Top Dot -->
                                    <span class="position-absolute top-0 start-0 translate-middle bg-secondary rounded-circle" style="width: 10px; height: 10px;"></span>
                                    
                                    <!-- Content Top -->
                                    <div class="mb-4"> <!-- Increased margin -->
                                        <div class="row">
                                            <div class="col-3 fw-bold fs-5"><?= (new \DateTime($departureFlightData['departure_time']))->format('H:i') ?></div>
                                            <div class="col-9">
                                                 <div class="fw-bold fs-6"><?= h($departureFlightData['origin_city'] ?? $departureFlightData['origin_airport_code']) ?> (<?= h($departureFlightData['origin_airport_code']) ?>)</div>
                                                 <div class="small text-muted"><?= (new \DateTime($departureFlightData['departure_time']))->format('d M Y') ?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Middle Duration (Relative) -->
                                     <div class="mb-4 text-muted small ms-2"> <!-- Relative positioning, no overlap -->
                                        <i class="bi bi-clock"></i> <?= h($departureFlightData['duration_text']) ?>
                                     </div>

                                    <!-- Content Bottom -->
                                    <div>
                                        <div class="row">
                                            <div class="col-3 fw-bold fs-5"><?= (new \DateTime($departureFlightData['arrival_time']))->format('H:i') ?></div>
                                            <div class="col-9">
                                                <div class="fw-bold fs-6"><?= h($departureFlightData['dest_city'] ?? $departureFlightData['dest_airport_code']) ?> (<?= h($departureFlightData['dest_airport_code']) ?>)</div>
                                                <div class="small text-muted"><?= (new \DateTime($departureFlightData['arrival_time']))->format('d M Y') ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Bottom Dot -->
                                    <span class="position-absolute bottom-0 start-0 translate-middle bg-secondary rounded-circle" style="width: 10px; height: 10px; top: 100%;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Return Flight (if exists) -->
            <?php if ($returnFlightData): ?>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Selected Return Flight</div>
                            <h5 class="fw-bold mb-1">
                                <?= h($returnFlightData['origin_airport_code'] ?? 'LGK') ?> 
                                <i class="bi bi-arrow-right mx-2"></i> 
                                <?= h($returnFlightData['dest_airport_code'] ?? 'KUL') ?>
                            </h5>
                            <div class="text-muted small">
                                <?= (new \DateTime($returnFlightData['departure_time']))->format('D, d M Y') ?> 
                                | <?= (new \DateTime($returnFlightData['departure_time']))->format('H:i') ?> - <?= (new \DateTime($returnFlightData['arrival_time']))->format('H:i') ?> 
                                | Direct
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?= h($returnFlightData['airline_logo']) ?>" class="mb-2" style="width: 40px;">
                            <div class="fw-bold text-danger"><?= h($returnFlightData['airline_name']) ?></div>
                            <div class="small text-muted">Economy</div>
                        </div>
                        
                        <div class="col-md-9">
                            <div class="position-relative py-2">
                                <div class="border-start border-2 border-secondary ms-2 ps-4 position-relative">
                                     <span class="position-absolute top-0 start-0 translate-middle bg-secondary rounded-circle" style="width: 10px; height: 10px;"></span>
                                    
                                    <div class="mb-4">
                                        <div class="row">
                                            <div class="col-3 fw-bold fs-5"><?= (new \DateTime($returnFlightData['departure_time']))->format('H:i') ?></div>
                                            <div class="col-9">
                                                <div class="fw-bold fs-6"><?= h($returnFlightData['origin_city'] ?? $returnFlightData['origin_airport_code']) ?> (<?= h($returnFlightData['origin_airport_code']) ?>)</div>
                                                <div class="small text-muted"><?= (new \DateTime($returnFlightData['departure_time']))->format('d M Y') ?></div>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="mb-4 text-muted small ms-2">
                                        <i class="bi bi-clock"></i> <?= h($returnFlightData['duration_text']) ?>
                                     </div>

                                    <div>
                                        <div class="row">
                                            <div class="col-3 fw-bold fs-5"><?= (new \DateTime($returnFlightData['arrival_time']))->format('H:i') ?></div>
                                            <div class="col-9">
                                                <div class="fw-bold fs-6"><?= h($returnFlightData['dest_city'] ?? $returnFlightData['dest_airport_code']) ?> (<?= h($returnFlightData['dest_airport_code']) ?>)</div>
                                                <div class="small text-muted"><?= (new \DateTime($returnFlightData['arrival_time']))->format('d M Y') ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                     <span class="position-absolute bottom-0 start-0 translate-middle bg-secondary rounded-circle" style="width: 10px; height: 10px; top: 100%;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Passenger Details Section -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold py-3">
                    Passenger Details
                </div>
                <!-- Warning/Info Alert similar to image -->
                <div class="alert alert-warning border-0 rounded-0 mb-0 d-flex align-items-center gap-2 small">
                     <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                     <div>
                        Enter the passenger's name as written on the passport/ ID Card. Spelling or punctuation errors may cause rejection of boarding or change fees.
                     </div>
                </div>

                <div class="card-body p-4">
                        
                    <!-- Adults -->
                    <?php for ($i = 1; $i <= $paxAdult; $i++): ?>
                        <h6 class="fw-bold mb-3 text-primary mt-<?= $i > 1 ? '4' : '0' ?>">Adult <?= $i ?></h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">First/ Given Name*</label>
                                <?= $this->Form->text("passengers.adult.$i.first_name", ['class' => 'form-control', 'required' => true]) ?>
                                <div class="form-text small text-muted"><i class="bi bi-info-circle"></i> (e.g. Ali)</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Last Name/ Surname*</label>
                                <?= $this->Form->text("passengers.adult.$i.last_name", ['class' => 'form-control', 'required' => true]) ?>
                                <div class="form-text small text-muted"><i class="bi bi-info-circle"></i> (e.g. Bin Abu)</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Date of Birth*</label>
                                <?= $this->Form->date("passengers.adult.$i.dob", ['class' => 'form-control', 'required' => true, 'max' => date('Y-m-d')]) ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Mobile Number*</label>
                                <?= $this->Form->text("passengers.adult.$i.phone_number", [
                                    'class' => 'form-control', 
                                    'placeholder' => '0123456789', 
                                    'required' => true,
                                    'pattern' => '[0-9]{10}',
                                    'maxlength' => '10',
                                    'minlength' => '10',
                                    'title' => 'Please enter exactly 10 digits',
                                    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
                                ]) ?>
                                <div class="form-text small text-muted"><i class="bi bi-info-circle"></i> (10 digits only, e.g. 0123456789)</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Email Address*</label>
                                <?= $this->Form->email("passengers.adult.$i.email", ['class' => 'form-control', 'placeholder' => 'email@example.com', 'required' => true]) ?>
                            </div>
                        </div>
                    <?php endfor; ?>

                    <!-- Children -->
                    <?php for ($i = 1; $i <= $paxChild; $i++): ?>
                        <h6 class="fw-bold mb-3 text-primary mt-4">Child <?= $i ?></h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">First/ Given Name*</label>
                                <?= $this->Form->text("passengers.child.$i.first_name", ['class' => 'form-control', 'required' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Last Name/ Surname*</label>
                                <?= $this->Form->text("passengers.child.$i.last_name", ['class' => 'form-control', 'required' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Date of Birth*</label>
                                <?= $this->Form->date("passengers.child.$i.dob", ['class' => 'form-control', 'required' => true, 'max' => date('Y-m-d')]) ?>
                            </div>
                        </div>
                    <?php endfor; ?>

                    <!-- Infants -->
                    <?php for ($i = 1; $i <= $paxInfant; $i++): ?>
                        <h6 class="fw-bold mb-3 text-primary mt-4">Infant <?= $i ?></h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">First/ Given Name*</label>
                                <?= $this->Form->text("passengers.infant.$i.first_name", ['class' => 'form-control', 'required' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Last Name/ Surname*</label>
                                <?= $this->Form->text("passengers.infant.$i.last_name", ['class' => 'form-control', 'required' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Date of Birth*</label>
                                <?= $this->Form->date("passengers.infant.$i.dob", ['class' => 'form-control', 'required' => true, 'max' => date('Y-m-d')]) ?>
                            </div>
                        </div>
                    <?php endfor; ?>

                </div>
            </div>

        </div>

        <!-- Right Column: Price Detail -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Price Detail</h5>
                    
                    <!-- Breakdown -->
                    <div class="d-flex justify-content-between mb-2">
                         <div class="fw-bold text-dark">
                             <?= h($departureFlightData['origin_airport_code'] ?? 'KUL') ?> 
                             <i class="bi bi-arrow-left-right mx-1"></i> 
                             <?= h($departureFlightData['dest_airport_code'] ?? 'LGK') ?>
                         </div>
                         <div class="fw-bold">RM <?= number_format($totalPrice, 2) ?></div>
                    </div>
                    
                    <!-- Adult Price -->
                    <div class="d-flex justify-content-between mb-1 small text-muted">
                        <div>Adult (x<?= $paxAdult ?>)</div>
                        <div>RM <?= number_format($basePerAdult * $paxAdult, 2) ?></div>
                    </div>

                    <!-- Child Price -->
                    <?php if ($paxChild > 0): ?>
                    <div class="d-flex justify-content-between mb-1 small text-muted">
                        <div>Child (x<?= $paxChild ?>)</div>
                        <div>RM <?= number_format($basePerChild * $paxChild, 2) ?></div>
                    </div>
                    <?php endif; ?>

                    <!-- Infant Price -->
                    <?php if ($paxInfant > 0): ?>
                    <div class="d-flex justify-content-between mb-1 small text-muted">
                        <div>Infant (x<?= $paxInfant ?>)</div>
                        <div>RM <?= number_format($basePerInfant * $paxInfant, 2) ?></div>
                    </div>
                    <?php endif; ?>

                     <div class="d-flex justify-content-between mb-3 small text-muted">
                        <div>Tax & Fees</div>
                        <div>RM <?= number_format($totalTaxes, 2) ?></div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="fw-bold fs-5">Total Price</div>
                        <div class="fw-bold fs-4 text-success">RM <?= number_format($totalPrice, 2) ?></div>
                    </div>

                    <button type="submit" class="btn btn-red-theme w-100 py-3 fw-bold rounded shadow-sm">Checkout</button>
                    
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

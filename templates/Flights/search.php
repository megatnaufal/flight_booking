<?php
/**
 * @var \App\View\AppView $this
 * @var array $searchResults
 */
$this->Html->css('flights', ['block' => true]);
?>

<div class="flight-search-header">
    <div class="container">
        <?php 
            $destId = $this->request->getQuery('dest_airport_id');
            $originId = $this->request->getQuery('origin_airport_id');
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
                        <h6 class="mb-0 fw-bold text-dark"><?= h($originName) ?></h6>
                        <i class="bi bi-arrow-right text-muted small"></i>
                        <h6 class="mb-0 fw-bold text-dark"><?= h($destName) ?></h6>
                    </div>
                    <div class="text-muted small">
                        <?= h($formattedDepDate) ?> <span class="mx-1">|</span> <?= $totalPax ?> Passenger<?= $totalPax !== 1 ? 's' : '' ?> <span class="mx-1">|</span> <?= h($class) ?>
                    </div>
                </div>
            </div>
            <button class="btn btn-light text-danger fw-bold border-0 bg-danger-subtle" onclick="toggleSearchForm()">
                <i class="bi bi-pencil-fill me-2"></i>Change Search
            </button>
        </div>

        <!-- Collapsible Form -->
        <div id="flightSearchForm" style="display: none;" class="mt-3">
            <form action="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" method="get">
                <!-- Top Options Row -->
                <div class="d-flex flex-wrap gap-4 mb-3 border-bottom pb-3 align-items-center">
                    <!-- Journey Type -->
                    <div class="dropdown">
                        <button class="btn btn-link text-decoration-none small fw-bold text-white p-0 dropdown-toggle border-end pe-3 custom-dropdown-toggle-white" type="button" id="journeyTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= h($this->request->getQuery('journey_type', 'Round Trip')) ?>
                        </button>
                        <ul class="dropdown-menu shadow border-0" aria-labelledby="journeyTypeDropdown">
                            <li><a class="dropdown-item" href="#" onclick="selectJourney('One Way', this)">One Way</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectJourney('Round Trip', this)">Round Trip</a></li>
                        </ul>
                        <input type="hidden" name="journey_type" id="journeyTypeInput" value="<?= h($this->request->getQuery('journey_type', 'Round Trip')) ?>">
                    </div>
    
                    <!-- Passenger Count -->
                    <div class="dropdown">
                        <button class="btn btn-link text-decoration-none small fw-bold text-white p-0 dropdown-toggle border-end pe-3 custom-dropdown-toggle-white" type="button" id="passengerDropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <span id="passengerLabel"><?= $totalPax ?> Passenger<?= $totalPax !== 1 ? 's' : '' ?></span>
                        </button>
                        <div class="dropdown-menu shadow border-0 p-3" aria-labelledby="passengerDropdown" style="min-width: 280px;">
                            <!-- Adult -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <div class="fw-bold text-dark">Adult</div>
                                    <div class="text-muted small">Age 12+</div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-1 px-2" onclick="updatePassenger('adult', -1)"><i class="bi bi-dash"></i></button>
                                    <span class="fw-bold text-dark mx-2" id="count-adult"><?= $paxAdult ?></span>
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-1 px-2" onclick="updatePassenger('adult', 1)"><i class="bi bi-plus"></i></button>
                                </div>
                            </div>
                            <!-- Child -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <div class="fw-bold text-dark">Child</div>
                                    <div class="text-muted small">Age 2-11</div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-1 px-2" onclick="updatePassenger('child', -1)"><i class="bi bi-dash"></i></button>
                                    <span class="fw-bold text-dark mx-2" id="count-child"><?= $paxChild ?></span>
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-1 px-2" onclick="updatePassenger('child', 1)"><i class="bi bi-plus"></i></button>
                                </div>
                            </div>
                            <!-- Infant -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <div class="fw-bold text-dark">Infant</div>
                                    <div class="text-muted small">&lt; 2 years</div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-1 px-2" onclick="updatePassenger('infant', -1)"><i class="bi bi-dash"></i></button>
                                    <span class="fw-bold text-dark mx-2" id="count-infant"><?= $paxInfant ?></span>
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-1 px-2" onclick="updatePassenger('infant', 1)"><i class="bi bi-plus"></i></button>
                                </div>
                            </div>
                            <div class="text-end pt-2 border-top">
                                <button type="button" class="btn btn-danger btn-sm px-4 fw-bold" onclick="document.getElementById('passengerDropdown').click()">Done</button>
                            </div>
                        </div>
                        <input type="hidden" name="passengers_adult" id="input-adult" value="<?= $paxAdult ?>">
                        <input type="hidden" name="passengers_child" id="input-child" value="<?= $paxChild ?>">
                        <input type="hidden" name="passengers_infant" id="input-infant" value="<?= $paxInfant ?>">
                    </div>
    
                    <!-- Class -->
                    <div class="dropdown">
                        <button class="btn btn-link text-decoration-none small fw-bold text-white p-0 dropdown-toggle custom-dropdown-toggle-white" type="button" id="classDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= h($class) ?>
                        </button>
                        <ul class="dropdown-menu shadow border-0" aria-labelledby="classDropdown">
                            <li><a class="dropdown-item" href="#" onclick="selectClass('Economy', this)">Economy</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectClass('Premium Economy', this)">Premium Economy</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectClass('Business', this)">Business</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectClass('First Class', this)">First Class</a></li>
                        </ul>
                        <input type="hidden" name="flight_class" id="classInput" value="<?= h($class) ?>">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md-3">
                        <div class="input-box">
                            <div class="label-mini">From</div>
                            <select name="origin_airport_id" class="form-control border-0 p-0 shadow-none fw-bold" style="appearance: none;" required>
                                <option value="">Select Origin</option>
                                <?php foreach ($airports as $id => $name): ?>
                                    <option value="<?= $id ?>" <?= $this->request->getQuery('origin_airport_id') == $id ? 'selected' : '' ?>><?= h($name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-box">
                            <div class="label-mini">To</div>
                            <select name="dest_airport_id" class="form-control border-0 p-0 shadow-none fw-bold" style="appearance: none;" required>
                                <option value="">Select Destination</option>
                                <?php foreach ($airports as $id => $name): ?>
                                    <option value="<?= $id ?>" <?= $this->request->getQuery('dest_airport_id') == $id ? 'selected' : '' ?>><?= h($name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-box">
                            <div class="label-mini">Departure</div>
                            <input type="date" name="departure" id="departureDateInput" class="form-control border-0 p-0 shadow-none fw-bold" value="<?= $this->request->getQuery('departure') ?: date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" required onchange="updateReturnMinDate()">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-box">
                            <div class="label-mini">Return</div>
                            <input type="date" name="return" id="returnDateInput" class="form-control border-0 p-0 shadow-none fw-bold" value="<?= $this->request->getQuery('return') ?: date('Y-m-d', strtotime('+1 day')) ?>" min="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-search-red w-100 h-100 py-2"><i class="bi bi-search me-2"></i>Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Date Carousel -->
    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-md-3">
            <div class="bg-white p-3 rounded border mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Filter</h6>
                    <a href="#" class="text-danger small text-decoration-none">Reset All</a>
                </div>

                <div class="filter-sidebar">
                    <form id="filterForm" action="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" method="get">
                        <!-- Preserve Search Params -->
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
                        <div class="filter-group border-0">
                            <div class="filter-title">Departure Time <i class="bi bi-chevron-up"></i></div>
                            <?php $selectedTime = $this->request->getQuery('time', ''); ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input rounded-circle" type="radio" name="time" id="all" value="" <?= $selectedTime == '' ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label small" for="all">All Times</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input rounded-circle" type="radio" name="time" id="early" value="early" <?= $selectedTime == 'early' ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label small" for="early">Early Flight (00:00 - 06:00)</label>
                            </div>
                             <div class="form-check mb-2">
                                <input class="form-check-input rounded-circle" type="radio" name="time" id="morning" value="morning" <?= $selectedTime == 'morning' ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label small" for="morning">Morning Flight (06:00 - 12:00)</label>
                            </div>
                             <div class="form-check mb-2">
                                <input class="form-check-input rounded-circle" type="radio" name="time" id="afternoon" value="afternoon" <?= $selectedTime == 'afternoon' ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label small" for="afternoon">Afternoon Flight (12:00 - 18:00)</label>
                            </div>
                             <div class="form-check mb-2">
                                <input class="form-check-input rounded-circle" type="radio" name="time" id="night" value="night" <?= $selectedTime == 'night' ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label small" for="night">Night Flight (18:00 - 24:00)</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <?php 
                $destId = $this->request->getQuery('dest_airport_id');
                $destName = $destId && isset($airports[$destId]) ? $airports[$destId] : 'Destination';
                
                $depDate = $this->request->getQuery('departure');
                $formattedDate = $depDate ? (new \DateTime($depDate))->format('D, d M Y') : 'Date';

                $paxAdult = (int)$this->request->getQuery('passengers_adult', 1);
                $paxChild = (int)$this->request->getQuery('passengers_child', 0);
                $paxInfant = (int)$this->request->getQuery('passengers_infant', 0);
                $totalPax = $paxAdult + $paxChild + $paxInfant;
            ?>
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h6 class="mb-0 text-dark fw-normal" style="font-size: 1.15rem;">Departure flights to <span class="fw-bold"><?= h($destName) ?></span></h6>
                <div class="text-dark"><?= h($formattedDate) ?> | <?= $totalPax ?> Passenger<?= $totalPax !== 1 ? 's' : '' ?></div>
            </div>

            <!-- Sorting Tabs -->
            <?php 
                $sort = $this->request->getQuery('sort', 'recommended');
                // Helper to generate sort URL keeping other params
                $getSortUrl = function($sortType) {
                    $query = $this->request->getQueryParams();
                    $query['sort'] = $sortType;
                    return $this->Url->build(['controller' => 'Flights', 'action' => 'search', '?' => $query]);
                };
            ?>
            <div class="row g-2 mb-4 sort-tabs">
                <div class="col-md-3">
                    <a href="<?= $getSortUrl('recommended') ?>" class="text-decoration-none">
                        <div class="card <?= $sort === 'recommended' ? 'active' : '' ?> p-2 text-center h-100 justify-content-center">
                            <div class="small fw-bold text-danger">Recommended</div>
                            <div class="fw-bold text-dark">Best Value</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= $getSortUrl('cheapest') ?>" class="text-decoration-none">
                        <div class="card <?= $sort === 'cheapest' ? 'active' : '' ?> p-2 text-center h-100 justify-content-center">
                            <div class="small text-muted">Cheapest</div>
                            <div class="fw-bold text-dark">Low Price</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= $getSortUrl('fastest') ?>" class="text-decoration-none">
                        <div class="card <?= $sort === 'fastest' ? 'active' : '' ?> p-2 text-center h-100 justify-content-center">
                            <div class="small text-muted">Fastest</div>
                            <div class="fw-bold text-dark">Shortest Time</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <div class="card p-2 h-100 justify-content-center align-items-center flex-row gap-2">
                        <i class="bi bi-sort-down"></i> Sort by <i class="bi bi-chevron-down small"></i>
                    </div>
                </div>
            </div>

            <!-- Flight List -->
            <?php if (empty($searchResults)): ?>
                <div class="alert alert-warning text-center">
                    <h5 class="fw-bold"><i class="bi bi-exclamation-circle me-2"></i> No flights found</h5>
                    <p class="mb-0">Please try different dates or airports.</p>
                </div>
            <?php else: ?>
                <?php foreach ($searchResults as $flight): ?>
                <div class="flight-result-card p-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="badge bg-white border text-primary mb-2 px-2"><?= h($this->request->getQuery('flight_class', 'Economy')) ?></div>
                            <div class="d-flex align-items-center mb-2">
                                <img src="<?= h($flight->airline_logo) ?>" alt="Logo" class="airline-logo-sm bg-light rounded-circle">
                                <span class="small fw-bold"><?= h($flight->airline_name) ?></span>
                            </div>
                            <div class="badge bg-light text-primary border border-primary-subtle rounded-pill px-2 py-1" style="font-size: 0.65rem;">
                                <i class="bi bi-info-circle-fill me-1"></i> Included
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
                            <button class="btn btn-red-theme px-4 py-2 rounded">Select</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
    function selectJourney(type, element) {
        document.getElementById('journeyTypeDropdown').innerText = type;
        document.getElementById('journeyTypeInput').value = type;

        // Handle Return Date logic
        const returnInput = document.getElementById('returnDateInput');
        if (type === 'One Way') {
            returnInput.disabled = true;
            returnInput.required = false;
            returnInput.style.opacity = '0.5';
            returnInput.value = ''; 
        } else {
            returnInput.disabled = false;
            returnInput.required = true;
            returnInput.style.opacity = '1';
             if(!returnInput.value) {
                 const depDate = document.getElementById('departureDateInput').value;
                 if(depDate) returnInput.value = depDate;
            }
        }
        updateReturnMinDate();
    }

    function selectClass(type, element) {
        document.getElementById('classDropdown').innerText = type;
        document.getElementById('classInput').value = type;
    }

    function updatePassenger(type, change) {
        const countSpan = document.getElementById('count-' + type);
        const inputField = document.getElementById('input-' + type);
        let count = parseInt(countSpan.innerText);
        
        // Logic: Min 1 adult, Min 0 others
        if (type === 'adult' && count + change < 1) return;
        if (type !== 'adult' && count + change < 0) return;

        // Check max 8 passengers
        const currentTotal = parseInt(document.getElementById('count-adult').innerText) + 
                             parseInt(document.getElementById('count-child').innerText) + 
                             parseInt(document.getElementById('count-infant').innerText);
        if (change > 0 && currentTotal >= 8) return;

        count += change;
        countSpan.innerText = count;
        inputField.value = count;

        updatePassengerLabel();
    }

    function updatePassengerLabel() {
        const adults = parseInt(document.getElementById('count-adult').innerText);
        const children = parseInt(document.getElementById('count-child').innerText);
        const infants = parseInt(document.getElementById('count-infant').innerText);
        const total = adults + children + infants;

        const label = total + ' Passenger' + (total !== 1 ? 's' : '');
        document.getElementById('passengerLabel').innerText = label;
    }

    // Initialize state on load
    document.addEventListener("DOMContentLoaded", function() {
        const type = document.getElementById('journeyTypeInput').value;
        const returnInput = document.getElementById('returnDateInput');
        
        updateReturnMinDate();

        if (type === 'One Way') {
            returnInput.disabled = true;
            returnInput.required = false;
            returnInput.style.opacity = '0.5';
        }
    });

    function updateReturnMinDate() {
        const depInput = document.getElementById('departureDateInput');
        const returnInput = document.getElementById('returnDateInput');
        if (depInput.value) {
            returnInput.min = depInput.value;
            // If return date is before new min, clear it or set to min
            if(returnInput.value && returnInput.value < depInput.value) {
                returnInput.value = depInput.value;
            }
        }
    }

    function toggleSearchForm() {
        const summary = document.getElementById('searchSummaryCard');
        const form = document.getElementById('flightSearchForm');
        
        if (form.style.display === 'none') {
            form.style.display = 'block';
            summary.style.display = 'none';
        } else {
            form.style.display = 'none';
            summary.style.display = 'flex';
        }
    }

    // Form Validation for Same Origin/Dest
    document.querySelector('form').addEventListener('submit', function(e) {
        const origin = document.querySelector('select[name="origin_airport_id"]').value;
        const dest = document.querySelector('select[name="dest_airport_id"]').value;
        
        if (origin && dest && origin === dest) {
            e.preventDefault();
            alert('Origin and Destination airports cannot be the same.');
        }
    });
</script>

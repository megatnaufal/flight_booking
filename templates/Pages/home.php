<?php
/**
 * @var \App\View\AppView $this
 * @var array $recommendations
 */
?>
<style>
    .hero-bg { background-color: #e62129; padding: 40px 0 100px 0; color: white; position: relative; }
    .search-wrapper { margin-top: -70px; position: relative; z-index: 10; }
    .search-card { border-radius: 8px; border: none; box-shadow: 0 4px 25px rgba(0,0,0,0.1); }
    
    .flight-card { border: 1px solid #efefef !important; border-radius: 12px !important; overflow: hidden; transition: box-shadow 0.3s ease; }
    .flight-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .flight-img { height: 130px; object-fit: cover; }
    
    .price-tag { color: #e62129; font-weight: 700; font-size: 0.85rem; }
    .route-text { font-size: 0.9rem; font-weight: 600; color: #333; }
    .from-text { font-size: 0.75rem; color: #6c757d; }
    
    .input-box { border: 1px solid #dee2e6; border-radius: 6px; padding: 14px 20px; background: #fff; }
    .input-box input, .input-box select { font-size: 1.1rem; }
    .label-mini { font-size: 0.8rem; color: #6c757d; text-transform: uppercase; font-weight: bold; margin-bottom: 4px; }
    .btn-search-red { background-color: #e62129; color: white; border: none; font-weight: bold; border-radius: 8px; font-size: 1.1rem; }
    
    /* Footer Styling based on Image 2 */
    .footer-section { background-color: #ffffff; padding-top: 50px; border-top: 1px solid #eee; margin-top: 60px; }
    .footer-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 20px; color: #333; }
    .footer-link { font-size: 0.85rem; color: #666; text-decoration: none; display: block; margin-bottom: 8px; }
    .footer-link:hover { color: #e62129; }
</style>

<div class="hero-bg text-center">
    <div class="container">
        <h1 class="fw-bold mb-2">Find Cheap Flight Tickets for Your Trip</h1>
        <p class="opacity-75">Book Flight Tickets & Enjoy Travel Deals to Your Destination</p>
    </div>
</div>

<div class="container search-wrapper">
    <div class="card search-card p-3 p-lg-4">
        <form action="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" method="get">
            <!-- Top Options Row -->
            <div class="d-flex flex-wrap gap-4 mb-3 border-bottom pb-3 align-items-center">
                <!-- Journey Type -->
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none small fw-bold text-secondary p-0 dropdown-toggle border-end pe-3 custom-dropdown-toggle" type="button" id="journeyTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Round Trip
                    </button>
                    <ul class="dropdown-menu shadow border-0" aria-labelledby="journeyTypeDropdown">
                        <li><a class="dropdown-item active" href="#" onclick="selectJourney('One Way', this)">One Way</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectJourney('Round Trip', this)">Round Trip</a></li>
                    </ul>
                    <input type="hidden" name="journey_type" id="journeyTypeInput" value="Round Trip">
                </div>

                <!-- Passenger Count -->
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none small fw-bold text-secondary p-0 dropdown-toggle border-end pe-3 custom-dropdown-toggle" type="button" id="passengerDropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <span id="passengerLabel">1 Passenger</span>
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
                                <span class="fw-bold text-dark mx-2" id="count-adult">1</span>
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
                                <span class="fw-bold text-dark mx-2" id="count-child">0</span>
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
                                <span class="fw-bold text-dark mx-2" id="count-infant">0</span>
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-1 px-2" onclick="updatePassenger('infant', 1)"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                        <div class="text-end pt-2 border-top">
                            <button type="button" class="btn btn-danger btn-sm px-4 fw-bold" onclick="document.getElementById('passengerDropdown').click()">Done</button>
                        </div>
                    </div>
                    <input type="hidden" name="passengers_adult" id="input-adult" value="1">
                    <input type="hidden" name="passengers_child" id="input-child" value="0">
                    <input type="hidden" name="passengers_infant" id="input-infant" value="0">
                </div>


                <!-- Class -->
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none small fw-bold text-secondary p-0 dropdown-toggle custom-dropdown-toggle" type="button" id="classDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Economy
                    </button>
                    <ul class="dropdown-menu shadow border-0" aria-labelledby="classDropdown">
                        <li><a class="dropdown-item active" href="#" onclick="selectClass('Economy', this)">Economy</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectClass('Premium Economy', this)">Premium Economy</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectClass('Business', this)">Business</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectClass('First Class', this)">First Class</a></li>
                    </ul>
                    <input type="hidden" name="flight_class" id="classInput" value="Economy">
                </div>

                <div class="ms-auto">
                    <a href="#" class="text-decoration-none small text-dark fw-bold"><i class="bi bi-list-check"></i> View Order List</a>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md-3">
                    <div class="input-box">
                        <div class="label-mini">From</div>
                        <select name="origin_airport_id" class="form-control border-0 p-0 shadow-none fw-bold" style="appearance: none;" required>
                            <option value="">Select Origin</option>
                            <?php foreach ($airports as $id => $name): ?>
                                <option value="<?= $id ?>"><?= h($name) ?></option>
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
                                <option value="<?= $id ?>"><?= h($name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-box">
                        <div class="label-mini">Departure</div>
                        <input type="date" name="departure" id="departureDateInput" class="form-control border-0 p-0 shadow-none fw-bold" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" required onchange="updateReturnMinDate()">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-box">
                        <div class="label-mini">Return</div>
                        <input type="date" name="return" id="returnDateInput" class="form-control border-0 p-0 shadow-none fw-bold" value="<?= date('Y-m-d', strtotime('+1 day')) ?>" min="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-search-red w-100 h-100 py-2"><i class="bi bi-search me-2"></i>Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container mt-5">
    <h5 class="fw-bold mb-4">Exclusive Flight Recommendations</h5>
    <div class="row g-3">
        <?php foreach ($recommendations as $flight): ?>
            <div class="col-6 col-lg-3">
                <div class="card h-100 border-0 flight-card">
                    <img src="https://picsum.photos/seed/<?= urlencode($flight['city']) ?>/400/250" class="flight-img" alt="<?= h($flight['city']) ?>">
                    <div class="card-body p-3">
                        <div class="from-text"><?= h($flight['from']) ?></div>
                        <div class="route-text mt-1">
                             <i class="bi bi-airplane-fill me-1 small"></i> <?= h($flight['city']) ?>
                        </div>
                        <div class="price-tag mt-2">Start from RM <?= h($flight['price']) ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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
            returnInput.value = ''; // Clear value
        } else {
            returnInput.disabled = false;
            returnInput.required = true;
            returnInput.style.opacity = '1';
             // Set default if empty
            if(!returnInput.value) {
                 const depDate = document.getElementById('departureDateInput').value;
                 if(depDate) returnInput.value = depDate;
            }
        }
        
        updateReturnMinDate();

        // Update active state
        const items = element.closest('ul').querySelectorAll('.dropdown-item');
        items.forEach(item => item.classList.remove('active'));
        element.classList.add('active');
    }

    function selectClass(type, element) {
        document.getElementById('classDropdown').innerText = type;
        document.getElementById('classInput').value = type;

        // Update active state
        const items = element.closest('ul').querySelectorAll('.dropdown-item');
        items.forEach(item => item.classList.remove('active'));
        element.classList.add('active');
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
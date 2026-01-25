<?php
/**
 * @var \App\View\AppView $this
 * @var array $recommendations
 */
?>
<style>
    /* Refined Purple Theme - 3 Colors */
    body { background-color: #FAFAFA; }
    
    .hero-bg { 
        position: relative;
        padding: 60px 0 120px 0; 
        color: white;
        overflow: hidden;
        border-bottom: 1px solid #7C3AED;
    }
    
    /* Video Background */
    .hero-video-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }
    
    .hero-video-wrapper iframe {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 150vw;
        height: 150vh;
        min-height: 150vh;
        min-width: 150vw;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }
    
    /* Subtle dark overlay for text readability only */
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.15);
        z-index: 1;
    }
    
    /* Content above video */
    .hero-content {
        position: relative;
        z-index: 2;
        padding: 40px 20px;
    }
    
    .hero-bg h1 { 
        color: #FFFFFF; 
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.8),
                     0 2px 10px rgba(0, 0, 0, 0.6);
        font-size: 3.5rem;
        font-weight: 800;
    }
    .hero-bg p { 
        color: #FFFFFF; 
        text-shadow: 0 3px 15px rgba(0, 0, 0, 0.7),
                     0 2px 8px rgba(0, 0, 0, 0.5);
        font-size: 1.3rem;
    }
    
    .search-wrapper { margin-top: 0; position: relative; z-index: 10; padding-top: 40px; }
    .search-card { 
        border-radius: 12px; 
        border: 1px solid #E5E5E5; 
        box-shadow: 0 8px 30px rgba(124, 58, 237, 0.12);
        background: #FFFFFF;
    }
    
    .flight-card { 
        border: 1px solid #ECECEC !important; 
        border-radius: 12px !important; 
        overflow: hidden; 
        transition: all 0.3s ease;
        background: #FFFFFF;
    }
    .flight-card:hover { 
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.25);
        border-color: #7C3AED !important;
        transform: translateY(-4px);
    }
    .flight-img { height: 130px; object-fit: cover; }
    
    .price-tag { color: #10B981; font-weight: 700; font-size: 0.85rem; }
    .route-text { font-size: 0.9rem; font-weight: 600; color: #2D3748; }
    .from-text { font-size: 0.75rem; color: #718096; }
    
    .input-box { 
        border: 1px solid #E5E5E5; 
        border-radius: 6px; 
        padding: 14px 20px; 
        background: #F7FAFC;
    }
    .input-box input, .input-box select { 
        font-size: 1.1rem; 
        background: transparent;
        color: #2D3748;
    }
    .input-box input::placeholder { color: #A0AEC0; }
    .label-mini { font-size: 0.8rem; color: #7C3AED; text-transform: uppercase; font-weight: bold; margin-bottom: 4px; }
    .btn-search-gold { 
        background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%);
        color: #FFFFFF; 
        border: none; 
        font-weight: bold; 
        border-radius: 8px; 
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    .btn-search-gold:hover {
        box-shadow: 0 0 20px rgba(124, 58, 237, 0.5);
        transform: translateY(-2px);
        color: #FFFFFF;
        background: linear-gradient(135deg, #6D28D9 0%, #7C3AED 100%);
    }
    
    /* Trust Badges */
    .trust-section { background: #F7FAFC; padding: 40px 0 30px 0; }
    .trust-badge {
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        background: #FFFFFF;
        border: 1px solid #E5E5E5;
        transition: all 0.3s ease;
    }
    .trust-badge:hover {
        border-color: #7C3AED;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.2);
    }
    .trust-badge i { font-size: 2.5rem; color: #7C3AED; margin-bottom: 10px; }
    .trust-badge h6 { color: #2D3748; font-weight: 600; margin-bottom: 5px; }
    .trust-badge p { color: #718096; font-size: 0.85rem; margin: 0; }
    
    /* Statistics Counter */
    .stats-section { background: linear-gradient(135deg, #FFFFFF 0%, #F5F3FF 100%); padding: 60px 0; border-bottom: 1px solid #E5E5E5; }
    .stat-item { text-align: center; padding: 20px; }
    .stat-number { font-size: 3rem; font-weight: 700; color: #7C3AED; line-height: 1; }
    .stat-label { color: #718096; font-size: 0.95rem; margin-top: 10px; }
    
    /* Partner Airlines */
    .partners-section { background: #FAFAFA; padding: 60px 0; border-bottom: 1px solid #E5E5E5; }
    .partner-logo {
        padding: 20px;
        background: #FFFFFF;
        border: 1px solid #E5E5E5;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100px;
        transition: all 0.3s ease;
        filter: grayscale(100%) opacity(0.6);
    }
    .partner-logo:hover {
        filter: grayscale(0%) opacity(1);
        border-color: #7C3AED;
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.15);
    }
    
    /* Testimonials */
    .testimonials-section { background: linear-gradient(135deg, #F7FAFC 0%, #FFFFFF 100%); padding: 60px 0; border-bottom: 1px solid #E5E5E5; }
    .testimonial-card {
        background: #FFFFFF;
        border: 1px solid #E5E5E5;
        border-radius: 12px;
        padding: 25px;
        transition: all 0.3s ease;
    }
    .testimonial-card:hover {
        border-color: #7C3AED;
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.2);
    }
    .stars { color: #FFB800; font-size: 1.1rem; margin-bottom: 15px; }
    .testimonial-text { color: #2D3748; font-size: 0.95rem; line-height: 1.6; margin-bottom: 20px; }
    .testimonial-author { color: #718096; font-size: 0.9rem; font-weight: 600; }
    .verified-badge { color: #10B981; font-size: 0.8rem; }
    
    /* Why Choose Us */
    .why-section { background: #FAFAFA; padding: 60px 0; border-bottom: 1px solid #E5E5E5; }
    .why-item {
        text-align: center;
        padding: 30px 20px;
        background: #FFFFFF;
        border: 1px solid #E5E5E5;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .why-item:hover {
        border-color: #7C3AED;
        transform: translateY(-5px);
        background: #F5F3FF;
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.2);
    }
    .why-item i { font-size: 3rem; color: #10B981; margin-bottom: 15px; }
    .why-item h5 { color: #2D3748; font-weight: 600; margin-bottom: 10px; }
    .why-item p { color: #718096; font-size: 0.9rem; margin: 0; }
    
    /* Footer */
    .footer-section { background-color: #F7FAFC; padding-top: 50px; border-top: 1px solid #E5E5E5; margin-top: 0; }
    .footer-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 20px; color: #4C1D95; }
    .footer-link { font-size: 0.85rem; color: #718096; text-decoration: none; display: block; margin-bottom: 8px; transition: color 0.3s; }
    .footer-link:hover { color: #7C3AED; }
    
    .section-title { color: #7C3AED; font-weight: 700; margin-bottom: 40px; text-align: center; }
    .section-subtitle { color: #718096; text-align: center; margin-bottom: 50px; }
    
    /* Light theme form controls */
    .search-card .dropdown-toggle { color: #2D3748 !important; }
    .search-card .text-dark { color: #2D3748 !important; }
    .search-card .text-secondary { color: #718096 !important; }
    .search-card .border-bottom { border-color: #E5E5E5 !important; }
    .search-card .border-end { border-color: #E5E5E5 !important; }
    
    /* Dropdown menus */
    .dropdown-menu-dark {
        background: #FFFFFF !important;
        border: 1px solid #E5E5E5 !important;
    }
    .dropdown-menu-dark .dropdown-item {
        color: #2D3748 !important;
    }
    .dropdown-menu-dark .dropdown-item:hover {
        background: #F5F3FF !important;
        color: #7C3AED !important;
    }
    .dropdown-menu-dark .dropdown-item.active {
        background: #7C3AED !important;
        color: #FFFFFF !important;
    }
    .dropdown-menu-dark .text-muted {
        color: #A0AEC0 !important;
    }
    .dropdown-menu-dark .fw-bold {
        color: #2D3748 !important;
    }
    .dropdown-menu-dark .border-top {
        border-color: #E5E5E5 !important;
    }
    
    /* Button updates */
    .btn-outline-warning {
        border-color: #7C3AED !important;
        color: #7C3AED !important;
    }
    .btn-outline-warning:hover {
        background: #7C3AED !important;
        color: #FFFFFF !important;
    }
    .btn-warning {
        background: #7C3AED !important;
        border-color: #7C3AED !important;
        color: #FFFFFF !important;
    }
    .btn-warning:hover {
        background: #A78BFA !important;
        border-color: #A78BFA !important;
    }
</style>

<div class="hero-bg text-center">
    <!-- Video Background -->
    <div class="hero-video-wrapper">
        <iframe 
            src="https://www.youtube.com/embed/2h8BZHtccXQ?autoplay=1&mute=1&loop=1&playlist=2h8BZHtccXQ&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1&enablejsapi=1"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen>
        </iframe>
    </div>
    
    <!-- Purple Overlay -->
    <div class="hero-overlay"></div>
    
    <!-- Content -->
    <div class="container hero-content">
        <h1 class="fw-bold mb-3">Find Cheap Flight Tickets for Your Trip</h1>
        <p class="opacity-90 fs-5">Book Flight Tickets & Enjoy Travel Deals to Your Destination</p>
    </div>
</div>

<!-- Trust Badges Section -->
<div class="trust-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="trust-badge">
                    <i class="bi bi-shield-check"></i>
                    <h6>Secure Booking</h6>
                    <p>SSL Encrypted</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="trust-badge">
                    <i class="bi bi-people"></i>
                    <h6>2M+ Travelers</h6>
                    <p>Trusted Worldwide</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="trust-badge">
                    <i class="bi bi-headset"></i>
                    <h6>24/7 Support</h6>
                    <p>Always Here to Help</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="trust-badge">
                    <i class="bi bi-tag"></i>
                    <h6>Best Price</h6>
                    <p>Guaranteed Lowest</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">2M+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">150+</div>
                    <div class="stat-label">Countries Served</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">5M+</div>
                    <div class="stat-label">Bookings Made</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Years of Service</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container search-wrapper">
    <div class="card search-card p-3 p-lg-4">
        <form action="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" method="get">
            <div class="d-flex flex-wrap gap-4 mb-3 border-bottom pb-3 align-items-center">
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none small fw-bold text-secondary p-0 dropdown-toggle" type="button" id="journeyTypeDropdown" data-bs-toggle="dropdown">
                        Round Trip
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark shadow border-0">
                        <li><a class="dropdown-item active" href="javascript:void(0)" onclick="selectJourney('One Way', this)">One Way</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="selectJourney('Round Trip', this)">Round Trip</a></li>
                    </ul>
                    <input type="hidden" name="journey_type" id="journeyTypeInput" value="Round Trip">
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none small fw-bold text-secondary p-0 dropdown-toggle" type="button" id="passengerDropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                        <span id="passengerLabel">1 Passenger</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-dark shadow border-0 p-3" style="min-width: 280px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <div class="fw-bold">Adult</div>
                                <div class="text-muted small">Age 12+</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-outline-warning btn-sm rounded-1 px-2" onclick="updatePassenger('adult', -1)"><i class="bi bi-dash"></i></button>
                                <span class="fw-bold mx-2" id="count-adult">1</span>
                                <button type="button" class="btn btn-outline-warning btn-sm rounded-1 px-2" onclick="updatePassenger('adult', 1)"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <div class="fw-bold">Child</div>
                                <div class="text-muted small">Age 2-11</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm rounded-1 px-2" onclick="updatePassenger('child', -1)"><i class="bi bi-dash"></i></button>
                                <span class="fw-bold mx-2" id="count-child">0</span>
                                <button type="button" class="btn btn-outline-warning btn-sm rounded-1 px-2" onclick="updatePassenger('child', 1)"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <div class="fw-bold">Infant</div>
                                <div class="text-muted small">&lt; 2 years</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm rounded-1 px-2" onclick="updatePassenger('infant', -1)"><i class="bi bi-dash"></i></button>
                                <span class="fw-bold mx-2" id="count-infant">0</span>
                                <button type="button" class="btn btn-outline-warning btn-sm rounded-1 px-2" onclick="updatePassenger('infant', 1)"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                        <div class="text-end pt-2 border-top">
                            <button type="button" class="btn btn-warning btn-sm px-4 fw-bold" onclick="document.getElementById('passengerDropdown').click()">Done</button>
                        </div>
                    </div>
                    <input type="hidden" name="passengers_adult" id="input-adult" value="1">
                    <input type="hidden" name="passengers_child" id="input-child" value="0">
                    <input type="hidden" name="passengers_infant" id="input-infant" value="0">
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none small fw-bold text-secondary p-0 dropdown-toggle" type="button" id="classDropdown" data-bs-toggle="dropdown">
                        Economy
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark shadow border-0">
                        <li><a class="dropdown-item active" href="javascript:void(0)" onclick="selectClass('Economy', this)">Economy</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="selectClass('Business', this)">Business</a></li>
                    </ul>
                    <input type="hidden" name="flight_class" id="classInput" value="Economy">
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
                        <input type="date" name="departure" id="departureDateInput" class="form-control border-0 p-0 shadow-none fw-bold" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+4 days')) ?>" required onchange="updateReturnMinDate()">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-box">
                        <div class="label-mini">Return</div>
                        <input type="date" name="return" id="returnDateInput" class="form-control border-0 p-0 shadow-none fw-bold" value="<?= date('Y-m-d', strtotime('+1 day')) ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+4 days')) ?>" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-search-gold w-100 h-100 py-2"><i class="bi bi-search me-2"></i>Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container mt-5">
    <h5 class="fw-bold mb-4" style="color: #7C3AED;">Exclusive Flight Recommendations</h5>
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

<!-- Partner Airlines -->
<div class="partners-section">
    <div class="container">
        <h2 class="section-title">Our Trusted Airline Partners</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <a href="https://www.airasia.com" target="_blank" class="text-decoration-none">
                    <div class="partner-logo">
                        <img src="/flight_booking/img/airlines/airasia.png" alt="AirAsia" style="max-width: 100%; height: auto; max-height: 80px; object-fit: contain;">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="https://www.malaysiaairlines.com" target="_blank" class="text-decoration-none">
                    <div class="partner-logo">
                        <img src="/flight_booking/img/airlines/malaysia-airlines.png" alt="Malaysia Airlines" style="max-width: 100%; height: auto; max-height: 80px; object-fit: contain;">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="https://www.batikair.com" target="_blank" class="text-decoration-none">
                    <div class="partner-logo">
                        <img src="/flight_booking/img/airlines/batik-air.png" alt="Batik Air" style="max-width: 100%; height: auto; max-height: 80px; object-fit: contain;">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="https://www.fireflyz.com.my" target="_blank" class="text-decoration-none">
                    <div class="partner-logo">
                        <img src="/flight_booking/img/airlines/firefly.png" alt="Firefly" style="max-width: 100%; height: auto; max-height: 80px; object-fit: contain;">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Customer Testimonials -->
<div class="testimonials-section">
    <div class="container">
        <h2 class="section-title">What Our Customers Say</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Amazing service! Found the cheapest flights to Tokyo and the booking process was super smooth. Highly recommended!"</p>
                    <div class="testimonial-author">Sarah L. <span class="verified-badge">✓ Verified Purchase</span></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Customer support was excellent when I needed to change my flight dates. Very responsive and helpful team!"</p>
                    <div class="testimonial-author">Ahmad K. <span class="verified-badge">✓ Verified Purchase</span></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Best prices guaranteed! I compared with other sites and FlyHigh always had the lowest fares. Will use again!"</p>
                    <div class="testimonial-author">Michelle T. <span class="verified-badge">✓ Verified Purchase</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us -->
<div class="why-section">
    <div class="container">
        <h2 class="section-title">Why Choose FlyHigh</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="why-item">
                    <i class="bi bi-cash-coin"></i>
                    <h5>Best Price Guarantee</h5>
                    <p>Find a lower price? We'll match it!</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="why-item">
                    <i class="bi bi-x-circle"></i>
                    <h5>Easy Cancellation</h5>
                    <p>Flexible cancellation policies</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="why-item">
                    <i class="bi bi-headset"></i>
                    <h5>24/7 Support</h5>
                    <p>We're always here to help you</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="why-item">
                    <i class="bi bi-lightning"></i>
                    <h5>Instant Confirmation</h5>
                    <p>Get your tickets immediately</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer-section">
    <div class="container">
        <div class="text-center mb-4">
            <h5 style="color: #4C1D95; font-weight: 700;">We Accept</h5>
            <div class="d-flex justify-content-center gap-3 mt-3">
                <i class="bi bi-credit-card fs-3" style="color: #718096;"></i>
                <i class="bi bi-paypal fs-3" style="color: #718096;"></i>
                <i class="bi bi-wallet2 fs-3" style="color: #718096;"></i>
            </div>
            <div class="mt-3">
                <i class="bi bi-shield-check fs-5 me-2" style="color: #10B981;"></i>
                <small style="color: #10B981;">SSL Secured | PCI DSS Compliant</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <h6 class="footer-title">FlyHigh</h6>
                <a href="#" class="footer-link">Home</a>
                <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'about']) ?>" class="footer-link">About Us</a>
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
                <a href="#" class="footer-link">Privacy Policy</a>
            </div>
            <div class="col-md-2 text-center">
                <h6 class="footer-title">Follow us</h6>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" style="color: #999; transition: color 0.3s;"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" style="color: #999; transition: color 0.3s;"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" style="color: #999; transition: color 0.3s;"><i class="bi bi-twitter-x fs-4"></i></a>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <h6 class="footer-title">Our App</h6>
                <div class="mb-2"><span class="badge p-2 w-75" style="background: #1a1a1a; border: 1px solid #333;"><i class="bi bi-google-play me-2"></i>Google Play</span></div>
                <div><span class="badge p-2 w-75" style="background: #1a1a1a; border: 1px solid #333;"><i class="bi bi-apple me-2"></i>App Store</span></div>
            </div>
        </div>
        
        <div class="text-center mt-5 py-4 border-top" style="border-color: #222 !important;">
            <p class="small mb-1" style="color: #999;">Copyright 2026 FlyHigh.com. All rights reserved.</p>
            <p class="small" style="font-size: 0.65rem; color: #666;">Global Airlines Holiday Sdn Bhd 105929-H</p>
        </div>
    </div>
</footer>

<script>
    function selectJourney(type, element) {
        document.getElementById('journeyTypeDropdown').innerText = type;
        document.getElementById('journeyTypeInput').value = type;
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
        const items = element.closest('ul').querySelectorAll('.dropdown-item');
        items.forEach(item => item.classList.remove('active'));
        element.classList.add('active');
    }

    function selectClass(type, element) {
        document.getElementById('classDropdown').innerText = type;
        document.getElementById('classInput').value = type;
        const items = element.closest('ul').querySelectorAll('.dropdown-item');
        items.forEach(item => item.classList.remove('active'));
        element.classList.add('active');
    }

    function updatePassenger(type, change) {
        const countSpan = document.getElementById('count-' + type);
        const inputField = document.getElementById('input-' + type);
        let count = parseInt(countSpan.innerText);
        if (type === 'adult' && count + change < 1) return;
        if (type !== 'adult' && count + change < 0) return;
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
        const maxDate = '<?= date('Y-m-d', strtotime('+4 days')) ?>';
        
        if (depInput.value) {
            returnInput.min = depInput.value;
            // Keep max date within 5-day window
            returnInput.max = maxDate;
            
            if(returnInput.value && returnInput.value < depInput.value) {
                returnInput.value = depInput.value;
            }
            // If return date exceeds max, reset it
            if(returnInput.value && returnInput.value > maxDate) {
                returnInput.value = maxDate;
            }
        }
    }

    document.querySelector('form').addEventListener('submit', function(e) {
        const origin = document.querySelector('select[name="origin_airport_id"]').value;
        const dest = document.querySelector('select[name="dest_airport_id"]').value;
        if (origin && dest && origin === dest) {
            e.preventDefault();
            alert('Origin and Destination airports cannot be the same.');
        }
    });
</script>

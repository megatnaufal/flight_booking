<?php
/**
 * About Us Page
 */
$this->assign('title', 'About Us - FlyHigh');
?>
<div class="about-page">
    <!-- Hero Section -->
    <div class="position-relative py-5 overflow-hidden" style="background: linear-gradient(135deg, #4C1D95 0%, #1e1b4b 100%);">
        <div class="container position-relative z-2">
            <div class="row min-vh-50 align-items-center py-5">
                <div class="col-lg-6 text-white">
                    <div class="d-inline-block border border-white border-opacity-25 rounded-pill px-3 py-1 mb-4 backdrop-blur">
                        <small class="fw-bold text-uppercase tracking-wider"><i class="bi bi-airplane-engines me-2"></i>Elevating Travel</small>
                    </div>
                    <h1 class="display-3 fw-bold mb-4" style="color: #ffffff; letter-spacing: -0.02em;">We Are <span style="color: #A78BFA;">FlyHigh</span></h1>
                    <p class="lead text-white-50 mb-5 w-75">Redefining the travel experience with premium services, seamless booking, and world-class support. Your journey begins with us.</p>
                    <div class="d-flex gap-3">
                        <a href="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" class="btn btn-gold btn-lg px-4 py-2">Book a Flight</a>
                    </div>
                </div>
                 <div class="col-lg-6">
                    <div class="p-5 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-10 backdrop-blur">
                        <div class="row g-4 text-center">
                            <div class="col-6">
                                <h2 class="display-4 fw-bold text-white mb-0"><?= $this->Number->format($flightsCount ?? 0) ?></h2>
                                <p class="text-white-50 small text-uppercase fw-bold">Active Flights</p>
                            </div>
                            <div class="col-6">
                                <h2 class="display-4 fw-bold text-white mb-0"><?= $this->Number->format($bookingsCount ?? 0) ?></h2>
                                <p class="text-white-50 small text-uppercase fw-bold">Bookings Made</p>
                            </div>
                             <div class="col-6">
                                <h2 class="display-4 fw-bold text-white mb-0"><?= $this->Number->format($airportsCount ?? 0) ?></h2>
                                <p class="text-white-50 small text-uppercase fw-bold">Destinations</p>
                            </div>
                            <div class="col-6">
                                <h2 class="display-4 fw-bold text-white mb-0">24/7</h2>
                                <p class="text-white-50 small text-uppercase fw-bold">Support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Abstract Decoration -->
        <div class="position-absolute top-0 end-0 translate-middle-y me-n5 mt-n5 opacity-25">
             <svg width="500" height="500" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#7C3AED" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.5C59.4,46,47.9,55.2,35.6,62.5C23.3,69.8,10.2,75.2,-1.9,78.5C-14,81.8,-25.1,83,-35.1,77.2C-45.1,71.4,-54,58.6,-61.6,46.1C-69.2,33.6,-75.5,21.4,-77.2,8.6C-78.9,-4.2,-76,-17.6,-69.1,-29.1C-62.2,-40.6,-51.3,-50.2,-39.4,-58.4C-27.5,-66.6,-14.6,-73.4,0.4,-74.1C15.4,-74.8,30.5,-69.3,44.7,-76.4Z" transform="translate(100 100)" />
            </svg>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <div class="p-5 rounded-4" style="background: linear-gradient(45deg, #f3e8ff, #e9d5ff);">
                       <div class="text-center">
                           <i class="bi bi-rocket-takeoff-fill display-1" style="color: #7C3AED;"></i>
                       </div>
                    </div>
                </div>
                <div class="col-md-6 order-md-1">
                    <h2 class="display-5 fw-bold mb-4" style="color: #111;">Our Mission</h2>
                    <p class="lead text-muted mb-4">To empower travelers with seamless, accessible, and delightful journeys, connecting people and places through innovation and care.</p>
                    <p class="text-muted">At FlyHigh, we believe that travel is more than just moving from point A to point B. It's about the experience, the discovery, and the memories created along the way. That's why we've dedicated ourselves to building a platform that makes booking easier, faster, and more transparent.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-5" style="background-color: #FAFAFA;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold mb-3" style="color: #111;">Why Choose FlyHigh?</h2>
                <p class="text-muted w-75 mx-auto">We combine cutting-edge technology with genuine hospitality to bring you the best travel experience possible.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-up transition-all bg-white">
                        <div class="card-body p-4">
                            <div class="d-inline-flex align-items-center justify-content-center mb-4 rounded-3" style="width: 50px; height: 50px; background-color: #f3e8ff; color: #7C3AED;">
                                <i class="bi bi-shield-check fs-4"></i>
                            </div>
                            <h4 class="fw-bold mb-3 h5">Secure Booking</h4>
                            <p class="text-muted small">Your data is protected with state-of-the-art encryption and security checks. We prioritize your privacy above all else.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-up transition-all bg-white">
                        <div class="card-body p-4">
                            <div class="d-inline-flex align-items-center justify-content-center mb-4 rounded-3" style="width: 50px; height: 50px; background-color: #f3e8ff; color: #7C3AED;">
                                <i class="bi bi-clock-history fs-4"></i>
                            </div>
                            <h4 class="fw-bold mb-3 h5">Real-time Updates</h4>
                            <p class="text-muted small">Get instant notifications about your flight status, gate changes, and delays. Stay informed every step of the way.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-up transition-all bg-white">
                        <div class="card-body p-4">
                            <div class="d-inline-flex align-items-center justify-content-center mb-4 rounded-3" style="width: 50px; height: 50px; background-color: #f3e8ff; color: #7C3AED;">
                                <i class="bi bi-heart fs-4"></i>
                            </div>
                            <h4 class="fw-bold mb-3 h5">Customer First</h4>
                            <p class="text-muted small">Our dedicated support team is here for you 24/7. We go the extra mile to ensure your journey is smooth.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-up:hover { transform: translateY(-5px); }
    .transition-all { transition: all 0.3s ease; }
    .backdrop-blur { backdrop-filter: blur(10px); }
</style>

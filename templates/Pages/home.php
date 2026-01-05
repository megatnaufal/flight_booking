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
    
    .input-box { border: 1px solid #dee2e6; border-radius: 6px; padding: 8px 12px; background: #fff; }
    .label-mini { font-size: 0.65rem; color: #6c757d; text-transform: uppercase; font-weight: bold; margin-bottom: 2px; }
    .btn-search-red { background-color: #e62129; color: white; border: none; font-weight: bold; border-radius: 6px; }
    
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
        <div class="d-flex flex-wrap gap-4 mb-3 border-bottom pb-3 align-items-center">
            <span class="small fw-bold border-end pe-3 text-secondary">Round Trip <i class="bi bi-chevron-down ms-1"></i></span>
            <span class="small fw-bold border-end pe-3 text-secondary">1 Passenger <i class="bi bi-chevron-down ms-1"></i></span>
            <span class="small fw-bold text-secondary">Economy <i class="bi bi-chevron-down ms-1"></i></span>
            <div class="ms-auto">
                <a href="#" class="text-decoration-none small text-dark fw-bold"><i class="bi bi-list-check"></i> View Order List</a>
            </div>
        </div>

        <div class="row g-2">
            <div class="col-md-3">
                <div class="input-box">
                    <div class="label-mini">From</div>
                    <input type="text" class="form-control border-0 p-0 shadow-none fw-bold" value="Kuala Lumpur (KUL)">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-box">
                    <div class="label-mini">To</div>
                    <input type="text" class="form-control border-0 p-0 shadow-none fw-bold" placeholder="Tokyo (TYO)">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-box">
                    <div class="label-mini">Departure</div>
                    <input type="text" class="form-control border-0 p-0 shadow-none fw-bold" value="Tue, 6 Jan 2026">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-box">
                    <div class="label-mini">Return</div>
                    <input type="text" class="form-control border-0 p-0 shadow-none fw-bold" value="Wed, 7 Jan 2026">
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-search-red w-100 h-100 py-2"><i class="bi bi-search me-2"></i>Search</button>
            </div>
        </div>
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
                <h6 class="footer-title">Airpaz</h6>
                <a href="#" class="footer-link">Home</a>
                <a href="#" class="footer-link">About Us</a>
                <a href="#" class="footer-link">Airpaz Blog</a>
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
            <p class="text-muted small mb-1">Copyright 2026 Airpaz.com. All rights reserved.</p>
            <p class="text-muted small" style="font-size: 0.65rem;">Global Airlines Holiday Sdn Bhd Bhd 105929-H</p>
        </div>
    </div>
</footer>
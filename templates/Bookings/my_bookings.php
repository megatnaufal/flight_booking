<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
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

<div class="container py-5" style="position: relative; z-index: 1;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #4C1D95;">My Bookings</h2>
        <a href="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Book New Flight
        </a>
    </div>

    <?php if (!$bookings->isEmpty()): ?>
        <div class="row g-4">
            <?php foreach ($bookings as $booking): ?>
                <div class="col-12">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <!-- Flight Route Visual -->
                                <div class="col-md-3 bg-light p-4 d-flex flex-column justify-content-center align-items-center text-center border-end">
                                    <div class="fs-4 fw-bold mb-2"><?= h($booking->flight->origin_airport?->airport_code) ?></div>
                                    <div class="text-muted small mb-2"><i class="bi bi-arrow-down fs-5 text-primary"></i></div>
                                    <div class="fs-4 fw-bold"><?= h($booking->flight->dest_airport?->airport_code) ?></div>
                                    <div class="mt-3 badge bg-white text-secondary border">
                                        <?= h($booking->flight->flight_number) ?>
                                    </div>
                                </div>
                                
                                <!-- Booking Details -->
                                <div class="col-md-6 p-4">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <span class="text-muted small text-uppercase fw-bold">Booking Ref</span>
                                            <div class="fs-5 fw-bold text-dark">#<?= h($booking->id) ?></div>
                                        </div>
                                        <div class="text-end">
                                            <span class="text-muted small text-uppercase fw-bold">Date</span>
                                            <div class="fs-6"><?= h($booking->booking_date->format('d M Y')) ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex gap-4 mb-3">
                                        <div>
                                            <i class="bi bi-calendar-event me-2 text-primary"></i>
                                            <?= h($booking->flight->departure_time->format('D, d M Y, H:i')) ?>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge <?= strtolower($booking->ticket_status) === 'confirmed' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                            <?= h($booking->ticket_status) ?>
                                        </span>
                                        <?php 
                                            // Count passengers: booking_passengers + lead passenger if not included
                                            $passengerCount = count($booking->booking_passengers ?? []);
                                            if ($passengerCount === 0 && $booking->passenger) {
                                                $passengerCount = 1; // At least the lead passenger
                                            }
                                        ?>
                                        <span class="text-muted small">• <?= $passengerCount ?> Passenger(s)</span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="col-md-3 p-4 d-flex flex-column justify-content-center border-start bg-light bg-opacity-10 align-items-end">
                                    <div class="text-end mb-3">
                                        <span class="text-muted small d-block">Total Paid</span>
                                        <?php
                                            // Calculate total: (base_price + taxes) * passengers
                                            $passengerCount = count($booking->booking_passengers ?? []);
                                            if ($passengerCount === 0 && $booking->passenger) {
                                                $passengerCount = 1;
                                            }
                                            $basePrice = (float)($booking->flight->base_price ?? 0);
                                            $taxPerPax = 45.00;
                                            $totalPrice = ($basePrice + $taxPerPax) * $passengerCount;
                                        ?>
                                        <span class="fs-5 fw-bold text-primary">MYR <?= number_format($totalPrice, 2) ?></span>
                                    </div>
                                    <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'downloadReceipt', $booking->id]) ?>" class="btn btn-outline-primary w-100 mb-2">
                                        <i class="bi bi-receipt me-2"></i> Receipt
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-ticket-perforated display-1 text-muted opacity-25"></i>
            </div>
            <h4 class="text-muted">No bookings found</h4>
            <p class="text-muted mb-4">You haven't made any bookings yet.</p>
            <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary btn-lg">
                Search Flights
            </a>
        </div>
    <?php endif; ?>
</div>
</div><!-- End Hexagon Background Section -->

<style>
    /* Footer Styles */
    .footer-section { background-color: #F7FAFC; padding-top: 50px; border-top: 1px solid #E5E5E5; margin-top: 60px; }
    .footer-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 20px; color: #4C1D95; }
    .footer-link { font-size: 0.85rem; color: #718096; text-decoration: none; display: block; margin-bottom: 8px; transition: color 0.3s; }
    .footer-link:hover { color: #7C3AED; }
</style>

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
                <a href="<?= $this->Url->build('/') ?>" class="footer-link">Home</a>
                <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'about']) ?>" class="footer-link">About Us</a>
                <a href="#" class="footer-link">FlyHigh Blog</a>
                <a href="#" class="footer-link">Careers</a>
            </div>
            <div class="col-md-2">
                <h6 class="footer-title">Account</h6>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="footer-link">Sign in / Register</a>
                <a href="#" class="footer-link">Forgot Password</a>
            </div>
            <div class="col-md-2">
                <h6 class="footer-title">Support</h6>
                <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'help']) ?>" class="footer-link">Help Center</a>
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

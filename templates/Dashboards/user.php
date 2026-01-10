<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'My Dashboard');
?>

<div class="container-fluid py-5" style="background-color: #f8f9fa; min-height: 85vh;">
    <div class="container">
        <!-- Dashboard Header -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-0" style="color: #333;">Welcome Aboard, Traveler</h2>
                <p class="text-muted mb-0">Manage your flights and profile</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="#" class="btn btn-warning rounded-pill px-4 fw-bold shadow-sm text-white" style="background-color: #f1c40f; border: none; color: #000 !important;">
                    <i class="bi bi-search me-2"></i>Search Flights
                </a>
            </div>
        </div>

        <!-- Action Cards -->
        <div class="row g-4">
            <!-- My Bookings -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-card">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-ticket-perforated-fill fs-2"></i>
                        </div>
                        <h4 class="fw-bold text-dark">My Bookings</h4>
                        <p class="text-muted small">View and manage your upcoming and past trips.</p>
                        <a href="#" class="btn btn-outline-primary rounded-pill px-4 fw-bold mt-2">View History</a>
                    </div>
                </div>
            </div>

            <!-- Profile -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-card">
                    <div class="card-body p-4 text-center">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-person-circle fs-2"></i>
                        </div>
                        <h4 class="fw-bold text-dark">My Profile</h4>
                        <p class="text-muted small">Update your personal details and preferences.</p>
                        <a href="#" class="btn btn-outline-success rounded-pill px-4 fw-bold mt-2">Edit Profile</a>
                    </div>
                </div>
            </div>

            <!-- Support -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-card">
                    <div class="card-body p-4 text-center">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-headset fs-2"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Help Center</h4>
                        <p class="text-muted small">Need assistance? Check our FAQs or contact support.</p>
                        <a href="#" class="btn btn-outline-danger rounded-pill px-4 fw-bold mt-2">Get Help</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promo Banner -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 text-white" style="background: linear-gradient(135deg, #e31f25 0%, #b71c1c 100%);">
                    <div class="card-body p-5 d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="mb-3 mb-md-0">
                            <h3 class="fw-bold mb-1">Special Offer: 20% OFF to Tokyo!</h3>
                            <p class="mb-0 text-white-50">Use code <strong class="text-white">FLYTOKYO2026</strong>. Limited time only.</p>
                        </div>
                        <button class="btn btn-light rounded-pill px-4 fw-bold text-danger">Book Now</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

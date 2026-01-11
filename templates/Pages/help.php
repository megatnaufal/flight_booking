<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Help Center');
?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="text-white fw-bold mb-3">How can we help you?</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <input type="text" class="form-control form-control-lg form-control-dark" placeholder="Search for help articles...">
            </div>
        </div>
    </div>

    <!-- Most Features Topic -->
    <div class="mb-5">
        <h3 class="text-gold fw-bold mb-4">Most Features Topic</h3>
        <div class="row g-4">
            <?php
            $features = [
                ['icon' => 'bi-ticket-perforated', 'title' => 'Booking', 'desc' => 'How to book, payment issue'],
                ['icon' => 'bi-x-circle', 'title' => 'Cancellation', 'desc' => 'Cancel policy, refund status'],
                ['icon' => 'bi-arrow-repeat', 'title' => 'Reschedule', 'desc' => 'Change flight date/time'],
                ['icon' => 'bi-suitcase-lg', 'title' => 'Baggage', 'desc' => 'Add baggage, weight limit'],
                ['icon' => 'bi-person-badge', 'title' => 'Check-in', 'desc' => 'Online check-in guide'],
                ['icon' => 'bi-shield-check', 'title' => 'Insurance', 'desc' => 'Coverage & claims'],
            ];
            foreach ($features as $feature): ?>
                <div class="col-md-6 col-lg-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card bg-dark border-secondary h-100 hover-effect">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <div class="icon-box rounded-circle d-flex align-items-center justify-content-center bg-black border border-secondary" style="width: 50px; height: 50px; min-width: 50px;">
                                    <i class="bi <?= $feature['icon'] ?> text-gold fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="text-white mb-1"><?= h($feature['title']) ?></h5>
                                    <small class="text-secondary"><?= h($feature['desc']) ?></small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Flight Questions -->
    <div>
        <h3 class="text-gold fw-bold mb-4">Flight Questions</h3>
        <div class="accordion accordion-dark" id="faqAccordion">
            <div class="accordion-item bg-dark border-secondary">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed bg-dark text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        How do I reschedule my flight?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary border-top border-secondary">
                        To reschedule your flight, go to "My Bookings", select your flight, and click on "Reschedule". Follow the prompts to choose a new date and time. Fare differences may apply.
                    </div>
                </div>
            </div>
            <div class="accordion-item bg-dark border-secondary">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed bg-dark text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        What forms of payment do you accept?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary border-top border-secondary">
                        We accept major credit cards (Visa, Mastercard, Amex), FPX Online Banking, and E-wallets (GrabPay, Touch 'n Go).
                    </div>
                </div>
            </div>
            <div class="accordion-item bg-dark border-secondary">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed bg-dark text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Can I get a refund if I cancel?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary border-top border-secondary">
                        Refund policies vary by airline and fare class. Please check the specific terms and conditions of your ticket in the "My Bookings" section.
                    </div>
                </div>
            </div>
             <div class="accordion-item bg-dark border-secondary">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed bg-dark text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        When does flight check-in close?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary border-top border-secondary">
                        Generally, check-in counters close 60 minutes before departure for international flights and 45 minutes for domestic flights. Online check-in often closes 1 hour before.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control-dark {
        background: #121212;
        border: 1px solid #333;
        color: #ecf0f1;
    }
    .form-control-dark:focus {
        background: #1a1a1a;
        border-color: #FFD300;
        color: #ecf0f1;
        box-shadow: 0 0 10px rgba(255, 211, 0, 0.2);
    }
    .hover-effect:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
        border-color: #FFD300 !important;
    }
    .accordion-button::after {
        filter: invert(1);
    }
    .accordion-button:not(.collapsed) {
        color: #FFD300;
        background-color: #000;
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }
    .accordion-button:not(.collapsed)::after {
        filter: invert(1) sepia(100%) saturate(1000%) hue-rotate(360deg) brightness(103%) contrast(103%); 
    }
</style>

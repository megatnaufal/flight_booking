<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Help Center');
?>

<div class="help-hero py-5 mb-4">
    <div class="container text-center">
        <h1 class="fw-bold mb-2 text-white">How can we help you?</h1>
        <p class="text-light opacity-75 mb-4">
            Search FAQs or browse the most common questions about your flight.
        </p>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="search-wrapper d-flex align-items-center bg-white shadow-sm rounded-pill px-3">
                    <i class="bi bi-search text-muted me-2"></i>
                    <input type="text"
                           id="helpSearchInput"
                           class="form-control border-0 form-control-lg flex-grow-1 search-input"
                           placeholder="Type a keyword, e.g. refund, baggage, reschedule">
                </div>
            </div>
        </div>

        <!-- Category pills -->
        <div class="mt-3 small text-light">
            Popular topics:
            <button type="button" class="btn btn-sm topic-pill topic-btn">Bookings</button>
            <button type="button" class="btn btn-sm topic-pill topic-btn">Payment</button>
            <button type="button" class="btn btn-sm topic-pill topic-btn">Refund</button>
            <button type="button" class="btn btn-sm topic-pill topic-btn">Check‑in</button>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Flight Questions -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="section-heading d-flex align-items-center justify-content-between mb-3">
                <h3 class="fw-bold mb-0" style="color:#4C1D95;">Flight Questions</h3>
                <span class="text-muted small">4 questions • updated regularly</span>
            </div>
            <p class="text-muted small mb-4">
                These are the most frequently asked questions about changing flights, payment and basic travel rules.
            </p>

            <div class="accordion" id="faqAccordion">
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 faq-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed shadow-none"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseOne"
                                aria-expanded="false"
                                aria-controls="collapseOne">
                            How do I reschedule my flight?
                        </button>
                    </h2>
                    <div id="collapseOne"
                         class="accordion-collapse collapse"
                         aria-labelledby="headingOne"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            To reschedule your flight, go to <strong>My Bookings</strong>, select your flight,
                            and click on <strong>Reschedule</strong>. Choose a new date and time and confirm the changes.
                            Fare difference and change fees may apply depending on airline policy.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 faq-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed shadow-none"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo"
                                aria-expanded="false"
                                aria-controls="collapseTwo">
                            What forms of payment do you accept?
                        </button>
                    </h2>
                    <div id="collapseTwo"
                         class="accordion-collapse collapse"
                         aria-labelledby="headingTwo"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Supported payment methods include major credit cards
                            (Visa, Mastercard, American Express), FPX Online Banking,
                            and popular e‑wallets such as GrabPay and Touch 'n Go.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 faq-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed shadow-none"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseThree"
                                aria-expanded="false"
                                aria-controls="collapseThree">
                            Can I get a refund if I cancel?
                        </button>
                    </h2>
                    <div id="collapseThree"
                         class="accordion-collapse collapse"
                         aria-labelledby="headingThree"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Refund eligibility depends on your airline and fare type.
                            Check the <strong>fare rules</strong> in your e‑ticket and the details under
                            <strong>My Bookings</strong>. Some promotional or basic fares may be non‑refundable.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 faq-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed shadow-none"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseFour"
                                aria-expanded="false"
                                aria-controls="collapseFour">
                            When does flight check‑in close?
                        </button>
                    </h2>
                    <div id="collapseFour"
                         class="accordion-collapse collapse"
                         aria-labelledby="headingFour"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            As a general guideline, airport check‑in counters close about
                            60 minutes before international departures and 45 minutes before domestic departures.
                            Online check‑in usually closes around 1 hour before departure time.
                        </div>
                    </div>
                </div>
            </div>

            <!-- No results message -->
            <div id="noResultsMsg" class="text-center text-muted mt-5 d-none">
                <i class="bi bi-search display-6 mb-3 d-block opacity-50"></i>
                <p>No questions found matching your search.</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Light overall background */
    body {
        background-color: #f5f5f7;
        color: #111;
    }

    /* Purple hero (matching FlyHigh theme) */
    .help-hero {
        background: linear-gradient(135deg, #4C1D95 0%, #7C3AED 100%);
        border-bottom: 1px solid #5B21B6;
        color: #fff;
    }

    .search-wrapper .search-input {
        background: transparent;
        border-radius: 999px;
        box-shadow: none;
        padding-left: 0;
        color: #111;
    }
    .search-wrapper .search-input::placeholder {
        color: #9ca3af;
    }
    .search-wrapper .search-input:focus {
        box-shadow: none;
    }

    .topic-pill {
        border-radius: 999px;
        padding-inline: 0.9rem;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.5);
        color: #ffffff;
        margin-inline: 2px;
        transition: all 0.2s;
    }
    .topic-pill:hover {
        border-color: #ffffff;
        color: #4C1D95;
        background: #ffffff;
    }

    .accordion-item {
        background-color: #ffffff;
        border-radius: 1rem;
    }

    .accordion-button {
        background-color: #ffffff;
        color: #111827;
        font-weight: 500;
        border-radius: 1rem;
    }
    .accordion-button::after {
        filter: none;
    }
    .accordion-button:not(.collapsed) {
        color: #4C1D95;
        background-color: #f5f3ff;
        box-shadow: none;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .accordion-button:not(.collapsed)::after {
        filter: none;
    }

    .accordion-body {
        background-color: #ffffff;
        border-top: 1px solid #f1f1f3;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('helpSearchInput');
    const faqItems = document.querySelectorAll('.faq-item');
    const topicBtns = document.querySelectorAll('.topic-btn');
    const noResultsMsg = document.getElementById('noResultsMsg');

    function filterFAQs(query) {
        let visibleCount = 0;
        const lowerQuery = query.toLowerCase();

        faqItems.forEach(item => {
            const buttonText = item.querySelector('.accordion-button').textContent.toLowerCase();
            const bodyText = item.querySelector('.accordion-body').textContent.toLowerCase();

            if (buttonText.includes(lowerQuery) || bodyText.includes(lowerQuery)) {
                item.classList.remove('d-none');
                visibleCount++;
            } else {
                item.classList.add('d-none');
            }
        });

        if (visibleCount === 0) {
            noResultsMsg.classList.remove('d-none');
        } else {
            noResultsMsg.classList.add('d-none');
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            filterFAQs(e.target.value);
        });
    }

    topicBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const topic = this.textContent;
            if (searchInput) {
                searchInput.value = topic;
                filterFAQs(topic);
            }
        });
    });
});
</script>

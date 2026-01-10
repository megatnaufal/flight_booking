<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Flight> $flights
 */
?>
<style>
    /* Flight Card & Search Styles */
    :root {
        --primary-blue: #0056b3;
        --secondary-blue: #004494;
        --light-bg: #f5f7fa;
        --card-border: #e1e4e8;
    }
    
    .search-container {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        margin-top: 20px;
    }
    
    .filters-sidebar {
        flex: 0 0 250px;
        background: #fff;
        border: 1px solid var(--card-border);
        border-radius: 8px;
        padding: 20px;
    }
    
    .filter-group {
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }
    
    .filter-group:last-child {
        border-bottom: none;
    }
    
    .filter-group h4 {
        font-size: 1rem;
        margin-bottom: 10px;
        color: var(--primary-blue);
    }
    
    .results-area {
        flex: 1;
    }
    
    .flight-card {
        background: #fff;
        border: 1px solid var(--card-border);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .flight-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .flight-info {
        display: flex;
        align-items: center;
        gap: 30px;
    }
    
    .airline-logo {
        width: 60px;
        height: 60px;
        background: #eee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #666;
    }
    
    .route-time {
        text-align: center;
    }
    
    .time {
        font-size: 1.2rem;
        font-weight: bold;
        display: block;
    }
    
    .airport-code {
        color: #666;
        font-size: 0.9rem;
    }
    
    .duration-line {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 100px;
    }
    
    .duration-text {
        font-size: 0.8rem;
        color: #666;
        margin-bottom: 5px;
    }
    
    .line {
        height: 2px;
        background: #ddd;
        width: 100%;
        position: relative;
    }
    
    .line::after {
        content: '✈';
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%) rotate(90deg);
        color: var(--primary-blue);
        background: #fff;
        padding: 0 5px;
    }
    
    .price-action {
        text-align: right;
        min-width: 120px;
    }
    
    .price {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--primary-blue);
        display: block;
        margin-bottom: 10px;
    }
    
    .price-alert-toggle {
        background: #e7f1ff;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    /* Mobile Tab Bar */
    .mobile-tab-bar {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fff;
        border-top: 1px solid #ddd;
        padding: 10px 0;
        justify-content: space-around;
        z-index: 2000;
    }
    
    .mobile-tab-item {
        text-align: center;
        color: #666;
        font-size: 0.8rem;
        text-decoration: none;
    }
    
    .mobile-tab-item i {
        display: block;
        font-size: 1.2rem;
        margin-bottom: 3px;
    }
    
    @media (max-width: 768px) {
        .search-container {
            flex-direction: column;
        }
        .filters-sidebar {
            width: 100%;
        }
        .flight-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        .duration-line {
            display: none; /* Simplify for mobile */
        }
        .mobile-tab-bar {
            display: flex;
        }
        .sticky-summary {
            top: 0; /* Ensure sticky on mobile */
        }
    }
</style>

<div class="search-container">
    <!-- Filters Sidebar -->
    <aside class="filters-sidebar">
        <div class="filter-group">
            <h4>Price Range (MYR)</h4>
            <input type="range" min="100" max="2000" value="2000" id="priceRange" oninput="updatePriceLabel(this.value)">
            <p>Up to RM <span id="priceLabel">2000</span></p>
        </div>
        
        <div class="filter-group">
            <h4>Stops</h4>
            <div><input type="checkbox" id="direct" checked> <label for="direct" class="label-inline">Direct</label></div>
            <div><input type="checkbox" id="1stop"> <label for="1stop" class="label-inline">1 Stop</label></div>
        </div>
        
        <div class="filter-group">
            <h4>Airlines</h4>
            <div><input type="checkbox" checked> <label class="label-inline">Malaysia Airlines</label></div>
            <div><input type="checkbox" checked> <label class="label-inline">AirAsia</label></div>
            <div><input type="checkbox" checked> <label class="label-inline">Batik Air</label></div>
            <div><input type="checkbox" checked> <label class="label-inline">Firefly</label></div>
        </div>
    </aside>
    
    <!-- Results Area -->
    <div class="results-area">
        <div class="price-alert-toggle">
            <div>
                <strong><i class="fas fa-bell"></i> Track Prices</strong>
                <p style="margin:0; font-size: 0.9rem; color: #666;">Get clean alerts when price drops below RM 250</p>
            </div>
            <div class="switch">
                 <input type="checkbox" id="priceAlertSwitch">
                 <label for="priceAlertSwitch">On</label>
            </div>
        </div>

        <div id="flight-results-list">
            <?php foreach ($flights as $flight): ?>
            <div class="flight-card" data-price="<?= $flight->base_price ?>">
                <div class="flight-info">
                    <div class="airline-logo">
                        <!-- Placeholder for Airline Logo -->
                        <i class="fas fa-plane"></i>
                    </div>
                    <div class="route-time">
                        <span class="time"><?= h($flight->departure_time->format('H:i')) ?></span>
                        <span class="airport-code"><?= $flight->hasValue('origin_airport') ? h($flight->origin_airport->airport_code) : 'ORG' ?></span>
                    </div>
                    <div class="duration-line">
                        <span class="duration-text">2h 30m</span>
                        <div class="line"></div>
                        <span class="duration-text">Direct</span>
                    </div>
                    <div class="route-time">
                        <span class="time"><?= h($flight->departure_time->modify('+2 hours 30 minutes')->format('H:i')) ?></span> <!-- Mock Arrival -->
                        <span class="airport-code"><?= $flight->hasValue('dest_airport') ? h($flight->dest_airport->airport_code) : 'DES' ?></span>
                    </div>
                </div>
                <div class="price-action">
                    <span class="price">RM <?= $this->Number->format($flight->base_price) ?></span>
                    <?= $this->Html->link(__('Select'), ['action' => 'view', $flight->id], ['class' => 'button']) ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->numbers() ?>
            </ul>
        </div>
    </div>
</div>

<!-- Mobile Bottom Tab Bar -->
<div class="mobile-tab-bar">
    <a href="/" class="mobile-tab-item">
        <i class="fas fa-home"></i>
        Home
    </a>
    <a href="#" class="mobile-tab-item">
        <i class="fas fa-ticket-alt"></i>
        My Trips
    </a>
    <a href="#" class="mobile-tab-item">
        <i class="fas fa-bell"></i>
        Alerts
    </a>
    <a href="/users/settings" class="mobile-tab-item">
        <i class="fas fa-user"></i>
        Profile
    </a>
</div>

<script>
    function updatePriceLabel(val) {
        document.getElementById('priceLabel').innerText = val;
        filterFlights();
    }
    
    // Simple client-side filter for demo purposes ( Real-time simulation)
    function filterFlights() {
        const maxPrice = document.getElementById('priceRange').value;
        const cards = document.querySelectorAll('.flight-card');
        
        cards.forEach(card => {
            const price = parseFloat(card.getAttribute('data-price'));
            if (price <= maxPrice) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
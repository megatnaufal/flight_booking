<?php
/**
 * @var \App\View\AppView $this
 * @var array $stats
 */
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;500;700&family=Rajdhani:wght@500;700&display=swap');

    :root {
        --gotham-bg: #121212;
        --gotham-card: #1e1e1e;
        --gotham-accent: #f1c40f; /* Batman Gold */
        --gotham-text: #ecf0f1;
        --gotham-dark: #000000;
    }

    body {
        background-color: var(--gotham-bg);
        background-image: 
            linear-gradient(rgba(18, 18, 18, 0.9), rgba(18, 18, 18, 0.9)),
            url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        font-family: 'Rajdhani', sans-serif !important;
        color: var(--gotham-text);
    }
    
    .dashboards.index.content {
        background: transparent !important;
        box-shadow: none !important;
        padding-top: 50px;
    }

    h3 {
        font-family: 'Oswald', sans-serif;
        color: var(--gotham-accent);
        text-transform: uppercase;
        font-size: 2.5rem;
        letter-spacing: 3px;
        text-shadow: 0 0 10px rgba(241, 196, 15, 0.3);
        border-bottom: 2px solid var(--gotham-accent);
        padding-bottom: 10px;
        margin-bottom: 40px;
        display: inline-block;
    }

    .dashboard-card {
        background: var(--gotham-card);
        border: 1px solid #333;
        border-radius: 4px; /* Slightly rounded */
        padding: 30px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.5);
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(241, 196, 15, 0.1);
        border-color: var(--gotham-accent);
    }
    
    .dashboard-card h4 {
        color: #aaa;
        font-family: 'Oswald', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    .dashboard-card p {
        color: var(--gotham-text);
        font-family: 'Oswald', sans-serif;
        font-size: 3.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 0px #000;
    }
    
    /* Bat-Symbol effect on hover */
    .dashboard-card::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(241,196,15,0.1) 0%, transparent 70%);
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.5s ease;
    }
    .dashboard-card:hover::after {
        opacity: 1;
        transform: scale(1);
    }

</style>

<div class="dashboards index content">
    <div style="text-align: center;">
        <h3><?= __('Mission Control') ?></h3>
    </div>
    <div class="row">
        <div class="column">
            <div class="dashboard-card">
                <h4><?= __('Flights') ?></h4>
                <p><?= $this->Number->format($stats['flights']) ?></p>
            </div>
        </div>
        <div class="column">
            <div class="dashboard-card">
                <h4><?= __('Bookings') ?></h4>
                <p><?= $this->Number->format($stats['bookings']) ?></p>
            </div>
        </div>
        <div class="column">
            <div class="dashboard-card">
                <h4><?= __('Passengers') ?></h4>
                <p><?= $this->Number->format($stats['passengers']) ?></p>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="column">
            <div class="dashboard-card">
                <h4><?= __('Registered Users') ?></h4>
                <p><?= $this->Number->format($stats['users']) ?></p>
            </div>
        </div>
        <div class="column">
            <div class="dashboard-card">
                <h4><?= __('Airports') ?></h4>
                <p><?= $this->Number->format($stats['airports']) ?></p>
            </div>
        </div>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var array $stats
 */
?>


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

<?php
/**
 * @var \App\View\AppView $this
 * @var array $stats
 */
?>
<div class="dashboards index content">
    <h3><?= __('Dashboard') ?></h3>
    <div class="row">
        <div class="column">
            <div class="card" style="padding: 20px; border: 1px solid #ddd; border-radius: 5px; text-align: center;">
                <h4><?= __('Flights') ?></h4>
                <p style="font-size: 2em; font-weight: bold;"><?= $this->Number->format($stats['flights']) ?></p>
            </div>
        </div>
        <div class="column">
            <div class="card" style="padding: 20px; border: 1px solid #ddd; border-radius: 5px; text-align: center;">
                <h4><?= __('Bookings') ?></h4>
                <p style="font-size: 2em; font-weight: bold;"><?= $this->Number->format($stats['bookings']) ?></p>
            </div>
        </div>
        <div class="column">
            <div class="card" style="padding: 20px; border: 1px solid #ddd; border-radius: 5px; text-align: center;">
                <h4><?= __('Passengers') ?></h4>
                <p style="font-size: 2em; font-weight: bold;"><?= $this->Number->format($stats['passengers']) ?></p>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="column">
            <div class="card" style="padding: 20px; border: 1px solid #ddd; border-radius: 5px; text-align: center;">
                <h4><?= __('Registered Users') ?></h4>
                <p style="font-size: 2em; font-weight: bold;"><?= $this->Number->format($stats['users']) ?></p>
            </div>
        </div>
        <div class="column">
            <div class="card" style="padding: 20px; border: 1px solid #ddd; border-radius: 5px; text-align: center;">
                <h4><?= __('Airports') ?></h4>
                <p style="font-size: 2em; font-weight: bold;"><?= $this->Number->format($stats['airports']) ?></p>
            </div>
        </div>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight $flight
 */
?>
<?= $this->element('admin_theme') ?>
<div class="main-content">
    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-uppercase border-start border-4 border-primary ps-3 mb-0" style="border-color: var(--gotham-accent) !important;">View Flight</h2>
            <div>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $flight->id], ['class' => 'btn btn-outline-primary me-2']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $flight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flight->id), 'class' => 'btn btn-outline-danger me-2']) ?>
                <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th><?= __('ID') ?></th>
                <td><?= h($visualId) ?></td>
            </tr>
            <tr>
                <th><?= __('Flight Number') ?></th>
                <td><i class="bi bi-airplane me-2 text-muted"></i><?= h($flight->flight_number) ?></td>
            </tr>
            <tr>
                <th><?= __('Origin Airport') ?></th>
                <td><?= $flight->hasValue('origin_airport') ? $this->Html->link($flight->origin_airport->airport_code, ['controller' => 'Airports', 'action' => 'view', $flight->origin_airport->id], ['class' => 'text-decoration-none']) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Dest Airport') ?></th>
                <td><?= $flight->hasValue('dest_airport') ? $this->Html->link($flight->dest_airport->airport_code, ['controller' => 'Airports', 'action' => 'view', $flight->dest_airport->id], ['class' => 'text-decoration-none']) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Departure Time') ?></th>
                <td><?= h($flight->departure_time) ?></td>
            </tr>
            <tr>
                <th><?= __('Base Price') ?></th>
                <td>MYR <?= $flight->base_price === null ? '0.00' : $this->Number->format($flight->base_price) ?></td>
            </tr>
        </table>
        
        <?php if (!empty($flight->bookings)) : ?>
        <h4 class="mt-4 mb-3"><?= __('Related Bookings') ?></h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Passport Number') ?></th>
                    <th><?= __('Booking Date') ?></th>
                    <th><?= __('Seat Number') ?></th>
                    <th><?= __('Status') ?></th>
                    <th><?= __('Actions') ?></th>
                </tr>
                <?php $i = 1; foreach ($flight->bookings as $booking) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= h($booking->passenger->passport_number) ?></td>
                    <td><?= h($booking->booking_date) ?></td>
                    <td><?= h($booking->seat_number) ?></td>
                    <td><?= $booking->ticket_status === 'Confirmed' ? 'Paid' : h($booking->ticket_status) ?></td>
                    <td>
                        <?= $this->Html->link(__('View'), ['controller' => 'Bookings', 'action' => 'view', $booking->id], ['class' => 'text-primary text-decoration-none']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
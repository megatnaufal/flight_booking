<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<?= $this->element('admin_theme') ?>
<div class="main-content">
    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-uppercase border-start border-4 border-primary ps-3 mb-0" style="border-color: var(--gotham-accent) !important;">View Booking</h2>
            <div>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booking->id], ['class' => 'btn btn-outline-primary me-2']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id), 'class' => 'btn btn-outline-danger me-2']) ?>
                <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th><?= __('ID') ?></th>
                <td><?= h($visualId) ?></td>
            </tr>
            <tr>
                <th><?= __('Passenger') ?></th>
                <td><?= $booking->hasValue('passenger') ? $this->Html->link($booking->passenger->full_name, ['controller' => 'Passengers', 'action' => 'view', $booking->passenger->id], ['class' => 'text-decoration-none']) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Flight') ?></th>
                <td><?= $booking->hasValue('flight') ? $this->Html->link($booking->flight->flight_number, ['controller' => 'Flights', 'action' => 'view', $booking->flight->id], ['class' => 'text-decoration-none']) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Seat Number') ?></th>
                <td><?= h($booking->seat_number) ?></td>
            </tr>
            <tr>
                <th><?= __('Booking Date') ?></th>
                <td><?= h($booking->booking_date) ?></td>
            </tr>
            <tr>
                <th><?= __('Status') ?></th>
                <td>
                    <?php 
                        $status = strtolower($booking->ticket_status ?? ''); 
                        $isPaid = ($status == 'confirmed' || $status == 'paid');
                    ?>
                    <span class="status-badge <?= $isPaid ? 'status-paid' : 'status-unpaid' ?>">
                        <?= $isPaid ? 'Paid' : 'Pending Payment' ?>
                    </span>
                </td>
            </tr>
        </table>
        
        <?php
        // Get all passengers for this booking from BookingPassengers
        $allPassengers = [];
        if (!empty($booking->booking_passengers)) {
            $allPassengers = $booking->booking_passengers;
        }
        
        // Count by type
        $adultCount = 0;
        $childCount = 0;
        $infantCount = 0;
        foreach ($allPassengers as $p) {
            $type = strtolower($p->type ?? 'adult');
            if ($type === 'child') {
                $childCount++;
            } elseif ($type === 'infant') {
                $infantCount++;
            } else {
                $adultCount++;
            }
        }
        ?>
        
        <?php if (!empty($allPassengers)) : ?>
        <h4 class="mt-4 mb-3"><?= __('Passengers in this Booking') ?></h4>
        <div class="mb-3">
            <span class="badge bg-primary me-2"><?= $adultCount ?> Adult<?= $adultCount !== 1 ? 's' : '' ?></span>
            <span class="badge bg-success me-2"><?= $childCount ?> Child<?= $childCount !== 1 ? 'ren' : '' ?></span>
            <span class="badge bg-info"><?= $infantCount ?> Infant<?= $infantCount !== 1 ? 's' : '' ?></span>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?= __('#') ?></th>
                        <th><?= __('Type') ?></th>
                        <th><?= __('Full Name') ?></th>
                        <th><?= __('Passport Number') ?></th>
                        <th><?= __('Phone Number') ?></th>
                        <th><?= __('Seat Number') ?></th>
                        <th><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1; 
                    foreach ($allPassengers as $pax) : 
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td>
                            <?php 
                            $type = ucfirst(strtolower($pax->type ?? 'Adult'));
                            $badgeClass = match($type) {
                                'Child' => 'bg-success',
                                'Infant' => 'bg-info',
                                default => 'bg-primary'
                            };
                            ?>
                            <span class="badge <?= $badgeClass ?>"><?= h($type) ?></span>
                        </td>
                        <td><?= h($pax->full_name) ?></td>
                        <td><?= h($pax->passport_number) ?></td>
                        <td><?= h($pax->phone_number) ?></td>
                        <td>
                            <?php if (!empty($pax->seat_number)) : ?>
                                <span class="badge bg-secondary"><?= h($pax->seat_number) ?></span>
                            <?php else : ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $this->Html->link(__('View'), ['controller' => 'Passengers', 'action' => 'view', $pax->id], ['class' => 'text-primary text-decoration-none']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

    </div>
</div>
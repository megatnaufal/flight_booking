<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Passenger $passenger
 */
?>
<?= $this->element('admin_theme') ?>
<div class="main-content">
    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-uppercase border-start border-4 border-primary ps-3 mb-0" style="border-color: var(--gotham-accent) !important;">View Passenger</h2>
            <div>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $passenger->id], ['class' => 'btn btn-outline-primary me-2']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $passenger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $passenger->id), 'class' => 'btn btn-outline-danger me-2']) ?>
                <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th><?= __('ID') ?></th>
                <td><?= h($visualId) ?></td>
            </tr>
            <tr>
                <th><?= __('User Account') ?></th>
                <td><?= $passenger->hasValue('user') ? $this->Html->link($passenger->user->username, ['controller' => 'Users', 'action' => 'view', $passenger->user->id], ['class' => 'text-decoration-none']) : '<span class="text-muted">Guest</span>' ?></td>
            </tr>
            <tr>
                <th><?= __('Full Name') ?></th>
                <td><i class="bi bi-person me-2 text-muted"></i><?= h($passenger->full_name) ?></td>
            </tr>
            <tr>
                <th><?= __('Passport Number') ?></th>
                <td><?= h($passenger->passport_number) ?></td>
            </tr>
            <tr>
                <th><?= __('Phone Number') ?></th>
                <td><?= h($passenger->phone_number) ?></td>
            </tr>
            <tr>
                <th><?= __('Passenger Type') ?></th>
                <td>
                    <?php 
                    $type = ucfirst(strtolower($passenger->type ?? 'Adult'));
                    $badgeClass = match($type) {
                        'Child' => 'bg-success',
                        'Infant' => 'bg-info',
                        default => 'bg-primary'
                    };
                    ?>
                    <span class="badge <?= $badgeClass ?>"><?= h($type) ?></span>
                </td>
            </tr>
            <tr>
                <th><?= __('Seat Number') ?></th>
                <td>
                    <?php
                    $seatList = [];
                    if (!empty($passenger->bookings)) {
                        foreach ($passenger->bookings as $booking) {
                            $mySeat = null;
                            
                            // Find the passenger record for THIS booking that matches our current passenger
                            // For Return bookings, the passenger ID changes (new record), so we match by unique details
                            if (!empty($booking->booking_passengers)) {
                                foreach ($booking->booking_passengers as $p) {
                                    if ($p->id === $passenger->id || 
                                        ($p->full_name === $passenger->full_name && $p->passport_number === $passenger->passport_number)) {
                                        $mySeat = $p->seat_number;
                                        break;
                                    }
                                }
                            }

                            $flightInfo = $booking->flight->flight_number ?? '';
                            if ($mySeat) {
                                $seatList[] = h($mySeat) . ($flightInfo ? " ($flightInfo)" : '');
                            }
                        }
                    }
                    echo !empty($seatList) ? implode(', ', $seatList) : '-';
                    ?>
                </td>
            </tr>
        </table>
        

    </div>
</div>
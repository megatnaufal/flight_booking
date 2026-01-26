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
        

    </div>
</div>
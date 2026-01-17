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
        </table>
        
        <?php if (!empty($passenger->bookings)) : ?>
        <h4 class="mt-4 mb-3"><?= __('Related Bookings') ?></h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Flight Number') ?></th>
                    <th><?= __('Booking Date') ?></th>
                    <th><?= __('Seat Number') ?></th>
                    <th><?= __('Status') ?></th>
                    <th><?= __('Actions') ?></th>
                </tr>
                <?php $i = 1; foreach ($passenger->bookings as $booking) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= h($booking->flight->flight_number) ?></td>
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
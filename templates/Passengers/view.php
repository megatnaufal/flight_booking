<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Passenger $passenger
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Passenger'), ['action' => 'edit', $passenger->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Passenger'), ['action' => 'delete', $passenger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $passenger->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Passengers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Passenger'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="passengers view content">
            <h3><?= h($passenger->full_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $passenger->hasValue('user') ? $this->Html->link($passenger->user->username, ['controller' => 'Users', 'action' => 'view', $passenger->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Full Name') ?></th>
                    <td><?= h($passenger->full_name) ?></td>
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
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($passenger->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Bookings') ?></h4>
                <?php if (!empty($passenger->bookings)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Passenger Id') ?></th>
                            <th><?= __('Flight Id') ?></th>
                            <th><?= __('Booking Date') ?></th>
                            <th><?= __('Seat Number') ?></th>
                            <th><?= __('Ticket Status') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($passenger->bookings as $booking) : ?>
                        <tr>
                            <td><?= h($booking->id) ?></td>
                            <td><?= h($booking->passenger_id) ?></td>
                            <td><?= h($booking->flight_id) ?></td>
                            <td><?= h($booking->booking_date) ?></td>
                            <td><?= h($booking->seat_number) ?></td>
                            <td><?= h($booking->ticket_status) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Bookings', 'action' => 'view', $booking->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Bookings', 'action' => 'edit', $booking->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Bookings', 'action' => 'delete', $booking->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $booking->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
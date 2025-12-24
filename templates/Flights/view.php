<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight $flight
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Flight'), ['action' => 'edit', $flight->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Flight'), ['action' => 'delete', $flight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flight->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Flights'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Flight'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="flights view content">
            <h3><?= h($flight->flight_number) ?></h3>
            <table>
                <tr>
                    <th><?= __('Flight Number') ?></th>
                    <td><?= h($flight->flight_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Origin Airport') ?></th>
                    <td><?= $flight->hasValue('origin_airport') ? $this->Html->link($flight->origin_airport->airport_code, ['controller' => 'Airports', 'action' => 'view', $flight->origin_airport->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Dest Airport') ?></th>
                    <td><?= $flight->hasValue('dest_airport') ? $this->Html->link($flight->dest_airport->airport_code, ['controller' => 'Airports', 'action' => 'view', $flight->dest_airport->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($flight->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Base Price') ?></th>
                    <td><?= $flight->base_price === null ? '' : $this->Number->format($flight->base_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Departure Time') ?></th>
                    <td><?= h($flight->departure_time) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Bookings') ?></h4>
                <?php if (!empty($flight->bookings)) : ?>
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
                        <?php foreach ($flight->bookings as $booking) : ?>
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
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Booking'), ['action' => 'edit', $booking->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Booking'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Bookings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="bookings view content">
            <h3><?= h($booking->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Passenger') ?></th>
                    <td><?= $booking->hasValue('passenger') ? $this->Html->link($booking->passenger->full_name, ['controller' => 'Passengers', 'action' => 'view', $booking->passenger->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Flight') ?></th>
                    <td><?= $booking->hasValue('flight') ? $this->Html->link($booking->flight->flight_number, ['controller' => 'Flights', 'action' => 'view', $booking->flight->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Seat Number') ?></th>
                    <td><?= h($booking->seat_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ticket Status') ?></th>
                    <td><?= h($booking->ticket_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($booking->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Booking Date') ?></th>
                    <td><?= h($booking->booking_date) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Luggages') ?></h4>
                <?php if (!empty($booking->luggages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Booking Id') ?></th>
                            <th><?= __('Weight Kg') ?></th>
                            <th><?= __('Luggage Type') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($booking->luggages as $luggage) : ?>
                        <tr>
                            <td><?= h($luggage->id) ?></td>
                            <td><?= h($luggage->booking_id) ?></td>
                            <td><?= h($luggage->weight_kg) ?></td>
                            <td><?= h($luggage->luggage_type) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Luggages', 'action' => 'view', $luggage->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Luggages', 'action' => 'edit', $luggage->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Luggages', 'action' => 'delete', $luggage->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $luggage->id),
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
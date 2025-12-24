<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Luggage $luggage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Luggage'), ['action' => 'edit', $luggage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Luggage'), ['action' => 'delete', $luggage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $luggage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Luggages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Luggage'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="luggages view content">
            <h3><?= h($luggage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Booking') ?></th>
                    <td><?= $luggage->hasValue('booking') ? $this->Html->link($luggage->booking->id, ['controller' => 'Bookings', 'action' => 'view', $luggage->booking->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Luggage Type') ?></th>
                    <td><?= h($luggage->luggage_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($luggage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Weight Kg') ?></th>
                    <td><?= $luggage->weight_kg === null ? '' : $this->Number->format($luggage->weight_kg) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
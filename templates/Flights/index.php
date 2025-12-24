<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Flight> $flights
 */
?>
<div class="flights index content">
    <?= $this->Html->link(__('New Flight'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Flights') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('flight_number') ?></th>
                    <th><?= $this->Paginator->sort('origin_airport_id') ?></th>
                    <th><?= $this->Paginator->sort('dest_airport_id') ?></th>
                    <th><?= $this->Paginator->sort('departure_time') ?></th>
                    <th><?= $this->Paginator->sort('base_price') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flights as $flight): ?>
                <tr>
                    <td><?= $this->Number->format($flight->id) ?></td>
                    <td><?= h($flight->flight_number) ?></td>
                    <td><?= $flight->hasValue('origin_airport') ? $this->Html->link($flight->origin_airport->airport_code, ['controller' => 'Airports', 'action' => 'view', $flight->origin_airport->id]) : '' ?></td>
                    <td><?= $flight->hasValue('dest_airport') ? $this->Html->link($flight->dest_airport->airport_code, ['controller' => 'Airports', 'action' => 'view', $flight->dest_airport->id]) : '' ?></td>
                    <td><?= h($flight->departure_time) ?></td>
                    <td><?= $flight->base_price === null ? '' : $this->Number->format($flight->base_price) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $flight->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $flight->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $flight->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $flight->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
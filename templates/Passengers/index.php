<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Passenger> $passengers
 */
?>
<div class="passengers index content">
    <?= $this->Html->link(__('New Passenger'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Passengers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('full_name') ?></th>
                    <th><?= $this->Paginator->sort('passport_number') ?></th>
                    <th><?= $this->Paginator->sort('phone_number') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($passengers as $passenger): ?>
                <tr>
                    <td><?= $this->Number->format($passenger->id) ?></td>
                    <td><?= $passenger->hasValue('user') ? $this->Html->link($passenger->user->username, ['controller' => 'Users', 'action' => 'view', $passenger->user->id]) : '' ?></td>
                    <td><?= h($passenger->full_name) ?></td>
                    <td><?= h($passenger->passport_number) ?></td>
                    <td><?= h($passenger->phone_number) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $passenger->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $passenger->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $passenger->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $passenger->id),
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
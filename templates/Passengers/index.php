<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Passenger> $passengers
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>PASSENGERS</h2>
        <?= $this->Html->link(__('<i class="bi bi-plus-lg"></i> New Passenger'), ['action' => 'add'], ['class' => 'btn-create', 'escape' => false]) ?>
    </div>

    <div class="dashboard-card">
        <div class="table-responsive">
            <table class="table-flyhigh">
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
                        <td class="fw-bold text-muted"><?= $this->Number->format($passenger->id) ?></td>
                        <td><?= $passenger->hasValue('user') ? $this->Html->link($passenger->user->username, ['controller' => 'Users', 'action' => 'view', $passenger->user->id], ['class' => 'text-decoration-none text-white', 'style' => 'font-weight:bold;']) : '' ?></td>
                        <td><?= h($passenger->full_name) ?></td>
                        <td><span style="background: rgba(255,255,255,0.1); padding: 4px 10px; border-radius: 2px;"><?= h($passenger->passport_number) ?></span></td>
                        <td><?= h($passenger->phone_number) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $passenger->id], ['class' => 'text-primary me-2 text-decoration-none fw-bold']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $passenger->id], ['class' => 'text-muted me-2 text-decoration-none']) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $passenger->id],
                                [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $passenger->id),
                                    'class' => 'text-danger text-decoration-none'
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
            <p class="text-muted small mt-2"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
</main>
</div>
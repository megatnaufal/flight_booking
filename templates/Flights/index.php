<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Flight> $flights
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>FLIGHT SCHEDULES</h2>
        <?= $this->Html->link(__('<i class="bi bi-plus-lg"></i> New Flight'), ['action' => 'add'], ['class' => 'btn-create', 'escape' => false]) ?>
    </div>

    <div class="dashboard-card">
        <div class="table-responsive">
            <table class="table-flyhigh">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('flight_number') ?></th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th><?= $this->Paginator->sort('departure_time') ?></th>
                        <th><?= $this->Paginator->sort('base_price') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($flights as $flight): ?>
                    <tr>
                        <td class="fw-bold text-muted"><?= $this->Number->format($flight->id) ?></td>
                        <td style="color: var(--gotham-accent); font-weight: bold;"><i class="bi bi-airplane-fill me-2"></i><?= h($flight->flight_number) ?></td>
                        <td><?= $flight->hasValue('origin_airport') ? h($flight->origin_airport->airport_code) : '-' ?></td>
                        <td><?= $flight->hasValue('dest_airport') ? h($flight->dest_airport->airport_code) : '-' ?></td>
                        <td><?= h($flight->departure_time) ?></td>
                        <td>MYR <?= $flight->base_price === null ? '' : $this->Number->format($flight->base_price) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $flight->id], ['class' => 'text-primary me-2 text-decoration-none fw-bold']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $flight->id], ['class' => 'text-muted me-2 text-decoration-none']) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $flight->id],
                                [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $flight->id),
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
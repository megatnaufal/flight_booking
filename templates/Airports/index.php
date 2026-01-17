<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Airport> $airports
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back'), ['controller' => 'Dashboards', 'action' => 'index', '#' => 'airports'], ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false]) ?>
            <h2 class="m-0">AIRPORT TERMINALS</h2>
        </div>
        <?= $this->Html->link(__('<i class="bi bi-plus-lg"></i> New Airport'), ['action' => 'add'], ['class' => 'btn-create', 'escape' => false]) ?>
    </div>

    <div class="dashboard-card">
        <div class="table-responsive">
            <table class="table-flyhigh">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('airport_code') ?></th>
                        <th><?= $this->Paginator->sort('airport_name') ?></th>
                        <th><?= $this->Paginator->sort('city', 'Location') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $page = $this->Paginator->current('Airports') ?: 1;
                    $limit = $this->Paginator->param('perPage') ?: 20;
                    $counter = ($page - 1) * $limit;
                    $direction = strtolower($this->Paginator->param('direction') ?? 'asc');
                    $totalCount = $this->Paginator->param('count');
                    ?>
                    <?php foreach ($airports as $key => $airport): 
                        $rowId = ($direction === 'desc') ? $totalCount - ($counter + $key) : $counter + $key + 1;
                    ?>
                    <tr>
                        <td class="fw-bold text-muted"><?= $rowId ?></td>
                        <td class="fw-bold" style="color: #0d6efd;"><i class="bi bi-geo-alt-fill me-2"></i><?= h($airport->airport_code) ?></td>
                        <td><?= h($airport->airport_name) ?></td>
                        <td><?= h($airport->city) ?>, <?= h($airport->country) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $airport->id], ['class' => 'text-primary me-2 text-decoration-none fw-bold']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $airport->id], ['class' => 'text-muted me-2 text-decoration-none']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $airport->id], ['confirm' => __('Delete airport {0}?', $airport->airport_code), 'class' => 'text-danger text-decoration-none']) ?>
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
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Passenger> $passengers
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back'), ['controller' => 'Dashboards', 'action' => 'index', '#' => 'passengers'], ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false]) ?>
            <h2 class="m-0">PASSENGERS</h2>
        </div>
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
                        <th><?= __('Trip Type') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $page = $this->Paginator->current('Passengers') ?: 1;
                    $limit = $this->Paginator->param('perPage') ?: 20;
                    $counter = ($page - 1) * $limit;
                    $direction = strtolower($this->Paginator->param('direction') ?? 'asc');
                    $totalCount = $this->Paginator->param('count');
                    ?>
                    <?php foreach ($passengers as $key => $passenger): 
                        $rowId = ($direction === 'desc') ? $totalCount - ($counter + $key) : $counter + $key + 1;
                    ?>
                    <tr>
                        <td class="fw-bold text-muted"><?= $rowId ?></td>
                        <td><?= $passenger->hasValue('user') ? $this->Html->link($passenger->user->username, ['controller' => 'Users', 'action' => 'view', $passenger->user->id], ['class' => 'text-decoration-none text-primary', 'style' => 'font-weight:bold;']) : '<span class="text-muted">Guest</span>' ?></td>
                        <td><?= h($passenger->full_name) ?></td>
                        <td><span style="background: rgba(255,255,255,0.1); padding: 4px 10px; border-radius: 2px;"><?= h($passenger->passport_number) ?></span></td>
                        <td><?= h($passenger->phone_number) ?></td>
                        <td>
                            <?php 
                                $tripType = $passenger->booking->trip_type ?? 'One Way';
                                $tripBadgeStyle = $tripType === 'Round Trip' 
                                    ? 'background: #DBEAFE; color: #1E40AF; border: 1px solid #93C5FD;' 
                                    : 'background: #F3E8FF; color: #6B21A8; border: 1px solid #D8B4FE;';
                            ?>
                            <span class="status-badge" style="<?= $tripBadgeStyle ?>">
                                <i class="bi bi-<?= $tripType === 'Round Trip' ? 'arrow-repeat' : 'arrow-right' ?> me-1"></i><?= $tripType ?>
                            </span>
                        </td>
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
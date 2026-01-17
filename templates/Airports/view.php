<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airport $airport
 */
?>
<?= $this->element('admin_theme') ?>
<div class="main-content">
    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-uppercase border-start border-4 border-primary ps-3 mb-0" style="border-color: var(--gotham-accent) !important;">View Airport</h2>
            <div>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $airport->id], ['class' => 'btn btn-outline-primary me-2']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $airport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $airport->id), 'class' => 'btn btn-outline-danger me-2']) ?>
                <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th><?= __('ID') ?></th>
                <td><?= h($visualId) ?></td>
            </tr>
            <tr>
                <th><?= __('Airport Code') ?></th>
                <td><span class="badge bg-primary"><?= h($airport->airport_code) ?></span></td>
            </tr>
            <tr>
                <th><?= __('Airport Name') ?></th>
                <td><?= h($airport->airport_name) ?></td>
            </tr>
            <tr>
                <th><?= __('City') ?></th>
                <td><?= h($airport->city) ?></td>
            </tr>
            <tr>
                <th><?= __('Country') ?></th>
                <td><?= h($airport->country) ?></td>
            </tr>
        </table>
    </div>
</div>
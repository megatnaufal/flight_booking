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
            <h2 class="text-uppercase border-start border-4 border-primary ps-3 mb-0" style="border-color: var(--gotham-accent) !important;">Edit Airport (ID: <?= $visualId ?>)</h2>
            <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
        </div>
        <?= $this->Form->create($airport) ?>
        <div class="row g-3">
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Airport Code</label>
                <?= $this->Form->control('airport_code', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Airport Name</label>
                <?= $this->Form->control('airport_name', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">City</label>
                <?= $this->Form->control('city', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Country</label>
                <?= $this->Form->control('country', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-12 mt-4 text-end">
                 <?= $this->Form->button(__('Update Airport'), ['class' => 'btn-create']) ?>
             </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

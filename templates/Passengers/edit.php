<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Passenger $passenger
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?= $this->element('admin_theme') ?>
<div class="main-content">
    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-uppercase border-start border-4 border-primary ps-3 mb-0" style="border-color: var(--gotham-accent) !important;">Edit Passenger (ID: <?= $visualId ?>)</h2>
            <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
        </div>
        <?= $this->Form->create($passenger) ?>
        <div class="row g-3">
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">User Account</label>
                <?= $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'class' => 'form-select', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Full Name</label>
                <?= $this->Form->control('full_name', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Passport Number</label>
                <?= $this->Form->control('passport_number', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Phone Number</label>
                <?= $this->Form->control('phone_number', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-12 mt-4 text-end">
                 <?= $this->Form->button(__('Update Passenger'), ['class' => 'btn-create']) ?>
             </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

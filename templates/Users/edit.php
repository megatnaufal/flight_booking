<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?= $this->element('admin_theme') ?>
<div class="main-content">
    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-uppercase border-start border-4 border-primary ps-3 mb-0" style="border-color: var(--gotham-accent) !important;">Edit User (ID: <?= $visualId ?>)</h2>
            <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
        </div>
        <?= $this->Form->create($user) ?>
        <div class="row g-3">
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Username</label>
                <?= $this->Form->control('username', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Password</label>
                <?= $this->Form->control('password', ['class' => 'form-control', 'label' => false, 'value' => '']) ?>
                <div class="form-text small text-muted">Leave blank if not changing password</div>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Email</label>
                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Role</label>
                <?= $this->Form->control('role', ['options' => ['admin' => 'Admin', 'user' => 'User'], 'class' => 'form-select', 'label' => false]) ?>
             </div>
             <div class="col-12 mt-4 text-end">
                 <?= $this->Form->button(__('Update User'), ['class' => 'btn-create']) ?>
             </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

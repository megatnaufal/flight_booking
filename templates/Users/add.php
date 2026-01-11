<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>NEW USER</h2>
        <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="dashboard-card">
                <div class="text-center mb-4">
                    <i class="bi bi-person-plus text-muted opacity-50" style="font-size: 3rem;"></i>
                    <h5 class="mt-2 text-muted">User Registration</h5>
                </div>
                <?= $this->Form->create($user) ?>
                <fieldset class="mb-4">
                    <div class="mb-3">
                        <?= $this->Form->control('username', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                    </div>
                    <div class="mb-3">
                        <?= $this->Form->control('email', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                    </div>
                    <div class="mb-3">
                        <?= $this->Form->control('password', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                    </div>
                </fieldset>
                <?= $this->Form->button(__('Create User'), ['class' => 'btn-create w-100 justify-content-center']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</main>
</div>

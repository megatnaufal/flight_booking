<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airport $airport
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>NEW AIRPORT</h2>
        <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="dashboard-card">
                <?= $this->Form->create($airport) ?>
                <fieldset class="mb-4">
                    <legend class="text-muted mb-4">Airport Details</legend>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('airport_code', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('airport_name', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('city', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('country', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                    </div>
                </fieldset>
                <?= $this->Form->button(__('Save Airport'), ['class' => 'btn-create']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</main>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Passenger $passenger
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>NEW PASSENGER</h2>
        <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary text-white', 'escape' => false]) ?>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="dashboard-card">
                <?= $this->Form->create($passenger) ?>
                <fieldset class="mb-4">
                    <legend class="text-muted mb-4">Passenger Information</legend>
                    <div class="mb-3">
                        <?= $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'class' => 'form-select', 'label' => ['class' => 'form-label']]) ?>
                    </div>
                    <div class="mb-3">
                        <?= $this->Form->control('full_name', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('passport_number', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('phone_number', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                    </div>
                </fieldset>
                <?= $this->Form->button(__('Save Passenger'), ['class' => 'btn-create']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</main>
</div>

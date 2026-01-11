<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight $flight
 * @var \Cake\Collection\CollectionInterface|string[] $originAirports
 * @var \Cake\Collection\CollectionInterface|string[] $destAirports
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>NEW FLIGHT</h2>
        <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="dashboard-card">
                <?= $this->Form->create($flight) ?>
                <fieldset class="mb-4">
                    <legend class="text-muted mb-4">Flight Details</legend>
                    <div class="mb-3">
                        <?= $this->Form->control('flight_number', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('origin_airport_id', ['options' => $originAirports, 'empty' => true, 'class' => 'form-select', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('dest_airport_id', ['options' => $destAirports, 'empty' => true, 'class' => 'form-select', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('departure_time', ['empty' => true, 'class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('base_price', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                    </div>
                </fieldset>
                <?= $this->Form->button(__('Save Flight'), ['class' => 'btn-create']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</main>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight $flight
 * @var string[]|\Cake\Collection\CollectionInterface $originAirports
 * @var string[]|\Cake\Collection\CollectionInterface $destAirports
 */
?>
<?= $this->element('admin_theme') ?>
<div class="main-content">
    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-uppercase border-start border-4 border-primary ps-3 mb-0" style="border-color: var(--gotham-accent) !important;">Edit Flight (ID: <?= $visualId ?>)</h2>
            <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
        </div>
        <?= $this->Form->create($flight) ?>
        <div class="row g-3">
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Flight Number</label>
                <?= $this->Form->control('flight_number', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Base Price</label>
                <?= $this->Form->control('base_price', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Origin Airport</label>
                <?= $this->Form->control('origin_airport_id', ['options' => $originAirports, 'empty' => true, 'class' => 'form-select', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Destination Airport</label>
                <?= $this->Form->control('dest_airport_id', ['options' => $destAirports, 'empty' => true, 'class' => 'form-select', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Departure Time</label>
                <?= $this->Form->control('departure_time', ['empty' => true, 'class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-12 mt-4 text-end">
                 <?= $this->Form->button(__('Update Flight'), ['class' => 'btn-create']) ?>
             </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

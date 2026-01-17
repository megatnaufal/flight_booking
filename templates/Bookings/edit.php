<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var string[]|\Cake\Collection\CollectionInterface $passengers
 * @var string[]|\Cake\Collection\CollectionInterface $flights
 */
?>
<?= $this->element('admin_theme') ?>
<div class="main-content">
    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-uppercase border-start border-4 border-primary ps-3 mb-0" style="border-color: var(--gotham-accent) !important;">Edit Booking (ID: <?= $visualId ?>)</h2>
            <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
        </div>
        <?= $this->Form->create($booking) ?>
        <div class="row g-3">
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Passenger</label>
                <?= $this->Form->control('passenger_id', ['options' => $passengers, 'empty' => true, 'class' => 'form-select', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Flight</label>
                <?= $this->Form->control('flight_id', ['options' => $flights, 'empty' => true, 'class' => 'form-select', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Booking Date</label>
                <?= $this->Form->control('booking_date', ['empty' => true, 'class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Seat Number</label>
                <?= $this->Form->control('seat_number', ['class' => 'form-control', 'label' => false]) ?>
             </div>
             <div class="col-md-6">
                 <label class="form-label text-muted small fw-bold">Status</label>
                <?= $this->Form->control('ticket_status', ['options' => ['Pending Payment' => 'Pending Payment', 'Confirmed' => 'Confirmed', 'Cancelled' => 'Cancelled'], 'class' => 'form-select', 'label' => false]) ?>
             </div>
             <div class="col-12 mt-4 text-end">
                 <?= $this->Form->button(__('Update Booking'), ['class' => 'btn-create']) ?>
             </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var \Cake\Collection\CollectionInterface|string[] $passengers
 * @var \Cake\Collection\CollectionInterface|string[] $flights
 */
?>
<?= $this->element('admin_theme') ?>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>NEW BOOKING</h2>
        <?= $this->Html->link(__('<i class="bi bi-arrow-left"></i> Back to List'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary text-white', 'escape' => false]) ?>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="dashboard-card">
                <?= $this->Form->create($booking) ?>
                <fieldset class="mb-4">
                    <legend class="text-muted mb-4">Booking Details</legend>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('passenger_id', ['options' => $passengers, 'empty' => true, 'class' => 'form-select', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('flight_id', ['options' => $flights, 'empty' => true, 'class' => 'form-select', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('booking_date', ['empty' => true, 'class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $this->Form->control('seat_number', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <?= $this->Form->control('ticket_status', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
                    </div>
                </fieldset>
                <?= $this->Form->button(__('Save Booking'), ['class' => 'btn-create']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</main>
</div>

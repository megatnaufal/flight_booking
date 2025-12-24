<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight $flight
 * @var string[]|\Cake\Collection\CollectionInterface $originAirports
 * @var string[]|\Cake\Collection\CollectionInterface $destAirports
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $flight->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $flight->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Flights'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="flights form content">
            <?= $this->Form->create($flight) ?>
            <fieldset>
                <legend><?= __('Edit Flight') ?></legend>
                <?php
                    echo $this->Form->control('flight_number');
                    echo $this->Form->control('origin_airport_id', ['options' => $originAirports, 'empty' => true]);
                    echo $this->Form->control('dest_airport_id', ['options' => $destAirports, 'empty' => true]);
                    echo $this->Form->control('departure_time', ['empty' => true]);
                    echo $this->Form->control('base_price');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

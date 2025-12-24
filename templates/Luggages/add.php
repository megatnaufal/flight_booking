<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Luggage $luggage
 * @var \Cake\Collection\CollectionInterface|string[] $bookings
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Luggages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="luggages form content">
            <?= $this->Form->create($luggage) ?>
            <fieldset>
                <legend><?= __('Add Luggage') ?></legend>
                <?php
                    echo $this->Form->control('booking_id', ['options' => $bookings, 'empty' => true]);
                    echo $this->Form->control('weight_kg');
                    echo $this->Form->control('luggage_type');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

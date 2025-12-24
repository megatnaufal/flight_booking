<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Passenger $passenger
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $passenger->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $passenger->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Passengers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="passengers form content">
            <?= $this->Form->create($passenger) ?>
            <fieldset>
                <legend><?= __('Edit Passenger') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
                    echo $this->Form->control('full_name');
                    echo $this->Form->control('passport_number');
                    echo $this->Form->control('phone_number');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

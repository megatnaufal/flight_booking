<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airport $airport
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $airport->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $airport->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Airports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="airports form content">
            <?= $this->Form->create($airport) ?>
            <fieldset>
                <legend><?= __('Edit Airport') ?></legend>
                <?php
                    echo $this->Form->control('airport_code');
                    echo $this->Form->control('airport_name');
                    echo $this->Form->control('city');
                    echo $this->Form->control('country');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

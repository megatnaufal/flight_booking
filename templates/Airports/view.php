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
            <?= $this->Html->link(__('Edit Airport'), ['action' => 'edit', $airport->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Airport'), ['action' => 'delete', $airport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $airport->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Airports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Airport'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="airports view content">
            <h3><?= h($airport->airport_code) ?></h3>
            <table>
                <tr>
                    <th><?= __('Airport Code') ?></th>
                    <td><?= h($airport->airport_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Airport Name') ?></th>
                    <td><?= h($airport->airport_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('City') ?></th>
                    <td><?= h($airport->city) ?></td>
                </tr>
                <tr>
                    <th><?= __('Country') ?></th>
                    <td><?= h($airport->country) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($airport->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
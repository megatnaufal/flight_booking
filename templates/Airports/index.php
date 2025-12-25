<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Airport> $airports
 */
?>


<div class="airports index content">
    <?= $this->Html->link(__('New Airport'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Airports') ?></h3>
    
    <div class="row row-wrap">
        <?php foreach ($airports as $airport): ?>
        <div class="column column-33" style="margin-bottom: 2rem;">
            <div class="airport-card">
                <div>
                    <div class="airport-code"><?= h($airport->airport_code) ?></div>
                    <div class="airport-name"><?= h($airport->airport_name) ?></div>
                    <div class="airport-location">
                        <?= h($airport->city) ?>, <?= h($airport->country) ?>
                    </div>
                </div>
                
                <div class="card-actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $airport->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $airport->id]) ?>
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $airport->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $airport->id)]
                    ) ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Airport> $airports
 */
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;500;700&family=Rajdhani:wght@500;700&display=swap');

    :root {
        --gotham-bg: #121212;
        --gotham-card: #1e1e1e;
        --gotham-accent: #f1c40f;
        --gotham-text: #ecf0f1;
    }

    /* Reuse body styles from Dashboard via CSS file would be better, but sticking to inline for now to ensure override */
    .airports.index.content {
        background: transparent !important;
        box-shadow: none !important;
        padding-top: 20px;
    }

    .airport-card {
        background: var(--gotham-card);
        border: 1px solid #333;
        border-radius: 4px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.5);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
    }

    .airport-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(241, 196, 15, 0.1);
        border-color: var(--gotham-accent);
    }
    
    .airport-card::before {
        content: '';
        position: absolute;
        width: 3px;
        height: 100%;
        left: 0;
        top: 0;
        background: var(--gotham-accent);
        opacity: 0.5;
        transition: opacity 0.3s;
    }
    .airport-card:hover::before {
        opacity: 1;
        box-shadow: 0 0 10px var(--gotham-accent);
    }

    .airport-code {
        font-family: 'Oswald', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--gotham-accent);
        letter-spacing: 2px;
        text-shadow: 0 0 5px rgba(0,0,0,0.8);
    }

    .airport-name {
        font-family: 'Rajdhani', sans-serif;
        font-size: 1.2rem;
        font-weight: 600;
        margin-top: 5px;
        color: #ddd;
        text-transform: uppercase;
    }

    .airport-location {
        color: #888;
        font-size: 0.9rem;
        margin-bottom: 20px;
        font-style: italic;
    }

    .card-actions {
        border-top: 1px solid #333;
        padding-top: 15px;
        margin-top: auto;
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .card-actions a {
        font-family: 'Oswald', sans-serif;
        font-size: 0.9rem;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.2s;
        padding: 5px 10px;
        border: 1px solid transparent;
    }
    
    .card-actions a:nth-child(1) { color: #3498db; } /* View */
    .card-actions a:nth-child(1):hover { border-color: #3498db; background: rgba(52, 152, 219, 0.1); }
    
    .card-actions a:nth-child(2) { color: #f39c12; } /* Edit */
    .card-actions a:nth-child(2):hover { border-color: #f39c12; background: rgba(243, 156, 18, 0.1); }

    .card-actions a:nth-child(3) { color: #e74c3c; } /* Delete */
    .card-actions a:nth-child(3):hover { border-color: #e74c3c; background: rgba(231, 76, 60, 0.1); }

    .button.float-right {
        background: transparent;
        border: 2px solid var(--gotham-accent);
        color: var(--gotham-accent);
        font-family: 'Oswald', sans-serif;
        letter-spacing: 2px;
        transition: all 0.3s;
    }
    .button.float-right:hover {
        background: var(--gotham-accent);
        color: #000;
        box-shadow: 0 0 15px var(--gotham-accent);
    }
    
    h3 {
        color: var(--gotham-accent);
        font-family: 'Oswald', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
</style>

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
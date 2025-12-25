<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Login');
?>
<div class="users login content" style="max-width: 400px; margin: 40px auto;">
    <div class="card" style="text-align: center;">
        <div style="margin-bottom: 20px;">
            <!-- Bat Logo SVG -->
            <svg width="60" height="35" viewBox="0 0 100 56" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 8C35 8 20 18 15 25C15 25 10 20 5 18C5 18 5 35 15 45C22 52 35 52 50 52C65 52 78 52 85 45C95 35 95 18 95 18C90 20 85 25 85 25C80 18 65 8 50 8Z" fill="#f1c40f"/>
            </svg>
        </div>
        <h3 style="border-bottom: none; margin-bottom: 10px; font-size: 2rem;">Identify Yourself</h3>
        <?= $this->Form->create() ?>
        <fieldset style="border: none; padding: 0;">
            <div class="input" style="margin-bottom: 20px;">
                <?= $this->Form->control('email', [
                    'required' => true,
                    'style' => 'background: #121212; border: 1px solid #333; color: #ecf0f1; padding: 10px; width: 100%; border-radius: 4px;',
                    'label' => ['style' => 'color: #f1c40f; text-transform: uppercase; font-family: "Oswald"; letter-spacing: 1px;']
                ]) ?>
            </div>
            <div class="input" style="margin-bottom: 20px;">
                <?= $this->Form->control('password', [
                    'required' => true,
                    'style' => 'background: #121212; border: 1px solid #333; color: #ecf0f1; padding: 10px; width: 100%; border-radius: 4px;',
                    'label' => ['style' => 'color: #f1c40f; text-transform: uppercase; font-family: "Oswald"; letter-spacing: 1px;']
                ]) ?>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Access System'), [
            'style' => 'width: 100%; padding: 10px; font-size: 1.2rem; margin-top: 10px; cursor: pointer;'
        ]) ?>
        <?= $this->Form->end() ?>
        <p style="margin-top: 20px; color: #555; font-size: 0.8rem;">
            <?= $this->Html->link(__('Register New Identity'), ['action' => 'add']) ?>
        </p>
    </div>
</div>

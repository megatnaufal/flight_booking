<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var array $currencies
 * @var array $states
 * @var array $languages
 * @var array $paymentMethods
 */
$this->assign('title', __('Settings'));
?>
<style>
    /* Primary Blue Theme */
    :root {
        --primary-blue: #0056b3;
        --secondary-blue: #004494;
        --light-blue: #e7f1ff;
        --text-color: #333;
        --border-color: #ddd;
    }

    .settings-container {
        max-width: 800px;
        margin: 2rem auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-color);
    }

    .settings-header {
        border-bottom: 2px solid var(--primary-blue);
        margin-bottom: 2rem;
        padding-bottom: 0.5rem;
    }

    .settings-header h3 {
        color: var(--primary-blue);
        margin: 0;
        font-size: 1.8rem;
    }

    .settings-section {
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .settings-section legend {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary-blue);
        margin-bottom: 1rem;
        border-bottom: 1px solid #eee;
        width: 100%;
        padding-bottom: 0.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.6rem;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 1rem;
        box-sizing: border-box; /* Fix width overflow */
    }

    .form-control:focus {
        border-color: var(--primary-blue);
        outline: none;
        box-shadow: 0 0 0 2px var(--light-blue);
    }

    .btn-primary {
        background-color: var(--primary-blue);
        color: white;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
        display: inline-block;
    }

    .btn-primary:hover {
        background-color: var(--secondary-blue);
    }
    
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .checkbox-group input {
        margin: 0;
    }

    .note {
        font-size: 0.85rem;
        color: #666;
        margin-top: 0.2rem;
    }
</style>

<div class="settings-container">
    <div class="settings-header">
        <h3><?= __('Account Settings') ?></h3>
    </div>

    <?= $this->Form->create($user) ?>
    
    <div class="settings-section">
        <legend><i class="fas fa-map-marker-alt"></i> <?= __('Localization & Preferences') ?></legend>
        
        <div class="row">
            <div class="column">
                <div class="form-group">
                    <?= $this->Form->control('home_airport', [
                        'label' => __('Home Airport'),
                        'placeholder' => 'e.g. KLIA, Penang International',
                        'class' => 'form-control'
                    ]) ?>
                </div>
            </div>
            <div class="column">
                <div class="form-group">
                    <?= $this->Form->control('state', [
                        'label' => __('Home State'),
                        'type' => 'select',
                        'options' => $states,
                        'default' => 'Selangor',
                        'class' => 'form-control'
                    ]) ?>
                    <div class="note"><?= __('For local holiday alerts and deals.') ?></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column">
                 <div class="form-group">
                    <?= $this->Form->control('currency', [
                        'label' => __('Preferred Currency'),
                        'type' => 'select',
                        'options' => $currencies,
                        'default' => 'MYR',
                        'class' => 'form-control'
                    ]) ?>
                </div>
            </div>
            <div class="column">
                <div class="form-group">
                    <?= $this->Form->control('language', [
                        'label' => __('Language'),
                        'type' => 'select',
                        'options' => $languages,
                        'default' => 'en',
                        'class' => 'form-control'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="settings-section">
        <legend><i class="fas fa-wallet"></i> <?= __('Payment & Booking') ?></legend>
        
        <div class="form-group">
            <?= $this->Form->control('preferred_payment', [
                'label' => __('Default Payment Method'),
                'type' => 'select',
                'options' => $paymentMethods,
                'empty' => __('Select a payment method'),
                'class' => 'form-control'
            ]) ?>
            <div class="note"><?= __('Checkout faster with your favorite e-wallet.') ?></div>
        </div>
    </div>

    <div class="settings-section">
        <legend><i class="fas fa-bell"></i> <?= __('Notifications') ?></legend>
        
        <div class="checkbox-group">
             <?= $this->Form->checkbox('price_alerts', ['id' => 'price-alerts']) ?>
             <label for="price-alerts"><?= __('Receive Price Alerts & Promotion Emails') ?></label>
        </div>
        <div class="note" style="margin-left: 1.5rem;"><?= __('Get notified about Cuti-Cuti Malaysia deals.') ?></div>
    </div>

    <?= $this->Form->button(__('Save Changes'), ['class' => 'btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var array $currencies
 * @var array $states
 * @var array $languages
 */
$this->assign('title', __('Settings'));
?>
<style>
    :root {
        --primary-red: #df0100;      /* Airpaz main red */
        --secondary-red: #b00000;    /* darker red */
        --light-red: #ffe5e3;        /* soft red background */
        --text-color: #000000;
        --border-color: #e1e4e8;
        --sidebar-bg: #fafafa;
    }

    body, h1, h2, h3, h4, h5, h6, p, label, a, li, span, div, input, select, button {
        color: var(--text-color) !important;
    }

    /* Primary buttons in red */
    .button, .btn-primary, .button-primary {
        background-color: var(--primary-red) !important;
        border-color: var(--secondary-red) !important;
        color: #fff !important;
    }

    .settings-container {
        display: flex;
        min-height: 600px;
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        margin-top: 2rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Sidebar Styles */
    .settings-sidebar {
        flex: 0 0 250px;
        background: var(--sidebar-bg);
        border-right: 1px solid var(--border-color);
        padding: 2rem 0;
    }

    .settings-nav-item {
        display: flex;
        align-items: center;
        padding: 1rem 2rem;
        cursor: pointer;
        color: #000000;
        transition: all 0.2s;
        font-weight: 500;
        text-decoration: none;
        border-left: 3px solid transparent;
    }

    .settings-nav-item:hover {
        background: #eee;
        color: var(--primary-red) !important;
    }

    .settings-nav-item.active {
        background: #fff;
        color: var(--primary-red) !important;
        border-left-color: var(--primary-red);
        font-weight: bold;
        box-shadow: -1px 0 0 var(--border-color);
    }

    .settings-nav-item i {
        margin-right: 15px;
        width: 20px;
        text-align: center;
    }

    /* Content Styles */
    .settings-content-area {
        flex: 1;
        padding: 2rem 3rem;
    }

    .settings-tab {
        display: none;
    }

    .settings-tab.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .section-header {
        border-bottom: 2px solid var(--light-red);
        padding-bottom: 1rem;
        margin-bottom: 2rem;
    }

    .section-header h3 {
        color: var(--primary-red) !important;
        margin: 0;
    }

    .section-header p {
        color: #000000;
        margin: 0.5rem 0 0;
        font-size: 0.9rem;
    }

    /* Form Tweaks */
    .form-group label {
        font-weight: 600;
        color: #000000;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-color: #ccc;
        color: #000000;
    }

    .note {
        font-size: 0.85rem;
        color: #000000;
        margin-top: 0.2rem;
    }

    .card-list-item {
        border: 1px solid #eee;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .badge {
        background: #eee;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
    }

    /* Price alerts info box tint */
    .price-alerts-box {
        background: var(--light-red);
        padding: 10px;
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        .settings-container {
            flex-direction: column;
        }
        .settings-sidebar {
            flex: none;
            width: 100%;
            border-right: none;
            border-bottom: 1px solid var(--border-color);
            padding: 0;
            display: flex;
            overflow-x: auto;
        }
        .settings-nav-item {
            padding: 1rem;
            white-space: nowrap;
            border-left: none;
            border-bottom: 3px solid transparent;
        }
        .settings-nav-item.active {
            border-bottom-color: var(--primary-red);
            border-left: none;
        }
        .settings-content-area {
            padding: 1.5rem;
        }
    }
</style>

<div class="container">
    <div class="settings-container">
        <!-- Sidebar Navigation -->
        <aside class="settings-sidebar">
            <div class="settings-nav-item active" onclick="switchTab('profile')">
                <i class="fas fa-user-circle"></i> My Profile
            </div>
            <div class="settings-nav-item" onclick="switchTab('language')">
                <i class="fas fa-universal-access"></i> Language & Accessibility
            </div>
            <div class="settings-nav-item" onclick="switchTab('passengers')">
                <i class="fas fa-users"></i> Saved Passengers
            </div>
            <div class="settings-nav-item" onclick="switchTab('alerts')">
                <i class="fas fa-bell"></i> Price Alerts
            </div>
            <div class="settings-nav-item" onclick="switchTab('security')">
                <i class="fas fa-shield-alt"></i> Security
            </div>
        </aside>

        <!-- Content Area -->
        <main class="settings-content-area">
            <?= $this->Form->create($user) ?>

            <!-- 1. My Profile -->
            <div id="tab-profile" class="settings-tab active">
                <div class="section-header">
                    <h3>My Profile</h3>
                    <p>Manage your personal information and MyKad details.</p>
                </div>

                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('full_name', ['label' => 'Full Name (as per MyKad)', 'class' => 'form-control', 'placeholder' => 'e.g. AHMAD BIN ALI']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('nric', ['label' => 'NRIC Number', 'class' => 'form-control', 'placeholder' => 'e.g. 900101-14-1234']) ?>
                    </div>
                    <div class="column">
                        <?= $this->Form->control('dob', ['label' => 'Date of Birth', 'type' => 'date', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('email', ['label' => 'Email Address', 'class' => 'form-control', 'disabled' => true]) ?>
                        <small class="note">Email updates affect your login ID.</small>
                    </div>
                    <div class="column">
                        <?= $this->Form->control('phone', ['label' => 'Mobile Number', 'class' => 'form-control', 'placeholder' => '+60 12-345 6789']) ?>
                    </div>
                </div>
            </div>

            <!-- 2. Language & Accessibility -->
            <div id="tab-language" class="settings-tab">
                <div class="section-header">
                    <h3>Language & Accessibility</h3>
                    <p>Customize your viewing experience.</p>
                </div>

                <h4><i class="fas fa-language"></i> Language</h4>
                <div class="form-group" style="padding: 10px 0;">
                    <div class="radio-group" style="display: flex; gap: 20px;">
                        <div>
                            <input type="radio" id="lang-ms" name="language" value="ms">
                            <label for="lang-ms" style="display:inline;">Bahasa Melayu</label>
                        </div>
                        <div>
                            <input type="radio" id="lang-en" name="language" value="en" checked>
                            <label for="lang-en" style="display:inline;">English</label>
                        </div>
                    </div>
                </div>

                <hr>

                <h4><i class="fas fa-eye"></i> Accessibility Features</h4>

                <div class="form-group">
                    <div class="checkbox-group">
                        <?= $this->Form->checkbox('acc_high_contrast') ?>
                        <label for="acc-high-contrast" style="display:inline;">High Contrast Mode</label>
                    </div>
                    <p class="note">Increases contrast for better readability.</p>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <?= $this->Form->checkbox('acc_large_text') ?>
                        <label for="acc-large-text" style="display:inline;">Larger Text Size</label>
                    </div>
                    <p class="note">Increases font size by 20%.</p>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <?= $this->Form->checkbox('acc_reduce_motion') ?>
                        <label for="acc-reduce-motion" style="display:inline;">Reduce Motion</label>
                    </div>
                    <p class="note">Minimizes animations and transitions.</p>
                </div>
            </div>

            <!-- 3. Saved Passengers -->
            <div id="tab-passengers" class="settings-tab">
                <div class="section-header">
                    <h3>Saved Passengers</h3>
                    <p>Manage family and friends you travel with often.</p>
                </div>

                <button type="button" class="button button-outline" style="margin-bottom: 20px;">
                    <i class="fas fa-plus"></i> Add New Passenger
                </button>

                <div class="card-list-item">
                    <div>
                        <strong>Siti Aminah</strong> <span class="badge">Spouse</span><br>
                        <small>NRIC: 920505-10-5555</small>
                    </div>
                    <div>
                        <a href="#">Edit</a> | <a href="#" style="color: red;">Remove</a>
                    </div>
                </div>
                <div class="card-list-item">
                    <div>
                        <strong>Ali Bin Ahmad</strong> <span class="badge">Child</span><br>
                        <small>MyKid: 150101-10-1234</small>
                    </div>
                    <div>
                        <a href="#">Edit</a> | <a href="#" style="color: red;">Remove</a>
                    </div>
                </div>
            </div>

            <!-- 4. Price Alerts -->
            <div id="tab-alerts" class="settings-tab">
                <div class="section-header">
                    <h3>Price Alerts</h3>
                    <p>Manage your active price tracking for domestic routes.</p>
                </div>

                <div class="checkbox-group price-alerts-box" style="margin-bottom: 20px;">
                    <?= $this->Form->checkbox('promo_emails', ['checked' => true]) ?>
                    <label style="margin-bottom:0; color: var(--primary-red);">
                        Receive 'Cuti-Cuti Malaysia' promo codes via email
                    </label>
                </div>

                <div class="card-list-item">
                    <div>
                        <strong>KUL <i class="fas fa-arrow-right"></i> PEN (Penang)</strong><br>
                        <small>Alert when price &lt; RM 150</small>
                    </div>
                    <div class="switch">
                        <label class="label-inline">Active</label> <input type="checkbox" checked>
                    </div>
                </div>
                <div class="card-list-item">
                    <div>
                        <strong>KUL <i class="fas fa-arrow-right"></i> BKI (Kota Kinabalu)</strong><br>
                        <small>Alert when price &lt; RM 300</small>
                    </div>
                    <div class="switch">
                        <label class="label-inline">Active</label> <input type="checkbox" checked>
                    </div>
                </div>
            </div>

            <!-- 5. Security -->
            <div id="tab-security" class="settings-tab">
                <div class="section-header">
                    <h3>Security</h3>
                    <p>Update your password and secure your account.</p>
                </div>

                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="row">
                    <div class="column">
                        <label>New Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="column">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control">
                    </div>
                </div>

                <hr>
            </div>

            <div style="margin-top: 30px; text-align: right;">
                <?= $this->Form->button(__('Save Changes'), ['class' => 'button']) ?>
            </div>

            <?= $this->Form->end() ?>
        </main>
    </div>
</div>

<script>
    function switchTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.settings-tab').forEach(tab => {
            tab.classList.remove('active');
        });

        // Remove active class from nav items
        document.querySelectorAll('.settings-nav-item').forEach(item => {
            item.classList.remove('active');
        });

        // Show selected tab
        document.getElementById('tab-' + tabName).classList.add('active');

        // Highlight selected nav item
        const navItems = document.querySelectorAll('.settings-nav-item');
        if (tabName === 'profile') navItems[0].classList.add('active');
        if (tabName === 'language') navItems[1].classList.add('active');
        if (tabName === 'passengers') navItems[2].classList.add('active');
        if (tabName === 'alerts') navItems[3].classList.add('active');
        if (tabName === 'security') navItems[4].classList.add('active');
    }
</script>

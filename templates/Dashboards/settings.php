<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', __('Admin Settings'));
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
    
    .form-group label {
        font-weight: 600;
    }
    
    /* Toggle Switch */
    .switch {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    @media (max-width: 768px) {
        .settings-container {
            flex-direction: column;
        }
        .settings-sidebar {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            overflow-x: auto;
        }
    }
</style>

<div class="container">
    <div style="margin-bottom: 1rem;">
        <a href="<?= $this->Url->build(['action' => 'admin']) ?>"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <div class="settings-container">
        <!-- Sidebar -->
        <aside class="settings-sidebar">
            <div class="settings-nav-item active" onclick="switchTab('general')">
                <i class="fas fa-cogs"></i> General
            </div>
            <div class="settings-nav-item" onclick="switchTab('flights')">
                <i class="fas fa-plane"></i> Flight Config
            </div>
            <div class="settings-nav-item" onclick="switchTab('users')">
                <i class="fas fa-users-cog"></i> User Management
            </div>
            <div class="settings-nav-item" onclick="switchTab('security')">
                <i class="fas fa-shield-alt"></i> Security
            </div>
        </aside>

        <!-- Content -->
        <main class="settings-content-area">
            
            <!-- 1. General -->
            <div id="tab-general" class="settings-tab active">
                <div class="section-header">
                    <h3>General Settings</h3>
                    <p>System-wide configurations.</p>
                </div>
                
                <div class="form-group">
                    <label>Application Name</label>
                    <input type="text" class="form-control" value="Batman Flight Booking">
                </div>
                
                <div class="form-group">
                    <label>Maintenance Mode</label>
                    <div class="switch">
                        <input type="checkbox" id="maint-mode"> <label for="maint-mode" style="display:inline;">Enable Maintenance Mode</label>
                    </div>
                </div>
            </div>

            <!-- 2. Flight Config -->
            <div id="tab-flights" class="settings-tab">
                <div class="section-header">
                    <h3>Flight Configuration</h3>
                    <p>Manage tax rates and surcharges.</p>
                </div>
                
                <div class="row">
                    <div class="column">
                        <label>Default Tax Rate (%)</label>
                        <input type="number" class="form-control" value="6">
                    </div>
                    <div class="column">
                        <label>Fuel Surcharge (MYR)</label>
                        <input type="number" class="form-control" value="50">
                    </div>
                </div>
            </div>

            <!-- 3. User Management -->
            <div id="tab-users" class="settings-tab">
                <div class="section-header">
                    <h3>User Management</h3>
                    <p>Quick actions for user accounts.</p>
                </div>
                
                <button class="button button-outline">Reset User Password</button>
                <button class="button button-outline">Block/Unblock User</button>
            </div>

            <!-- 4. Security -->
            <div id="tab-security" class="settings-tab">
                 <div class="section-header">
                    <h3>System Security</h3>
                    <p>Access logs and restrictions.</p>
                </div>
                
                <div class="form-group">
                    <label>Admin IP Whitelist</label>
                    <textarea class="form-control" rows="3">127.0.0.1, 192.168.1.*</textarea>
                </div>
            </div>
            
            <div style="margin-top: 30px; text-align: right;">
                 <button class="button btn-primary">Save Admin Settings</button>
            </div>
        </main>
    </div>
</div>

<script>
    function switchTab(tabName) {
        document.querySelectorAll('.settings-tab').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.settings-nav-item').forEach(item => item.classList.remove('active'));
        
        document.getElementById('tab-' + tabName).classList.add('active');
        
        const navItems = document.querySelectorAll('.settings-nav-item');
        if (tabName === 'general') navItems[0].classList.add('active');
        if (tabName === 'flights') navItems[1].classList.add('active');
        if (tabName === 'users') navItems[2].classList.add('active');
        if (tabName === 'security') navItems[3].classList.add('active');
    }
</script>

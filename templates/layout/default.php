<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon', 'img/flyhigh-logo.png') ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <?= $this->Html->css(['cake']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Global Professional Font */
        body, html {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            color: #333;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            line-height: 1.3;
        }

        h1 { font-size: 2.25rem; }
        h2 { font-size: 1.875rem; }
        h3 { font-size: 1.5rem; }
        h4 { font-size: 1.25rem; }
        h5 { font-size: 1.125rem; }
        h6 { font-size: 1rem; }

        .small, small { font-size: 0.875rem; }
        
        /* Button font improvements */
        .btn {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            letter-spacing: 0.01em;
        }

        /* Form elements */
        input, select, textarea {
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
        }

        /* Table improvements */
        table {
            font-size: 0.9375rem;
        }

        th {
            font-weight: 600;
        }

        /* Top Promo Banner */
        .promo-banner { background-color: #000000; color: white; font-size: 0.75rem; padding: 6px 0; border-bottom: 1px solid #333; }
        
        /* Main Navigation */
        .top-header { 
            background-color: #4C1D95; 
            padding: 10px 0; 
            border-bottom: 1px solid #6D28D9;
            box-shadow: 0 2px 10px rgba(76, 29, 149, 0.3);
        }
        .nav-link-custom { color: white !important; font-size: 0.85rem; font-weight: 500; text-decoration: none; padding: 5px 10px; }
        .nav-link-custom:hover { opacity: 0.8; }
        .badge-new { background-color: #10B981; color: #fff; font-size: 0.6rem; padding: 1px 4px; border-radius: 4px; vertical-align: top; margin-left: 2px; }
        
        /* Language/User Links */
        .user-nav-link {
            color: white;
            font-size: 0.8rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Auth / Settings Modals shared styles */
        .form-control-dark, .form-select.form-control-dark {
            background: #121212;
            border: 1px solid #333;
            color: #ecf0f1;
        }
        .form-control-dark:focus,
        .form-select.form-control-dark:focus {
            background: #1a1a1a;
            border-color: #7C3AED;
            color: #ecf0f1;
            box-shadow: 0 0 10px rgba(124, 58, 237, 0.2);
        }
        .form-control-dark::placeholder {
            color: #666;
        }
        .text-gold {
            color: #7C3AED;
        }
        .btn-gold {
            background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%);
            color: #ffffff;
            border: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-gold:hover {
            box-shadow: 0 0 20px rgba(124, 58, 237, 0.5);
            transform: translateY(-2px);
            color: #ffffff;
        }
        .nav-tabs .nav-link {
            color: #999;
        }
        .nav-tabs .nav-link.active {
            color: #7C3AED !important;
            background: transparent !important;
            border-bottom: 2px solid #7C3AED !important;
        }
        .form-check-input:checked {
            background-color: #7C3AED;
            border-color: #7C3AED;
        }

        /* Optional: high contrast mode */
        html.high-contrast body {
            background-color: #000;
            color: #fff;
        }
        html.high-contrast a {
            color: #7C3AED;
        }

        /* Fix gap between header and video */
        body, html { margin: 0; padding: 0; }
        .top-header { margin-bottom: 0 !important; }
        .main { padding-top: 0 !important; margin-top: 0 !important; }
        .container-fluid { padding: 0 !important; }
    </style>
</head>
<body>


    <header class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 d-flex align-items-center gap-3">
                    <a href="<?= $this->Url->build('/') ?>" class="text-decoration-none me-3">
                        <img src="<?= $this->Url->build('/img/flyhigh-logo.png') ?>" alt="FlyHigh Logo" class="logo-img" style="height: 80px;">
                    </a>
                    <nav class="d-none d-md-flex">
                        <a href="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" class="nav-link-custom">Flight</a>
                        <a href="#" class="nav-link-custom">Hotel</a>
                        <a href="#" class="nav-link-custom">Promo</a>
                        <a href="#" class="nav-link-custom">Orders</a>
                        <a href="#" class="nav-link-custom">Deals <span class="badge-new">NEW</span></a>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'about']) ?>" class="nav-link-custom">About Us</a>
                    </nav>
                </div>

                <div class="col-lg-6 d-flex justify-content-end align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <a href="#" class="user-nav-link"><i class="bi bi-translate"></i> MYR</a>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'help']) ?>" class="user-nav-link">Help</a>
                    </div>
                    <?php 
                     $identity = $this->request->getAttribute('identity');
                     if (!$identity) {
                         $identity = $this->request->getSession()->read('Auth');
                     }
                     // Helper to access identity properties (handles both array and object)
                     $getIdentityProp = function($prop) use ($identity) {
                         if (is_array($identity)) {
                             return $identity[$prop] ?? null;
                         }
                         return $identity->$prop ?? null;
                     };
                    if ($identity): 
                    ?>
                        <div class="dropdown border-start ps-4">
                            <a href="#" class="user-nav-link fw-bold dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?= h($getIdentityProp('full_name') ?: $getIdentityProp('email')) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow" style="background: #1a1a1a; border-color: #333; min-width: 200px;">
                                <li class="px-3 py-3 border-bottom border-secondary">
                                    <div class="d-flex align-items-center gap-3">
                                        <!-- Profile Picture Placeholder -->
                                        <div class="rounded-circle bg-dark d-flex align-items-center justify-content-center border border-secondary" style="width: 48px; height: 48px;">
                                            <i class="bi bi-person-fill text-secondary" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <!-- User Info -->
                                        <div class="overflow-hidden">
                                            <div class="fw-bold text-white text-truncate"><?= h($getIdentityProp('username') ?: $getIdentityProp('email')) ?></div>
                                            <div class="small text-secondary text-truncate"><?= h($getIdentityProp('email')) ?></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="dropdown-item text-white my-1" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'settings']) ?>">
                                        <i class="bi bi-person-gear me-2"></i> Profile
                                    </a>
                                </li>
                                <!-- Open Settings modal from here -->
                                <li>
                                    <a class="dropdown-item text-white my-1"
                                       href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#settingsModal">
                                        <i class="bi bi-gear me-2"></i> Settings
                                    </a>
                                </li>
                                <?php if ($getIdentityProp('role') && strtolower($getIdentityProp('role')) === 'admin'): ?>
                                    <li><a class="dropdown-item text-white my-1" href="<?= $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']) ?>"><i class="bi bi-speedometer2 me-2"></i> Admin Dashboard</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item text-white my-1" href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'myBookings']) ?>"><i class="bi bi-ticket-perforated me-2"></i> My Bookings</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider border-secondary"></li>
                                <li><a class="dropdown-item text-danger my-1" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="#" class="user-nav-link fw-bold border-start ps-4" data-bs-toggle="modal" data-bs-target="#authModal">
                            <i class="bi bi-person-circle"></i> Sign In / Register
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container-fluid p-0">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <!-- Authentication Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #ffffff; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
                <div class="modal-header border-bottom border-light">
                    <h5 class="modal-title fw-bold" style="color: #4C1D95;" id="authModalLabel">
                        <i class="bi bi-person-circle me-2"></i>Account Access
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs border-bottom border-light" id="authTab" role="tablist" style="background: #FAFAFA;">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link active w-100 fw-bold" id="signin-tab" data-bs-toggle="tab" data-bs-target="#signin" type="button" role="tab" aria-controls="signin" aria-selected="true" style="border: none; background: transparent; color: #4C1D95;">
                                Sign In
                            </button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 fw-bold" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false" style="border: none; background: transparent; color: #666;">
                                Register
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content p-4" id="authTabContent">
                        <!-- Sign In Tab -->
                        <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                            <?= $this->Form->create(null, [
                                'url' => ['controller' => 'Users', 'action' => 'login'],
                                'class' => 'auth-form'
                            ]) ?>
                                <div class="mb-3">
                                    <label class="form-label small" style="color: #4C1D95;">Email</label>
                                    <input type="email" name="email" class="form-control" style="background: #f8f8f8; border: 1px solid #ddd; color: #333;" placeholder="your@email.com" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small" style="color: #4C1D95;">Password</label>
                                    <input type="password" name="password" class="form-control" style="background: #f8f8f8; border: 1px solid #ddd; color: #333;" placeholder="••••••••" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label small text-muted" for="rememberMe">Remember me</label>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gold">Sign In</button>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="#" class="small text-decoration-none" style="color: #7C3AED;">Forgot password?</a>
                                </div>
                            <?= $this->Form->end() ?>
                        </div>

                        <!-- Register Tab -->
                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <?= $this->Form->create(null, [
                                'url' => ['controller' => 'Users', 'action' => 'add'],
                                'class' => 'auth-form'
                            ]) ?>
                                <div class="mb-3">
                                    <label class="form-label small" style="color: #4C1D95;">Email</label>
                                    <input type="email" name="email" class="form-control" style="background: #f8f8f8; border: 1px solid #ddd; color: #333;" placeholder="your@email.com" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small" style="color: #4C1D95;">Username</label>
                                    <input type="text" name="username" class="form-control" style="background: #f8f8f8; border: 1px solid #ddd; color: #333;" placeholder="username" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small" style="color: #4C1D95;">Password</label>
                                    <input type="password" name="password" class="form-control" style="background: #f8f8f8; border: 1px solid #ddd; color: #333;" placeholder="••••••••" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                                    <label class="form-check-label small text-muted" for="agreeTerms">I agree to the terms and conditions</label>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gold">Create Account</button>
                                </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Modal (language, currency, accessibility) -->
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #111; border: 1px solid #333;">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title text-gold fw-bold" id="settingsModalLabel">
                        <i class="bi bi-gear me-2"></i>Account Settings
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- You can change URL to your real save action -->
                    <?= $this->Form->create(null, [
                        'url' => ['controller' => 'Users', 'action' => 'updateSettings'],
                        'class' => 'settings-form'
                    ]) ?>

                        <!-- Language -->
                        <div class="mb-3">
                            <label class="form-label text-gold small">Language</label>
                            <select name="language" class="form-select form-control-dark">
                                <option value="en">English</option>
                                <option value="ms">Bahasa Malaysia</option>
                            </select>
                        </div>

                        <!-- Currency -->
                        <div class="mb-3">
                            <label class="form-label text-gold small">Currency</label>
                            <select name="currency" class="form-select form-control-dark">
                                <option value="MYR">MYR – Malaysian Ringgit</option>
                            </select>
                        </div>

                        <!-- Accessibility / Theme -->
                        <div class="mb-3">
                            <label class="form-label text-gold small">Display & accessibility</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="highContrastToggle">
                                <label class="form-check-label text-white small" for="Enable dark mode">
                                    Enable dark mode
                                </label>
                            </div>
                            <div class="mt-2">
                                <label class="form-label text-gold small">Font size</label>
                                <select name="font_size" class="form-select form-control-dark" id="fontSizeSelect">
                                    <option value="normal">Normal</option>
                                    <option value="large">Large</option>
                                    <option value="xlarge">Extra large</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-gold">Save settings</button>
                        </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Simple front-end theme + accessibility toggles -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const html = document.documentElement;
            const darkToggle = document.getElementById('darkModeToggle');
            const contrastToggle = document.getElementById('highContrastToggle');
            const fontSizeSelect = document.getElementById('fontSizeSelect');

            // Initialize from localStorage if available
            const storedTheme = localStorage.getItem('flyhigh-theme');
            const storedContrast = localStorage.getItem('flyhigh-contrast');
            const storedFontSize = localStorage.getItem('flyhigh-fontsize');

            if (storedTheme === 'dark') {
                html.setAttribute('data-bs-theme', 'dark');
                if (darkToggle) darkToggle.checked = true;
            } else {
                html.setAttribute('data-bs-theme', 'light');
                if (darkToggle) darkToggle.checked = false;
            }

            if (storedContrast === 'high') {
                html.classList.add('high-contrast');
                if (contrastToggle) contrastToggle.checked = true;
            }

            if (storedFontSize && fontSizeSelect) {
                fontSizeSelect.value = storedFontSize;
                applyFontSize(storedFontSize);
            }

            if (darkToggle) {
                darkToggle.addEventListener('change', function () {
                    const theme = this.checked ? 'dark' : 'light';
                    html.setAttribute('data-bs-theme', theme);
                    localStorage.setItem('flyhigh-theme', theme);
                });
            }

            if (contrastToggle) {
                contrastToggle.addEventListener('change', function () {
                    if (this.checked) {
                        html.classList.add('high-contrast');
                        localStorage.setItem('flyhigh-contrast', 'high');
                    } else {
                        html.classList.remove('high-contrast');
                        localStorage.setItem('flyhigh-contrast', 'normal');
                    }
                });
            }

            if (fontSizeSelect) {
                fontSizeSelect.addEventListener('change', function () {
                    applyFontSize(this.value);
                    localStorage.setItem('flyhigh-fontsize', this.value);
                });
            }

            function applyFontSize(size) {
                if (size === 'large') {
                    document.body.style.fontSize = '17px';
                } else if (size === 'xlarge') {
                    document.body.style.fontSize = '19px';
                } else {
                    document.body.style.fontSize = '15px';
                }
            }

            // Auto-dismiss flash messages after 3 seconds
            const flashMessages = document.querySelectorAll('.message, .alert, .alert-success, .alert-danger, .alert-warning, .alert-info');
            if (flashMessages.length > 0) {
                setTimeout(function() {
                    flashMessages.forEach(function(msg) {
                        // Bootstrap fade out effect
                        msg.style.transition = 'opacity 0.5s ease';
                        msg.style.opacity = '0';
                        setTimeout(function() {
                            msg.remove();
                        }, 500);
                    });
                }, 3000);
            }
        });
    </script>
</body>
</html>

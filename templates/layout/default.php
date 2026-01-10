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
    <?= $this->Html->meta('icon') ?>

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
            background-color: #000000; 
            padding: 0; 
            border-bottom: 1px solid #333;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        
        .logo-img {
            transition: transform 0.3s ease;
        }
        
        .logo-img:hover {
            transform: scale(1.05);
        }
        
        .nav-link-custom { 
            color: white !important; 
            font-size: 0.9rem; 
            font-weight: 500; 
            text-decoration: none; 
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        
        .nav-link-custom:hover { 
            background: rgba(255, 211, 0, 0.1);
            color: #FFD300 !important;
        }
        
        .badge-new { 
            background-color: #f1c40f; 
            color: #000; 
            font-size: 0.55rem; 
            padding: 2px 6px; 
            border-radius: 10px; 
            font-weight: 600;
            margin-left: 4px;
            position: absolute;
            top: -5px;
            right: -5px;
        }
        
        /* Language/User Links */
        .user-nav-link { 
            color: white; 
            font-size: 0.85rem; 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 5px;
            padding: 6px 10px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .user-nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #FFD300;
        }
        
        /* Cart Badge */
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #FFD300;
            color: #000;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
        }
        
        /* Button Styles */
        .btn-outline-gold {
            border: 2px solid #FFD300;
            color: #FFD300;
            background: transparent;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-gold:hover {
            background: #FFD300;
            color: #000;
            box-shadow: 0 0 15px rgba(255, 211, 0, 0.4);
        }
        
        /* Mobile Navigation */
        .nav-link-mobile {
            color: white;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .nav-link-mobile:hover {
            background: rgba(255, 211, 0, 0.1);
            color: #FFD300;
        }
        
        /* Dropdown Improvements */
        .dropdown-menu {
            animation: fadeIn 0.2s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .dropdown-item:hover {
            background: rgba(255, 211, 0, 0.1) !important;
        }
    </style>
</head>
<body>
    <div class="promo-banner text-center">
        <div class="container position-relative">
            Save big! MYR 300 OFF use code <strong>ADVENTURECALLS</strong> ! - download the app & register now!
            <button type="button" class="btn-close btn-close-white position-absolute end-0 top-50 translate-middle-y small" style="font-size: 0.5rem;" aria-label="Close"></button>
        </div>
    </div>

    <header class="top-header">
        <div class="container">
            <div class="row align-items-center py-2">
                <!-- Logo Section -->
                <div class="col-auto">
                    <a href="<?= $this->Url->build('/') ?>" class="d-flex align-items-center text-decoration-none">
                        <img src="<?= $this->Url->build('/img/flyhigh-logo.png') ?>" alt="FlyHigh" style="height: 50px;" class="logo-img">
                    </a>
                </div>

                <!-- Main Navigation -->
                <div class="col d-none d-lg-block">
                    <nav class="d-flex align-items-center gap-1 ms-3">
                        <a href="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" class="nav-link-custom">
                            <i class="bi bi-airplane me-1"></i> Flights
                        </a>
                        <a href="#" class="nav-link-custom">
                            <i class="bi bi-building me-1"></i> Hotels
                        </a>
                        <a href="#" class="nav-link-custom">
                            <i class="bi bi-tag me-1"></i> Promos
                        </a>
                        <a href="#" class="nav-link-custom">
                            <i class="bi bi-receipt me-1"></i> My Orders
                        </a>
                        <a href="#" class="nav-link-custom position-relative">
                            <i class="bi bi-star me-1"></i> Deals
                            <span class="badge-new">NEW</span>
                        </a>
                    </nav>
                </div>

                <!-- Right Side Actions -->
                <div class="col-auto ms-auto">
                    <div class="d-flex align-items-center gap-3">
                        <!-- Currency & Help -->
                        <div class="d-none d-md-flex align-items-center gap-3">
                            <a href="#" class="user-nav-link" title="Currency">
                                <i class="bi bi-currency-exchange"></i>
                                <span class="d-none d-lg-inline ms-1">MYR</span>
                            </a>
                            <a href="#" class="user-nav-link" title="Help Center">
                                <i class="bi bi-question-circle"></i>
                                <span class="d-none d-lg-inline ms-1">Help</span>
                            </a>
                        </div>

                        <!-- Cart -->
                        <a href="#" class="user-nav-link position-relative" title="Shopping Cart">
                            <i class="bi bi-cart3 fs-5"></i>
                            <span class="cart-badge">0</span>
                        </a>

                        <!-- User Account -->
                        <?php 
                         $identity = $this->request->getAttribute('identity');
                         if (!$identity) {
                             $identity = $this->request->getSession()->read('Auth');
                         }
                        if ($identity): 
                        ?>
                            <div class="dropdown">
                                <a href="#" class="user-nav-link fw-bold dropdown-toggle text-decoration-none d-flex align-items-center gap-2 px-3 py-2 rounded" data-bs-toggle="dropdown" aria-expanded="false" style="background: rgba(255, 211, 0, 0.1); border: 1px solid rgba(255, 211, 0, 0.3);">
                                    <i class="bi bi-person-circle fs-5"></i>
                                    <span class="d-none d-lg-inline"><?= h($identity->full_name ?: $identity->email) ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow-lg" style="background: #1a1a1a; border-color: #333; min-width: 250px; margin-top: 0.5rem;">
                                    <li class="px-3 py-3 border-bottom border-secondary">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-person-circle fs-3 text-gold"></i>
                                            <div>
                                                <div class="fw-bold text-gold"><?= h($identity->full_name ?: 'User') ?></div>
                                                <div class="small text-white-50 text-truncate" style="max-width: 180px;"><?= h($identity->email) ?></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="dropdown-item text-white py-2" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>"><i class="bi bi-person me-2"></i> My Profile</a></li>
                                    <li><a class="dropdown-item text-white py-2" href="#"><i class="bi bi-ticket-perforated me-2"></i> My Bookings</a></li>
                                    <li><a class="dropdown-item text-white py-2" href="#"><i class="bi bi-heart me-2"></i> Wishlist</a></li>
                                    <li><a class="dropdown-item text-white py-2" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'settings']) ?>"><i class="bi bi-gear me-2"></i> Settings</a></li>
                                    <li><hr class="dropdown-divider border-secondary my-2"></li>
                                    <li><a class="dropdown-item text-danger py-2" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a href="#" class="btn btn-outline-gold btn-sm px-3 py-2" data-bs-toggle="modal" data-bs-target="#authModal">
                                <i class="bi bi-person-circle me-1"></i>
                                <span class="d-none d-sm-inline">Sign In</span>
                            </a>
                        <?php endif; ?>

                        <!-- Mobile Menu Toggle -->
                        <button class="btn btn-link text-white d-lg-none p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                            <i class="bi bi-list fs-3"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" style="background: #0a0a0a; color: white;">
        <div class="offcanvas-header border-bottom border-secondary">
            <h5 class="offcanvas-title text-gold">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="d-flex flex-column gap-2">
                <a href="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" class="nav-link-mobile">
                    <i class="bi bi-airplane me-2"></i> Flights
                </a>
                <a href="#" class="nav-link-mobile">
                    <i class="bi bi-building me-2"></i> Hotels
                </a>
                <a href="#" class="nav-link-mobile">
                    <i class="bi bi-tag me-2"></i> Promos
                </a>
                <a href="#" class="nav-link-mobile">
                    <i class="bi bi-receipt me-2"></i> My Orders
                </a>
                <a href="#" class="nav-link-mobile">
                    <i class="bi bi-star me-2"></i> Deals <span class="badge-new ms-2">NEW</span>
                </a>
                <hr class="border-secondary">
                <a href="#" class="nav-link-mobile">
                    <i class="bi bi-currency-exchange me-2"></i> Currency (MYR)
                </a>
                <a href="#" class="nav-link-mobile">
                    <i class="bi bi-question-circle me-2"></i> Help Center
                </a>
            </nav>
        </div>
    </div>


    <main class="main">
        <div class="container-fluid p-0">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <!-- Authentication Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: linear-gradient(145deg, #1a1a1a 0%, #0d0d0d 100%); border: 1px solid #333;">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title text-gold fw-bold" id="authModalLabel">
                        <i class="bi bi-person-circle me-2"></i>Account Access
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs border-bottom border-secondary" id="authTab" role="tablist" style="background: #0a0a0a;">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link active w-100 text-white fw-bold" id="signin-tab" data-bs-toggle="tab" data-bs-target="#signin" type="button" role="tab" aria-controls="signin" aria-selected="true" style="border: none; background: transparent;">
                                Sign In
                            </button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 text-white fw-bold" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false" style="border: none; background: transparent;">
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
                                    <label class="form-label text-gold small">Email</label>
                                    <input type="email" name="email" class="form-control form-control-dark" placeholder="your@email.com" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-gold small">Password</label>
                                    <input type="password" name="password" class="form-control form-control-dark" placeholder="••••••••" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label text-white small" for="rememberMe">Remember me</label>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gold">Sign In</button>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="#" class="text-gold small text-decoration-none">Forgot password?</a>
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
                                    <label class="form-label text-gold small">Email</label>
                                    <input type="email" name="email" class="form-control form-control-dark" placeholder="your@email.com" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-gold small">Username</label>
                                    <input type="text" name="username" class="form-control form-control-dark" placeholder="username" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-gold small">Password</label>
                                    <input type="password" name="password" class="form-control form-control-dark" placeholder="••••••••" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                                    <label class="form-check-label text-white small" for="agreeTerms">I agree to the terms and conditions</label>
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

    <style>
        .form-control-dark {
            background: #121212;
            border: 1px solid #333;
            color: #ecf0f1;
        }
        .form-control-dark:focus {
            background: #1a1a1a;
            border-color: #FFD300;
            color: #ecf0f1;
            box-shadow: 0 0 10px rgba(255, 211, 0, 0.2);
        }
        .form-control-dark::placeholder {
            color: #666;
        }
        .text-gold {
            color: #FFD300;
        }
        .btn-gold {
            background: linear-gradient(180deg, #FFD300 0%, #c9a600 100%);
            color: #0a0a0a;
            border: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-gold:hover {
            box-shadow: 0 0 20px rgba(255, 211, 0, 0.5);
            transform: translateY(-2px);
            color: #0a0a0a;
        }
        .nav-tabs .nav-link {
            color: #999;
        }
        .nav-tabs .nav-link.active {
            color: #FFD300 !important;
            background: transparent !important;
            border-bottom: 2px solid #FFD300 !important;
        }
        .form-check-input:checked {
            background-color: #FFD300;
            border-color: #FFD300;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

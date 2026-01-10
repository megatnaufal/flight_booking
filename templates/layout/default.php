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
        .top-header { background-color: #000000; padding: 10px 0; border-bottom: 1px solid #333; }
        .nav-link-custom { color: white !important; font-size: 0.85rem; font-weight: 500; text-decoration: none; padding: 5px 10px; }
        .nav-link-custom:hover { opacity: 0.8; }
        .badge-new { background-color: #f1c40f; color: #000; font-size: 0.6rem; padding: 1px 4px; border-radius: 4px; vertical-align: top; margin-left: 2px; }
        
        /* Language/User Links */
        .user-nav-link { color: white; font-size: 0.8rem; text-decoration: none; display: flex; align-items: center; gap: 5px; }
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
            <div class="row align-items-center">
                <div class="col-lg-6 d-flex align-items-center gap-3">
                    <a href="<?= $this->Url->build('/') ?>" class="text-white h3 fw-bold mb-0 text-decoration-none me-3">FlyHigh</a>
                    <nav class="d-none d-md-flex">
                        <a href="#" class="nav-link-custom">Flight</a>
                        <a href="#" class="nav-link-custom">Hotel</a>
                        <a href="#" class="nav-link-custom">Promo</a>
                        <a href="#" class="nav-link-custom">Orders</a>
                        <a href="#" class="nav-link-custom">Deals <span class="badge-new">NEW</span></a>
                    </nav>
                </div>

                <div class="col-lg-6 d-flex justify-content-end align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <a href="#" class="user-nav-link"><i class="bi bi-translate"></i> MYR</a>
                        <a href="#" class="user-nav-link">Help</a>
                        <a href="#" class="user-nav-link"><i class="bi bi-cart3"></i></a>
                    </div>
                    <?php 
                     $identity = $this->request->getAttribute('identity');
                     if (!$identity) {
                         $identity = $this->request->getSession()->read('Auth');
                     }
                    if ($identity): 
                    ?>
                        <div class="dropdown border-start ps-4">
                            <a href="#" class="user-nav-link fw-bold dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?= h($identity->full_name ?: $identity->email) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow" style="background: #1a1a1a; border-color: #333; min-width: 200px;">
                                <li class="px-3 py-2 border-bottom border-secondary">
                                    <div class="fw-bold text-gold"><?= h($identity->full_name ?: 'User') ?></div>
                                    <div class="small text-white text-truncate" style="max-width: 180px;"><?= h($identity->email) ?></div>
                                </li>
                                <li><a class="dropdown-item text-white my-1" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'settings']) ?>"><i class="bi bi-gear me-2"></i> Settings</a></li>
                                <li><a class="dropdown-item text-white my-1" href="#"><i class="bi bi-ticket-perforated me-2"></i> My Bookings</a></li>
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

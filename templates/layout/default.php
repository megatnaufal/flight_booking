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

<<<<<<< HEAD
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'gotham']) ?>
=======
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
>>>>>>> test3

    <?= $this->Html->css(['cake']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <style>
        /* Top Promo Banner */
        .promo-banner { background-color: #d31d24; color: white; font-size: 0.75rem; padding: 6px 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
        
        /* Main Navigation */
        .top-header { background-color: #e62129; padding: 10px 0; }
        .nav-link-custom { color: white !important; font-size: 0.85rem; font-weight: 500; text-decoration: none; padding: 5px 10px; }
        .nav-link-custom:hover { opacity: 0.8; }
        .badge-new { background-color: #ffcc00; color: #333; font-size: 0.6rem; padding: 1px 4px; border-radius: 4px; vertical-align: top; margin-left: 2px; }
        
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
                    <a href="<?= $this->Url->build('/') ?>" class="text-white h3 fw-bold mb-0 text-decoration-none me-3">Airpaz</a>
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
                    <a href="#" class="user-nav-link fw-bold border-start ps-4">
                        <i class="bi bi-person-circle"></i> Sign In / Register
                    </a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

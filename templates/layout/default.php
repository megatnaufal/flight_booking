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
    
    <!-- Flatpickr Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">

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
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* ===== Dark Mode Styles ===== */
        body.dark-mode {
            background-color: #0f0f23 !important;
            color: #e2e8f0 !important;
        }
        
        body.dark-mode .bg-white,
        body.dark-mode .bg-light {
            background-color: #1a1a2e !important;
        }
        
        body.dark-mode .card,
        body.dark-mode .dashboard-card {
            background-color: #1a1a2e !important;
            border-color: #2d2d44 !important;
        }
        
        body.dark-mode .text-dark {
            color: #e2e8f0 !important;
        }
        
        body.dark-mode .text-muted {
            color: #a0aec0 !important;
        }
        
        body.dark-mode h1, body.dark-mode h2, body.dark-mode h3, 
        body.dark-mode h4, body.dark-mode h5, body.dark-mode h6 {
            color: #f7fafc !important;
        }
        
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background-color: #2d2d44 !important;
            border-color: #3d3d5c !important;
            color: #e2e8f0 !important;
        }
        
        body.dark-mode .form-control::placeholder {
            color: #718096 !important;
        }
        
        body.dark-mode .navbar,
        body.dark-mode .top-header {
            background-color: #1a1a2e !important;
        }
        
        body.dark-mode footer,
        body.dark-mode .footer-section {
            background-color: #0f0f23 !important;
            border-color: #2d2d44 !important;
        }
        
        body.dark-mode .footer-link {
            color: #a0aec0 !important;
        }
        
        body.dark-mode .border,
        body.dark-mode .border-bottom,
        body.dark-mode .border-top {
            border-color: #2d2d44 !important;
        }
        
        body.dark-mode .shadow-sm {
            box-shadow: 0 1px 3px rgba(0,0,0,0.4) !important;
        }
        
        body.dark-mode .table {
            color: #e2e8f0 !important;
        }
        
        body.dark-mode .table thead th {
            background-color: #1a1a2e !important;
            border-color: #2d2d44 !important;
        }
        
        body.dark-mode .table tbody td {
            border-color: #2d2d44 !important;
        }
        
        body.dark-mode .flight-search-header {
            background-color: #1a1a2e !important;
        }
        
        body.dark-mode .hexagon-bg {
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 100%) !important;
        }
        
        body.dark-mode .booking-progress {
            background: linear-gradient(135deg, #1a1a2e 0%, #2d2d44 100%) !important;
        }

        /* ===== Search Page Critical Overrides (Force High Contrast) ===== */
        body.dark-mode .flight-result-card,
        body.dark-mode .card,
        body.dark-mode .bg-white {
            background-color: #1a1a2e !important;
            border-color: #2d2d44 !important;
            color: #ffffff !important;
        }

        body.dark-mode .text-muted,
        body.dark-mode .text-dark,
        body.dark-mode .small,
        body.dark-mode label,
        body.dark-mode .form-check-label,
        body.dark-mode .custom-dropdown-toggle,
        body.dark-mode .footer-title {
            color: #e2e8f0 !important;
        }

        body.dark-mode .filter-title {
            color: #ffffff !important;
        }

        body.dark-mode .flight-time, 
        body.dark-mode .flight-price-main,
        body.dark-mode h6,
        body.dark-mode .fw-bold.text-dark {
            color: #ffffff !important;
        }

        body.dark-mode .flight-result-card:hover {
            border-color: #7C3AED !important;
            background-color: #20203a !important;
        }
        
        body.dark-mode .input-box,
        body.dark-mode .form-control {
            background-color: #1a1a2e !important;
            border-color: #2d2d44 !important;
            color: #ffffff !important; 
        }
        
        body.dark-mode input, 
        body.dark-mode select {
            color: #ffffff !important;
        }

        /* Alert Overrides */
        body.dark-mode .alert-warning {
            background-color: #422006 !important; /* Dark brown/orange */
            color: #fcd34d !important; /* Light yellow text */
            border-color: #713f12 !important;
        }
        
        body.dark-mode .alert-info {
            background-color: #0c4a6e !important;
            color: #7dd3fc !important;
            border-color: #0369a1 !important;
        }

        /* Text Colors */
        body.dark-mode .text-primary {
            color: #a78bfa !important; /* Lite Purple */
        }
        
        body.dark-mode .text-danger {
            color: #f87171 !important; /* Light Red */
        }
        
        body.dark-mode .text-secondary {
            color: #cbd5e1 !important; /* Light Grey */
        }
        
        /* Dropdown Menu Overrides */
        body.dark-mode .dropdown-menu {
            background-color: #1a1a2e !important;
            border-color: #2d2d44 !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5) !important;
        }

        body.dark-mode .dropdown-item {
            color: #e2e8f0 !important;
        }

        body.dark-mode .dropdown-item:hover,
        body.dark-mode .dropdown-item:focus {
            background-color: #2d2d44 !important;
            color: #ffffff !important;
        }
        
        body.dark-mode .dropdown-divider {
            border-top-color: #2d2d44 !important;
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

        /* ===== Global Hexagon Background Styles ===== */
        .hexagon-bg {
            position: relative;
            overflow: hidden;
        }
        
        .hexagon-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='115.47' viewBox='0 0 100 115.47'%3E%3Cpath d='M50 0L93.3 25v50L50 100 6.7 75V25z' fill='none' stroke='%237C3AED' stroke-width='0.5' opacity='0.08'/%3E%3C/svg%3E");
            background-size: 80px 92px;
            pointer-events: none;
            z-index: 0;
        }
        
        .hexagon-shape {
            position: absolute;
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            animation: hexFloat 8s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }
        
        @keyframes hexFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.7; }
            50% { transform: translateY(-15px) rotate(5deg); opacity: 1; }
        }
        
        .hexagon-shape.hex-1 { top: 5%; left: 3%; width: 100px; height: 115px; animation-delay: 0s; background: linear-gradient(135deg, rgba(124, 58, 237, 0.08) 0%, rgba(167, 139, 250, 0.04) 100%); }
        .hexagon-shape.hex-2 { top: 15%; right: 5%; width: 80px; height: 92px; animation-delay: -2s; background: linear-gradient(135deg, rgba(16, 185, 129, 0.06) 0%, rgba(52, 211, 153, 0.03) 100%); }
        .hexagon-shape.hex-3 { bottom: 30%; left: 8%; width: 60px; height: 69px; animation-delay: -4s; background: linear-gradient(135deg, rgba(124, 58, 237, 0.05) 0%, rgba(139, 92, 246, 0.02) 100%); }
        .hexagon-shape.hex-4 { bottom: 20%; right: 10%; width: 90px; height: 104px; animation-delay: -6s; background: linear-gradient(135deg, rgba(124, 58, 237, 0.07) 0%, rgba(167, 139, 250, 0.03) 100%); }
        .hexagon-shape.hex-5 { top: 45%; left: 15%; width: 50px; height: 58px; animation-delay: -3s; background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(52, 211, 153, 0.02) 100%); }
        .hexagon-shape.hex-6 { top: 35%; right: 3%; width: 70px; height: 81px; animation-delay: -5s; background: linear-gradient(135deg, rgba(124, 58, 237, 0.06) 0%, rgba(139, 92, 246, 0.03) 100%); }

        /* ===== Microinteractions ===== */
        /* Button Press Effects */
        .btn {
            transition: all 0.2s ease;
        }
        
        .btn:active {
            transform: scale(0.96) !important;
        }
        
        .btn-primary:active, .btn-success:active, .btn-danger:active, .btn-warning:active {
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.2) !important;
        }
        
        /* Card hover lift - exclude footer */
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
        }
        
        footer .card:hover,
        .footer-section .card:hover {
            transform: none;
        }
        
        /* Form Inputs focus glow */
        .form-control:focus, .form-select:focus {
            border-color: #7C3AED !important;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15) !important;
        }
        
        /* Loading Spinner for forms */
        .btn-loading {
            position: relative;
            pointer-events: none;
            color: transparent !important;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            top: 50%;
            left: 50%;
            margin: -9px 0 0 -9px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: btnSpin 0.6s linear infinite;
        }
        
        @keyframes btnSpin {
            to { transform: rotate(360deg); }
        }
        
        /* Smooth link transitions */
        a {
            transition: color 0.2s ease;
        }

        /* ===== Booking Progress Indicator ===== */
        .booking-progress {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
            background: linear-gradient(135deg, #4C1D95 0%, #7C3AED 100%);
            margin-bottom: 0;
        }
        
        .progress-steps {
            display: flex;
            align-items: center;
            gap: 0;
        }
        
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        
        .step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.6);
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .step-label {
            margin-top: 8px;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.6);
            font-weight: 500;
            white-space: nowrap;
        }
        
        .progress-step.active .step-circle {
            background: #fff;
            border-color: #fff;
            color: #7C3AED;
            box-shadow: 0 0 20px rgba(255,255,255,0.4);
        }
        
        .progress-step.active .step-label {
            color: #fff;
        }
        
        .progress-step.completed .step-circle {
            background: #10B981;
            border-color: #10B981;
            color: #fff;
        }
        
        .progress-step.completed .step-label {
            color: rgba(255,255,255,0.8);
        }
        
        .step-connector {
            width: 60px;
            height: 2px;
            background: rgba(255,255,255,0.3);
            margin: 0 10px;
            margin-bottom: 24px;
        }
        
        .step-connector.completed {
            background: #10B981;
        }

        @media (max-width: 576px) {
            .step-label { display: none; }
            .step-connector { width: 30px; }
        }

        /* ===== Back to Top Button ===== */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%);
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
            z-index: 9999;
        }
        
        .back-to-top:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.5);
        }
        
        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    </style>
</head>
<body>


    <header class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12 d-flex align-items-center justify-content-between justify-content-lg-start gap-3">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-link text-white d-md-none p-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                            <i class="bi bi-list fs-1"></i>
                        </button>
                        <a href="<?= $this->Url->build('/') ?>" class="text-decoration-none me-3">
                            <img src="<?= $this->Url->build('/img/flyhigh-logo.png') ?>" alt="FlyHigh Logo" class="logo-img" style="height: 60px;">
                        </a>
                    </div>
                    <nav class="d-none d-md-flex">
                        <a href="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" class="nav-link-custom">Flight</a>
                        <a href="#" class="nav-link-custom">Hotel</a>
                        <a href="#" class="nav-link-custom">Promo</a>
                        <a href="#" class="nav-link-custom">Orders</a>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'about']) ?>" class="nav-link-custom">About Us</a>
                        <a href="#" class="nav-link-custom">Deals <span class="badge-new">NEW</span></a>
                    </nav>
                </div>

                <div class="col-lg-6 d-none d-lg-flex justify-content-end align-items-center gap-4">
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
                            <ul class="dropdown-menu dropdown-menu-end shadow" style="min-width: 200px;">
                                <li class="px-3 py-3 border-bottom border-secondary">
                                    <div class="d-flex align-items-center gap-3">
                                        <!-- Profile Picture Placeholder -->
                                        <div class="rounded-circle bg-dark d-flex align-items-center justify-content-center border border-secondary" style="width: 48px; height: 48px;">
                                            <i class="bi bi-person-fill text-secondary" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <!-- User Info -->
                                        <div class="overflow-hidden">
                                            <div class="fw-bold text-dark text-truncate"><?= h($getIdentityProp('username') ?: $getIdentityProp('email')) ?></div>
                                            <div class="small text-secondary text-truncate"><?= h($getIdentityProp('email')) ?></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="dropdown-item my-1" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'settings']) ?>">
                                        <i class="bi bi-person-gear me-2"></i> Profile
                                    </a>
                                </li>
                                <!-- Open Settings modal from here -->
                                <li>
                                    <a class="dropdown-item my-1"
                                       href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#settingsModal">
                                        <i class="bi bi-gear me-2"></i> Settings
                                    </a>
                                </li>
                                <?php if ($getIdentityProp('role') && strtolower($getIdentityProp('role')) === 'admin'): ?>
                                    <li><a class="dropdown-item my-1" href="<?= $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']) ?>"><i class="bi bi-speedometer2 me-2"></i> Admin Dashboard</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item my-1" href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'myBookings']) ?>"><i class="bi bi-ticket-perforated me-2"></i> My Bookings</a></li>
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

    <!-- Mobile Offcanvas Menu -->
    <div class="offcanvas offcanvas-start text-white" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel" style="background: linear-gradient(135deg, #1f1c2c 0%, #4C1D95 100%);">
        <div class="offcanvas-header border-bottom border-secondary">
            <h5 class="offcanvas-title" id="mobileMenuLabel">
                <img src="<?= $this->Url->build('/img/flyhigh-logo.png') ?>" alt="FlyHigh" style="height: 40px;">
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <!-- Mobile User Section -->
            <?php if ($identity): ?>
                 <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded bg-white bg-opacity-10">
                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center text-primary" style="width: 50px; height: 50px;">
                        <i class="bi bi-person-fill fs-3"></i>
                    </div>
                    <div>
                        <div class="fw-bold"><?= h($getIdentityProp('full_name') ?: $getIdentityProp('email')) ?></div>
                        <div class="small opacity-75"><?= h($getIdentityProp('email')) ?></div>
                    </div>
                </div>
            <?php else: ?>
                <div class="d-grid gap-2 mb-4">
                    <button class="btn btn-light fw-bold text-primary" data-bs-toggle="modal" data-bs-target="#authModal" onclick="switchAuthTab('signin')" data-bs-dismiss="offcanvas">Sign In</button>
                    <button class="btn btn-outline-light fw-bold" data-bs-toggle="modal" data-bs-target="#authModal" onclick="switchAuthTab('register')" data-bs-dismiss="offcanvas">Register</button>
                </div>
            <?php endif; ?>

            <!-- Navigation Links -->
            <nav class="nav flex-column gap-2 mb-auto">
                <a href="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'search']) ?>" class="nav-link text-white fs-5 border-bottom border-white border-opacity-10 py-3"><i class="bi bi-airplane me-3"></i> Flight</a>
                <a href="#" class="nav-link text-white fs-5 border-bottom border-white border-opacity-10 py-3"><i class="bi bi-buildings me-3"></i> Hotel</a>
                <a href="#" class="nav-link text-white fs-5 border-bottom border-white border-opacity-10 py-3"><i class="bi bi-percent me-3"></i> Promo</a>
                <?php if ($identity): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'myBookings']) ?>" class="nav-link text-white fs-5 border-bottom border-white border-opacity-10 py-3"><i class="bi bi-ticket-perforated me-3"></i> My Bookings</a>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'settings']) ?>" class="nav-link text-white fs-5 border-bottom border-white border-opacity-10 py-3"><i class="bi bi-gear me-3"></i> Settings</a>
                    <?php if ($getIdentityProp('role') && strtolower($getIdentityProp('role')) === 'admin'): ?>
                        <a href="<?= $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']) ?>" class="nav-link text-white fs-5 border-bottom border-white border-opacity-10 py-3"><i class="bi bi-speedometer2 me-3"></i> Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="nav-link text-danger fs-5 py-3"><i class="bi bi-box-arrow-right me-3"></i> Logout</a>
                <?php endif; ?>
            </nav>

            <!-- Bottom Links -->
            <div class="mt-4 pt-3 border-top border-secondary">
                 <div class="d-flex gap-3 mb-3">
                    <a href="#" class="text-white text-decoration-none small"><i class="bi bi-translate me-1"></i> MYR</a>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'help']) ?>" class="text-white text-decoration-none small">Help</a>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'about']) ?>" class="text-white text-decoration-none small">About Us</a>
                </div>
                <div class="small opacity-50">
                    &copy; 2026 FlyHigh
                </div>
            </div>
        </div>
    </div>

    <script>
    function switchAuthTab(tabId) {
        // Wait for modal to show then click tab
        setTimeout(() => {
            const tabButton = document.querySelector('#' + tabId + '-tab');
            if(tabButton) {
                const tab = new bootstrap.Tab(tabButton);
                tab.show();
            }
        }, 200);
    }
    </script>

    <main class="main">
        <div class="container-fluid p-0 page-transition">
            <!-- Hidden Flash Wrapper to prevent flicker -->
            <div id="flash-hidden-wrapper" style="display: none;">
                <?= $this->Flash->render() ?>
            </div>
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
                                <input class="form-check-input" type="checkbox" value="1" id="darkModeToggle">
                                <label class="form-check-label text-white small" for="darkModeToggle">
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        /* Flatpickr Purple Theme Override */
        .flatpickr-calendar {
            font-family: 'Inter', sans-serif !important;
            border: none !important;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15) !important;
        }
        .flatpickr-day.selected, 
        .flatpickr-day.startRange, 
        .flatpickr-day.endRange, 
        .flatpickr-day.selected.inRange, 
        .flatpickr-day.startRange.inRange, 
        .flatpickr-day.endRange.inRange, 
        .flatpickr-day.selected:focus, 
        .flatpickr-day.startRange:focus, 
        .flatpickr-day.endRange:focus, 
        .flatpickr-day.selected:hover, 
        .flatpickr-day.startRange:hover, 
        .flatpickr-day.endRange:hover, 
        .flatpickr-day.selected.prevMonthDay, 
        .flatpickr-day.startRange.prevMonthDay, 
        .flatpickr-day.endRange.prevMonthDay, 
        .flatpickr-day.selected.nextMonthDay, 
        .flatpickr-day.startRange.nextMonthDay, 
        .flatpickr-day.endRange.nextMonthDay {
            background: #7C3AED !important;
            border-color: #7C3AED !important;
        }
        .flatpickr-day.inRange {
            box-shadow: -5px 0 0 #ddd, 5px 0 0 #ddd !important;
        }
        body.dark-mode .flatpickr-calendar {
            background: #1a1a2e !important;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5) !important;
        }
        body.dark-mode .flatpickr-day {
            color: #e2e8f0 !important;
        }
        body.dark-mode .flatpickr-day.flatpickr-disabled {
            color: #4b5563 !important;
        }
        body.dark-mode .flatpickr-day.selected {
            color: #fff !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // General Datepicker (Flight Dates - Future only)
            flatpickr(".datepicker", {
                minDate: "today",
                dateFormat: "Y-m-d",
                disableMobile: "true",
                theme: "material_blue"
            });

            // DOB Datepicker (Past only)
            flatpickr(".datepicker-dob", {
                maxDate: "today",
                dateFormat: "Y-m-d", 
                disableMobile: "true",
                theme: "material_blue",
                yearSelectorType: "static" // Better year selection
            });
        });
    </script>

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
                document.body.classList.add('dark-mode');
                if (darkToggle) darkToggle.checked = true;
            } else {
                document.body.classList.remove('dark-mode');
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
                    if (this.checked) {
                        document.body.classList.add('dark-mode');
                        localStorage.setItem('flyhigh-theme', 'dark');
                    } else {
                        document.body.classList.remove('dark-mode');
                        localStorage.setItem('flyhigh-theme', 'light');
                    }
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

            // Form Submit Loading Spinner
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                    if (submitBtn && !submitBtn.classList.contains('btn-loading')) {
                        submitBtn.classList.add('btn-loading');
                    }
                });
            });

            // Back to Top Button
            const backToTopBtn = document.getElementById('backToTop');
            if (backToTopBtn) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backToTopBtn.classList.add('visible');
                    } else {
                        backToTopBtn.classList.remove('visible');
                    }
                }, { passive: true });

                backToTopBtn.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            // Page Transition
            const pageTransition = document.querySelector('.page-transition');
            if (pageTransition) {
                setTimeout(() => {
                    pageTransition.classList.add('active');
                }, 50);
            }

        });
    </script>

    <style>
        @keyframes slideInLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .toast.slide-in-left {
            animation: slideInLeft 0.4s ease-out forwards;
        }

        /* FORCE OVERRIDES (Bypass Cache) */
        .back-to-top {
            right: 30px !important;
            left: auto !important;
            transform: none !important;
            bottom: 30px !important;
            border-radius: 50% !important;
            padding: 0 !important;
        }
    </style>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 p-3" style="z-index: 1060; left: 0 !important; right: auto !important; width: auto !important; max-width: 350px;">
        <div id="liveToast" class="toast slide-in-left align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle-fill fs-5" id="toastIcon"></i>
                    <span id="toastMessage">Hello!</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Back to top">
        <i class="bi bi-arrow-up"></i>
    </button>
</body>

<script>
    // Toast Helper
    window.showToast = function(message, type = 'success') {
        const toastEl = document.getElementById('liveToast');
        const toastBody = document.getElementById('toastMessage');
        const toastIcon = document.getElementById('toastIcon');
        
        // Colors
        if (type === 'success') {
            toastEl.className = 'toast align-items-center text-white border-0 bg-success';
            toastIcon.className = 'bi bi-check-circle-fill fs-5';
        } else if (type === 'error' || type === 'danger') {
            toastEl.className = 'toast align-items-center text-white border-0 bg-danger';
            toastIcon.className = 'bi bi-x-circle-fill fs-5';
        } else {
            toastEl.className = 'toast align-items-center text-white border-0 bg-primary';
            toastIcon.className = 'bi bi-info-circle-fill fs-5';
        }

        toastBody.textContent = message;
        const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
        toast.show();
    }

    // Auto-convert standard CakePHP Flash Messages to Toasts
    document.addEventListener('DOMContentLoaded', function() {
        // Selector for standard CakePHP flash messages inside the hidden wrapper
        const hiddenWrapper = document.getElementById('flash-hidden-wrapper');
        let flashMessages = [];
        
        if (hiddenWrapper) {
            flashMessages = hiddenWrapper.querySelectorAll('.message, .alert');
        } else {
            // Fallback
             flashMessages = document.querySelectorAll('.message, .alert:not(.d-none)');
        }
        
        flashMessages.forEach(msg => {
            // Skip if it's inside the toast container itself or static alerts
            if (msg.closest('.toast') || msg.closest('.static-alert')) return;

            // Get message text
            const text = msg.textContent.trim();
            if (!text) return;

            // Determine type
            let type = 'info';
            if (msg.classList.contains('success') || msg.classList.contains('alert-success')) {
                type = 'success';
            } else if (msg.classList.contains('error') || msg.classList.contains('alert-danger')) {
                type = 'error';
            }

            // Show Toast
            window.showToast(text, type);

            // No need to hide original if wrapper is hidden, but good practice
            msg.style.display = 'none';
        });
    });

</script>


</html>

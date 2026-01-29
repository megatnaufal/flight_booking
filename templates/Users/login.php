<?php
/**
 * @var \App\View\AppView $this
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - FlyHigh</title>
    <?= $this->Html->meta('icon', 'img/flyhigh-logo.png') ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; overflow: hidden; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, rgba(76, 29, 149, 0.95) 0%, rgba(109, 40, 217, 0.9) 100%),
                        url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            display: flex;
            width: 900px;
            max-width: 95vw;
            height: auto;
            max-height: 90vh;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0,0,0,0.4);
        }
        .hero-side {
            flex: 1;
            background: linear-gradient(135deg, #4C1D95 0%, #7C3AED 100%);
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .hero-side::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -30%;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .hero-side::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -20%;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }
        .hero-content { position: relative; z-index: 1; }
        .hero-icon {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .hero-icon i { font-size: 1.5rem; color: white; }
        .hero-title { font-size: 1.75rem; font-weight: 700; color: white; margin-bottom: 0.75rem; line-height: 1.3; }
        .hero-text { font-size: 0.9rem; color: rgba(255,255,255,0.85); line-height: 1.6; margin-bottom: 1.5rem; }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: rgba(255,255,255,0.9);
            font-size: 0.85rem;
            margin-bottom: 0.6rem;
        }
        .feature-item i { color: #a5f3fc; font-size: 0.9rem; }
        .login-side {
            flex: 1;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.5rem;
        }
        .login-logo img { height: 40px; }
        .login-logo span { font-size: 1.25rem; font-weight: 700; color: #4C1D95; }
        .login-title { font-size: 1.35rem; font-weight: 700; color: #1f2937; margin-bottom: 0.25rem; }
        .login-subtitle { font-size: 0.875rem; color: #6b7280; margin-bottom: 1.25rem; }
        .form-label { font-weight: 500; font-size: 0.8rem; color: #374151; margin-bottom: 0.35rem; }
        .form-control-modern {
            background: #f9fafb;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 12px 10px 38px;
            font-size: 0.9rem;
        }
        .form-control-modern:focus {
            background: #fff;
            border-color: #7C3AED;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.9rem;
        }
        .btn-primary-modern {
            background: linear-gradient(135deg, #7C3AED 0%, #4C1D95 100%);
            border: none;
            border-radius: 8px;
            padding: 11px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .btn-primary-modern:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.4);
        }
        .btn-outline-modern {
            background: transparent;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            color: #374151;
        }
        .btn-outline-modern:hover {
            border-color: #7C3AED;
            color: #7C3AED;
        }
        .divider {
            display: flex;
            align-items: center;
            margin: 1rem 0;
        }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e5e7eb; }
        .divider span { padding: 0 0.75rem; color: #9ca3af; font-size: 0.8rem; }
        .register-text { text-align: center; font-size: 0.85rem; color: #6b7280; margin-top: 1rem; }
        .register-text a { color: #7C3AED; font-weight: 600; text-decoration: none; }
        @media (max-width: 768px) {
            .hero-side { display: none; }
            .login-container { width: 100%; max-width: 400px; border-radius: 16px; }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Left Hero -->
    <div class="hero-side">
        <div class="hero-content">
            <div class="hero-icon"><i class="bi bi-airplane"></i></div>
            <h2 class="hero-title">Discover the World with FlyHigh</h2>
            <p class="hero-text">Book domestic flights to all major Malaysian cities with unbeatable fares and instant confirmations.</p>
            <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Best price guarantee</span></div>
            <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>24/7 customer support</span></div>
            <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Secure instant booking</span></div>
            <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Earn rewards every trip</span></div>
        </div>
    </div>

    <!-- Right Login -->
    <div class="login-side">
        <div class="login-logo">
            <img src="<?= $this->Url->build('/img/flyhigh-logo.png') ?>" alt="FlyHigh">
            <span>FlyHigh</span>
        </div>
        <h2 class="login-title">Welcome back</h2>
        <p class="login-subtitle">Enter your credentials to continue</p>

        <?= $this->Form->create(null) ?>
        <div class="mb-2">
            <label class="form-label">Email Address</label>
            <div class="input-wrapper">
                <i class="bi bi-envelope input-icon"></i>
                <?= $this->Form->control('email', [
                    'label' => false, 'required' => true,
                    'class' => 'form-control form-control-modern',
                    'placeholder' => 'you@example.com',
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>
            </div>
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label class="form-label">Password</label>
                <a href="#" class="small text-decoration-none" style="color: #7C3AED; font-size: 0.8rem;">Forgot?</a>
            </div>
            <div class="input-wrapper">
                <i class="bi bi-lock input-icon"></i>
                <?= $this->Form->control('password', [
                    'label' => false, 'required' => true,
                    'class' => 'form-control form-control-modern',
                    'placeholder' => '••••••••',
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>
            </div>
        </div>
        <div class="d-grid mb-2">
            <?= $this->Form->button(__('Sign In'), ['class' => 'btn btn-primary btn-primary-modern']) ?>
        </div>
        <?= $this->Form->end() ?>

        <div class="divider"><span>or</span></div>
        <div class="d-grid">
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'guest']) ?>" class="btn btn-outline-modern">
                <i class="bi bi-person me-2"></i>Continue as Guest
            </a>
        </div>
        <div class="register-text">
            Don't have an account? <?= $this->Html->link('Sign up', ['action' => 'add']) ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - FlyHigh</title>
    <?= $this->Html->meta('icon') ?>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #0a0a0a;
            background-image: 
                linear-gradient(rgba(10, 10, 10, 0.95), rgba(10, 10, 10, 0.95)),
                url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            min-height: 100vh;
            font-family: 'Oswald', sans-serif;
        }
        .login-card {
            background: linear-gradient(145deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid #222;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.8), inset 0 1px 0 rgba(255,255,255,0.05);
        }
        .btn-batman {
            background: linear-gradient(180deg, #FFD300 0%, #c9a600 100%);
            color: #0a0a0a;
            border: none;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            transition: all 0.3s;
        }
        .btn-batman:hover {
            box-shadow: 0 0 25px rgba(255, 211, 0, 0.6);
            transform: translateY(-2px);
            color: #0a0a0a;
        }
        .form-control-dark {
            background: #121212;
            border: 1px solid #333;
            color: #ecf0f1;
            border-radius: 4px;
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
        .text-gold { color: #FFD300; }
        .scanline {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            background: linear-gradient(rgba(18,16,16,0) 50%, rgba(0,0,0,0.1) 50%);
            background-size: 100% 4px;
            z-index: 10;
            opacity: 0.3;
        }
        .bat-logo {
            width: 60px;
            height: 36px;
            background: #FFD300;
            mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 56'%3E%3Cpath d='M50 8C35 8 20 18 15 25C15 25 10 20 5 18C5 18 5 35 15 45C22 52 35 52 50 52C65 52 78 52 85 45C95 35 95 18 95 18C90 20 85 25 85 25C80 18 65 8 50 8Z'/%3E%3C/svg%3E");
            -webkit-mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 56'%3E%3Cpath d='M50 8C35 8 20 18 15 25C15 25 10 20 5 18C5 18 5 35 15 45C22 52 35 52 50 52C65 52 78 52 85 45C95 35 95 18 95 18C90 20 85 25 85 25C80 18 65 8 50 8Z'/%3E%3C/svg%3E");
            mask-repeat: no-repeat;
            -webkit-mask-repeat: no-repeat;
            mask-size: contain;
            -webkit-mask-size: contain;
            filter: drop-shadow(0 0 15px rgba(255, 211, 0, 0.5));
            animation: pulse 3s infinite;
        }
        @keyframes pulse {
            0% { filter: drop-shadow(0 0 15px rgba(255, 211, 0, 0.5)); }
            50% { filter: drop-shadow(0 0 30px rgba(255, 211, 0, 0.8)); }
            100% { filter: drop-shadow(0 0 15px rgba(255, 211, 0, 0.5)); }
        }
    </style>
</head>
<body>
<div class="scanline"></div>

<div class="container">
<div class="row justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6 col-lg-5">
        <div class="login-card rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="text-center py-4" style="border-bottom: 1px solid #222;">
                <div class="bat-logo mx-auto mb-3"></div>
                <h3 class="text-gold fw-bold mb-0 text-uppercase" style="letter-spacing: 4px;">Join FlyHigh</h3>
                <small class="text-secondary text-uppercase" style="letter-spacing: 2px;">Create Account</small>
            </div>
            
            <div class="p-5">
                
                <?= $this->Form->create($user, ['class' => 'needs-validation']) ?>
                
                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label text-gold small text-uppercase" style="letter-spacing: 1px;">Email Address</label>
                    <?= $this->Form->control('email', [
                        'label' => false,
                        'required' => true,
                        'class' => 'form-control form-control-lg form-control-dark',
                        'placeholder' => 'name@example.com',
                        'templates' => [
                            'inputContainer' => '{{content}}'
                        ]
                    ]) ?>
                </div>

                <!-- Username -->
                 <div class="mb-3">
                    <label class="form-label text-gold small text-uppercase" style="letter-spacing: 1px;">Username</label>
                    <?= $this->Form->control('username', [
                        'label' => false,
                        'required' => true,
                        'class' => 'form-control form-control-lg form-control-dark',
                        'placeholder' => 'username',
                        'templates' => [
                            'inputContainer' => '{{content}}'
                        ]
                    ]) ?>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="form-label text-gold small text-uppercase" style="letter-spacing: 1px;">Password</label>
                    <?= $this->Form->control('password', [
                        'label' => false,
                        'required' => true,
                        'class' => 'form-control form-control-lg form-control-dark',
                        'placeholder' => '••••••••',
                        'templates' => [
                            'inputContainer' => '{{content}}'
                        ]
                    ]) ?>
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2 mb-3">
                    <?= $this->Form->button(__('Register'), [
                        'class' => 'btn btn-lg btn-batman'
                    ]) ?>
                </div>
                <?= $this->Form->end() ?>

            </div>
            
            <div class="text-center py-3" style="border-top: 1px solid #222; background: rgba(0,0,0,0.3);">
                <span class="text-secondary small">Already have an account?</span>
                <?= $this->Html->link('Sign In', ['action' => 'login'], ['class' => 'text-gold text-decoration-none ms-1 fw-bold']) ?>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <small class="text-secondary">&copy; <?= date('Y') ?> FlyHigh. Gotham Division.</small>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

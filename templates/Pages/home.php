<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Mission Control : Home
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #121212;
            background-image: 
                linear-gradient(rgba(18, 18, 18, 0.9), rgba(18, 18, 18, 0.9)),
                url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #ecf0f1;
            font-family: 'Rajdhani', sans-serif;
        }
        
        .hero {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .bat-logo {
            width: 200px;
            height: 120px;
            background: #f1c40f;
            mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 56'%3E%3Cpath d='M50 8C35 8 20 18 15 25C15 25 10 20 5 18C5 18 5 35 15 45C22 52 35 52 50 52C65 52 78 52 85 45C95 35 95 18 95 18C90 20 85 25 85 25C80 18 65 8 50 8Z'/%3E%3C/svg%3E");
            -webkit-mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 56'%3E%3Cpath d='M50 8C35 8 20 18 15 25C15 25 10 20 5 18C5 18 5 35 15 45C22 52 35 52 50 52C65 52 78 52 85 45C95 35 95 18 95 18C90 20 85 25 85 25C80 18 65 8 50 8Z'/%3E%3C/svg%3E");
            mask-repeat: no-repeat;
            -webkit-mask-repeat: no-repeat;
            mask-size: contain;
            -webkit-mask-size: contain;
            margin: 0 auto 30px;
            filter: drop-shadow(0 0 20px rgba(241, 196, 15, 0.5));
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0% { filter: drop-shadow(0 0 20px rgba(241, 196, 15, 0.5)); }
            50% { filter: drop-shadow(0 0 40px rgba(241, 196, 15, 0.8)); }
            100% { filter: drop-shadow(0 0 20px rgba(241, 196, 15, 0.5)); }
        }

        h1 {
            font-family: 'Oswald', sans-serif;
            font-size: 4rem;
            text-transform: uppercase;
            letter-spacing: 5px;
            color: #f1c40f;
            margin: 0 0 10px;
            text-shadow: 0 0 15px rgba(241, 196, 15, 0.3);
        }
        
        p {
            font-size: 1.5rem;
            color: #bdc3c7;
            margin-bottom: 50px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        .btn-enter {
            display: inline-block;
            padding: 15px 40px;
            background: transparent;
            border: 2px solid #f1c40f;
            color: #f1c40f;
            font-family: 'Oswald', sans-serif;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-enter:hover {
            color: #000;
            background: #f1c40f;
            box-shadow: 0 0 30px #f1c40f;
        }
        
        .scanline {
            width: 100%;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            pointer-events: none;
            background: linear-gradient(rgba(18,16,16,0) 50%, rgba(0,0,0,0.1) 50%), linear-gradient(90deg, rgba(255,0,0,0.06), rgba(0,255,0,0.02), rgba(0,0,255,0.06));
            background-size: 100% 4px, 6px 100%;
            z-index: 10;
        }
    </style>
</head>
<body>
    <div class="scanline"></div>
    <div class="hero">
        <div class="bat-logo"></div>
        <h1>Mission Control</h1>
        <p>System Online. Awaiting Credentials.</p>
        <a href="<?= $this->Url->build('/dashboards/admin') ?>" class="btn-enter">Enter System</a>
    </div>
</body>
</html>

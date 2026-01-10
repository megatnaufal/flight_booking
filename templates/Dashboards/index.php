<?php
/**
 * @var \App\View\AppView $this
 * @var array $stats
 * @var array $revenueData
 * @var array $revenueLabels
 * @var iterable<\App\Model\Entity\Booking> $bookings
 * @var iterable<\App\Model\Entity\Flight> $flights
 * @var iterable<\App\Model\Entity\Passenger> $passengers
 * @var iterable<\App\Model\Entity\User> $users
 */

// Defensive checks
$stats = $stats ?? ['revenue' => 0, 'flights' => 0, 'bookings' => 0, 'users' => 0];
$revenueData = $revenueData ?? [];
$revenueLabels = $revenueLabels ?? [];
$bookings = $bookings ?? [];
$flights = $flights ?? [];
$passengers = $passengers ?? [];
$users = $users ?? [];
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rajdhani:wght@500;600;700&display=swap');

    :root {
        /* BATMAN GOTHAM THEME */
        --gotham-bg: #050505;          /* Deep Black */
        --gotham-card: #121212;        /* Dark Grey Card */
        --gotham-accent: #f1c40f;      /* Gold Accent */
        --gotham-text: #ecf0f1;        /* Off-White Text */
        --gotham-muted: #95a5a6;       /* Muted Grey Text */
        --gotham-border: #2c3e50;      /* Dark Blue-Grey Border */
        
        --sidebar-collapsed: 70px;
        --sidebar-expanded: 260px;
    }

    body { 
        background-color: var(--gotham-bg); 
        font-family: 'Rajdhani', sans-serif; 
        color: var(--gotham-text);
        margin: 0; 
        overflow-x: hidden; 
    }

    /* COLLAPSIBLE SIDEBAR */
    .sidebar {
        width: var(--sidebar-collapsed);
        background-color: #000000;
        border-right: 1px solid var(--gotham-border);
        color: white;
        height: 100vh;
        position: fixed;
        left: 0; top: 0;
        z-index: 1000;
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        white-space: nowrap;
    }
    .sidebar:hover { width: var(--sidebar-expanded); box-shadow: 10px 0 30px rgba(0,0,0,0.8); }

    .nav-header { padding: 25px; font-weight: 700; opacity: 0; transition: 0.2s; font-family: 'Oswald'; font-size: 1.2rem; letter-spacing: 1px; color: var(--gotham-accent); }
    .sidebar:hover .nav-header { opacity: 1; }

    .nav-item {
        display: flex; align-items: center;
        padding: 15px 22px;
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s;
        border-left: 4px solid transparent;
    }
    .nav-item i { font-size: 1.4rem; min-width: 30px; transition: 0.2s; }
    .nav-item span { margin-left: 15px; opacity: 0; transition: 0.2s; }
    .sidebar:hover .nav-item span { opacity: 1; }
    .nav-item:hover, .nav-item.active { 
        background: rgba(241, 196, 15, 0.15); 
        color: var(--gotham-accent); 
        border-left-color: var(--gotham-accent); 
    }

    /* MAIN CONTENT */
    .main-content { 
        margin-left: var(--sidebar-collapsed); 
        padding: 40px; 
        transition: margin-left 0.3s; 
        display: flex; flex-direction: column; min-height: 100vh; 
    }
    
    .page-section { display: none; flex-grow: 1; }
    .page-section.active { display: block; animation: fadeIn 0.5s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* DASHBOARD CARDS */
    .dashboard-card { 
        background: var(--gotham-card); 
        border: 1px solid var(--gotham-border); 
        border-radius: 8px; 
        padding: 25px; 
        margin-bottom: 20px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.3); 
        transition: all 0.3s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        border-color: var(--gotham-accent);
    }

    .stat-number { font-family: 'Oswald', sans-serif; font-size: 2.2rem; margin: 0; line-height: 1; color: var(--gotham-text); }
    
    .action-icon { 
        width: 45px; height: 45px; 
        background: rgba(255,255,255,0.05); 
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px; 
        display: flex; align-items: center; justify-content: center; 
        color: var(--gotham-accent); 
        transition: all 0.3s ease;
    }

    /* QUICK ACTION HOVER EFFECT */
    .quick-action-item {
        display: flex; 
        align-items: center; 
        gap: 15px; 
        text-decoration: none; 
        color: var(--gotham-text);
        padding: 10px;
        border-radius: 8px;
        transition: background 0.2s;
    }
    .quick-action-item:hover {
        background: rgba(255,255,255,0.03);
    }
    .quick-action-item:hover .action-icon {
        background: var(--gotham-accent);
        color: #000;
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(241, 196, 15, 0.4);
    }
    
    /* TABLE STYLES */
    .table-flyhigh { width: 100%; border-collapse: collapse; color: var(--gotham-muted); }
    .table-flyhigh th { text-align: left; padding: 15px; border-bottom: 2px solid var(--gotham-border); color: var(--gotham-accent); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }
    .table-flyhigh td { padding: 15px; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.95rem; vertical-align: middle; }
    .table-flyhigh tr:hover td { color: var(--gotham-text); background: rgba(255,255,255,0.02); }
    
    .status-badge { padding: 6px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .status-paid { background: rgba(46, 204, 113, 0.2); color: #2ecc71; border: 1px solid #2ecc71; }
    .status-unpaid { background: rgba(241, 196, 15, 0.2); color: #f1c40f; border: 1px solid #f1c40f; }

    .role-admin { background: rgba(231, 76, 60, 0.2); color: #e74c3c; border: 1px solid #e74c3c; }
    .role-user { background: rgba(255,255,255,0.1); color: #95a5a6; border: 1px solid #7f8c8d; }

    .btn-create { 
        background: var(--gotham-accent); 
        color: #000; 
        border-radius: 50px; 
        padding: 10px 25px; 
        text-decoration: none; 
        font-weight: 700; 
        display: inline-flex; align-items: center; gap: 8px; 
        transition: 0.2s; 
    }
    .btn-create:hover { background: #fff; color: #000; box-shadow: 0 0 10px var(--gotham-accent); }

    /* FOOTER */
    .footer-section { background-color: #000000; padding-top: 50px; border-top: 1px solid var(--gotham-border); margin-top: auto; width: 100%; }
    .footer-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 20px; color: var(--gotham-accent); text-transform: uppercase; }
    .footer-link { font-size: 0.85rem; color: var(--gotham-muted); text-decoration: none; display: block; margin-bottom: 8px; }
    .footer-link:hover { color: var(--gotham-accent); }
    
    h2, h5, h6 { color: var(--gotham-text); font-family: 'Oswald'; letter-spacing: 1px; }
    .text-dark { color: var(--gotham-text) !important; }
    .text-muted { color: var(--gotham-muted) !important; }
</style>

<div class="admin-wrapper">
    <nav class="sidebar">
        <div class="nav-header">ADMIN PANEL</div>
        <a class="nav-item active" onclick="showSection('overview', this)"><i class="bi bi-grid-1x2"></i> <span>Overview</span></a>
        <a class="nav-item" onclick="showSection('bookings', this)"><i class="bi bi-journal-check"></i> <span>Bookings</span></a>
        <a class="nav-item" onclick="showSection('flights', this)"><i class="bi bi-airplane"></i> <span>Flights</span></a>
        <a class="nav-item" onclick="showSection('passengers', this)"><i class="bi bi-people"></i> <span>Passengers</span></a>
        <a class="nav-item" onclick="showSection('users', this)"><i class="bi bi-person-gear"></i> <span>Users</span></a>
    </nav>

    <main class="main-content">
        
        <div id="overview" class="page-section active">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="margin: 0; text-transform: uppercase;">Dashboard Overview</h2>
                <a href="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'add']) ?>" class="btn-create">
                    <i class="bi bi-plus-lg"></i> New Flight
                </a>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="dashboard-card d-flex align-items-center gap-3">
                        <div class="action-icon"><i class="bi bi-currency-dollar"></i></div>
                        <div><small class="text-muted fw-bold">TOTAL REVENUE</small><p class="stat-number">RM <?= number_format($stats['revenue'], 1) ?>K</p></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card d-flex align-items-center gap-3">
                        <div class="action-icon"><i class="bi bi-airplane-engines"></i></div>
                        <div><small class="text-muted fw-bold">ACTIVE FLIGHTS</small><p class="stat-number"><?= $stats['flights'] ?></p></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card d-flex align-items-center gap-3">
                        <div class="action-icon"><i class="bi bi-journal-check"></i></div>
                        <div><small class="text-muted fw-bold">BOOKINGS</small><p class="stat-number"><?= $stats['bookings'] ?></p></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card d-flex align-items-center gap-3">
                        <div class="action-icon"><i class="bi bi-people"></i></div>
                        <div><small class="text-muted fw-bold">USERS</small><p class="stat-number"><?= $stats['users'] ?></p></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="dashboard-card">
                        <h6 class="mb-4">REVENUE TREND (MYR)</h6>
                        <div style="height: 456px;"><canvas id="revenueLineChart"></canvas></div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="dashboard-card">
                        <h6 class="mb-3">RESOURCE DISTRIBUTION</h6>
                        <div style="height: 200px; position: relative;">
                            <canvas id="resourcePieChart"></canvas>
                        </div>
                    </div>

                    <div class="dashboard-card">
                        <h5 class="fw-bold mb-4" style="color: var(--gotham-accent);">Quick Actions</h5>
                        <div class="d-flex flex-column gap-2">
                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>" class="quick-action-item">
                                <div class="action-icon"><i class="bi bi-person-plus"></i></div>
                                <div><div class="fw-bold">Add New User</div><small class="text-muted">Register system admins</small></div>
                            </a>
                            <a href="<?= $this->Url->build(['controller' => 'Reports', 'action' => 'index']) ?>" class="quick-action-item">
                                <div class="action-icon"><i class="bi bi-file-earmark-text"></i></div>
                                <div><div class="fw-bold">Generate Reports</div><small class="text-muted">Download monthly stats</small></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="bookings" class="page-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="margin: 0;">BOOKINGS MANAGEMENT</h2>
                <?= $this->Html->link(__('<i class="bi bi-plus-lg"></i> New Booking'), ['controller' => 'Bookings', 'action' => 'add'], ['class' => 'btn-create', 'escape' => false]) ?>
            </div>
            <div class="dashboard-card">
                <div class="table-responsive">
                    <table class="table-flyhigh">
                        <thead>
                            <tr><th>ID</th><th>Passenger</th><th>Flight</th><th>Date</th><th>Status</th><th class="actions">Actions</th></tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bookings)): ?>
                                <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td class="fw-bold text-muted">#<?= $this->Number->format($booking->id) ?></td>
                                    <td><?= $booking->hasValue('passenger') ? h($booking->passenger->full_name) : 'N/A' ?></td>
                                    <td><i class="bi bi-airplane me-2" style="color:var(--gotham-accent)"></i><?= $booking->hasValue('flight') ? h($booking->flight->flight_number) : 'N/A' ?></td>
                                    <td><?= h($booking->booking_date) ?></td>
                                    <td><span class="status-badge <?= strtolower($booking->ticket_status ?? '') == 'paid' ? 'status-paid' : 'status-unpaid' ?>"><?= h($booking->ticket_status) ?></span></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Bookings', 'action' => 'view', $booking->id], ['class' => 'text-white me-2 text-decoration-none']) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Bookings', 'action' => 'edit', $booking->id], ['class' => 'text-muted text-decoration-none']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center p-5 text-muted">No bookings found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 text-center">
                    <?= $this->Html->link(__('Manage All Bookings'), ['controller' => 'Bookings', 'action' => 'index'], ['class' => 'btn btn-sm btn-outline-secondary', 'style' => 'color:white; border-color:white;']) ?>
                </div>
            </div>
        </div>

        <div id="flights" class="page-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="margin: 0;">FLIGHT SCHEDULES</h2>
                <?= $this->Html->link(__('<i class="bi bi-plus-lg"></i> New Flight'), ['controller' => 'Flights', 'action' => 'add'], ['class' => 'btn-create', 'escape' => false]) ?>
            </div>
            <div class="dashboard-card">
                <div class="table-responsive">
                    <table class="table-flyhigh">
                        <thead>
                            <tr><th>ID</th><th>Flight No.</th><th>Origin</th><th>Destination</th><th>Departure</th><th>Price</th><th class="actions">Actions</th></tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($flights)): ?>
                                <?php foreach ($flights as $flight): ?>
                                <tr>
                                    <td class="fw-bold text-muted"><?= $this->Number->format($flight->id) ?></td>
                                    <td style="color: var(--gotham-accent); font-weight: bold;"><i class="bi bi-airplane-fill me-2"></i><?= h($flight->flight_number) ?></td>
                                    <td><?= $flight->hasValue('origin_airport') ? h($flight->origin_airport->airport_code) : '-' ?></td>
                                    <td><?= $flight->hasValue('dest_airport') ? h($flight->dest_airport->airport_code) : '-' ?></td>
                                    <td><?= h($flight->departure_time) ?></td>
                                    <td>MYR <?= $flight->base_price === null ? '0.00' : $this->Number->format($flight->base_price) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Flights', 'action' => 'view', $flight->id], ['class' => 'text-white me-2 text-decoration-none']) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Flights', 'action' => 'edit', $flight->id], ['class' => 'text-muted me-2 text-decoration-none']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Flights', 'action' => 'delete', $flight->id], ['confirm' => __('Delete flight {0}?', $flight->flight_number), 'class' => 'text-danger text-decoration-none']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" class="text-center p-5 text-muted">No active flights found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 text-center">
                    <?= $this->Html->link(__('Manage All Flights'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'btn btn-sm btn-outline-secondary', 'style' => 'color:white; border-color:white;']) ?>
                </div>
            </div>
        </div>

        <div id="passengers" class="page-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="margin: 0;">PASSENGER LIST</h2>
                <?= $this->Html->link(__('<i class="bi bi-plus-lg"></i> New Passenger'), ['controller' => 'Passengers', 'action' => 'add'], ['class' => 'btn-create', 'escape' => false]) ?>
            </div>
            <div class="dashboard-card">
                <div class="table-responsive">
                    <table class="table-flyhigh">
                        <thead>
                            <tr><th>ID</th><th>User Account</th><th>Full Name</th><th>Passport No.</th><th>Phone</th><th class="actions">Actions</th></tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($passengers)): ?>
                                <?php foreach ($passengers as $passenger): ?>
                                <tr>
                                    <td class="fw-bold text-muted"><?= $this->Number->format($passenger->id) ?></td>
                                    <td>
                                        <?php if ($passenger->hasValue('user')): ?>
                                            <?= $this->Html->link($passenger->user->username, ['controller' => 'Users', 'action' => 'view', $passenger->user->id], ['style' => 'text-decoration:none; color:var(--gotham-accent); font-weight:bold;']) ?>
                                        <?php else: ?>
                                            <span class="text-muted">Guest</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="font-weight: bold;"><?= h($passenger->full_name) ?></td>
                                    <td><span style="background: rgba(255,255,255,0.1); padding: 4px 10px; border-radius: 2px;"><?= h($passenger->passport_number) ?></span></td>
                                    <td><?= h($passenger->phone_number) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Passengers', 'action' => 'view', $passenger->id], ['class' => 'text-white me-2 text-decoration-none']) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Passengers', 'action' => 'edit', $passenger->id], ['class' => 'text-muted me-2 text-decoration-none']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Passengers', 'action' => 'delete', $passenger->id], ['confirm' => __('Delete {0}?', $passenger->full_name), 'class' => 'text-danger text-decoration-none']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center p-5 text-muted">No passengers found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 text-center">
                    <?= $this->Html->link(__('Manage All Passengers'), ['controller' => 'Passengers', 'action' => 'index'], ['class' => 'btn btn-sm btn-outline-secondary', 'style' => 'color:white; border-color:white;']) ?>
                </div>
            </div>
        </div>

        <div id="users" class="page-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="margin: 0;">SYSTEM USERS</h2>
                <?= $this->Html->link(__('<i class="bi bi-plus-lg"></i> New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'btn-create', 'escape' => false]) ?>
            </div>
            <div class="dashboard-card">
                <div class="table-responsive">
                    <table class="table-flyhigh">
                        <thead>
                            <tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Created</th><th class="actions">Actions</th></tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="fw-bold text-muted"><?= $this->Number->format($user->id) ?></td>
                                    <td style="font-weight: bold;"><i class="bi bi-person-circle me-2" style="color:#666;"></i><?= h($user->username) ?></td>
                                    <td><?= h($user->email) ?></td>
                                    <td><span class="status-badge <?= strtolower($user->role) == 'admin' ? 'role-admin' : 'role-user' ?>"><?= h($user->role) ?></span></td>
                                    <td style="font-size: 0.85rem; color: #666;"><?= h($user->created) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $user->id], ['class' => 'text-white me-2 text-decoration-none']) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $user->id], ['class' => 'text-muted me-2 text-decoration-none']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $user->id], ['confirm' => __('Delete user {0}?', $user->username), 'class' => 'text-danger text-decoration-none']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center p-5 text-muted">No users found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 text-center">
                    <?= $this->Html->link(__('Manage All Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-sm btn-outline-secondary', 'style' => 'color:white; border-color:white;']) ?>
                </div>
            </div>
        </div>

        <footer class="footer-section">
    <div class="container">
        <div class="text-center mb-5 pb-4 border-bottom">
            <p class="text-muted small fw-bold mb-3">Accepted Payment Methods</p>
            <div class="d-flex flex-wrap justify-content-center gap-4 opacity-50">
                <span class="fw-bold">VISA</span> <span class="fw-bold">MasterCard</span> 
                <span class="fw-bold">PayPal</span> <span class="fw-bold">Maybank</span>
                <span class="fw-bold">CIMB</span> <span class="fw-bold">HSBC</span>
                <span class="fw-bold">UOB</span> <span class="fw-bold">BSN</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <h6 class="footer-title">Airpaz</h6>
                <a href="#" class="footer-link">Home</a>
                <a href="#" class="footer-link">About Us</a>
                <a href="#" class="footer-link">Airpaz Blog</a>
                <a href="#" class="footer-link">Careers</a>
            </div>
            <div class="col-md-2">
                <h6 class="footer-title">Account</h6>
                <a href="#" class="footer-link">Sign in / Register</a>
                <a href="#" class="footer-link">Forgot Password</a>
            </div>
            <div class="col-md-2">
                <h6 class="footer-title">Support</h6>
                <a href="#" class="footer-link">Help Center</a>
                <a href="#" class="footer-link">How to Book</a>
                <a href="#" class="footer-link">Terms & Conditions</a>
            </div>
            <div class="col-md-2 text-center">
                <h6 class="footer-title">Follow us</h6>
                <div class="d-flex justify-content-center gap-2">
                    <i class="bi bi-facebook fs-5 text-secondary"></i>
                    <i class="bi bi-instagram fs-5 text-secondary"></i>
                    <i class="bi bi-twitter-x fs-5 text-secondary"></i>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <h6 class="footer-title">Our App</h6>
                <div class="mb-2"><span class="badge bg-dark p-2 w-75">Get it on Google Play</span></div>
                <div><span class="badge bg-dark p-2 w-75">Download on App Store</span></div>
            </div>
        </div>
        
        <div class="text-center mt-5 py-4 border-top">
            <p class="text-muted small mb-1">Copyright 2026 FlyHigh.com. All rights reserved.</p>
            <p class="text-muted small" style="font-size: 0.65rem;">Domestic Airlines Sdn Bhd 105929-H</p>
        </div>
    </div>
</footer>

    </main>
</div>

<script>
    // Navigation logic
    function showSection(sectionId, element) {
        document.querySelectorAll('.page-section').forEach(s => s.classList.remove('active'));
        document.getElementById(sectionId).classList.add('active');
        document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
        element.classList.add('active');
    }

    // --- CHART CONFIGURATION ---

    // 1. Prepare Data
    // We use (int) to ensure they are numbers, and ?? 0 to prevent errors
    const realStats = {
        bookings: <?= (int)($stats['bookings'] ?? 0) ?>,
        flights: <?= (int)($stats['flights'] ?? 0) ?>,
        users: <?= (int)($stats['users'] ?? 0) ?>
    };

    const realRevenueLabels = <?= json_encode($revenueLabels) ?>;
    const realRevenueData = <?= json_encode($revenueData) ?>;

    // 2. CHECK FOR EMPTY DATA (To fix your issue)
    // If all stats are 0, we use "Mock Data" so you can see the chart design
    const totalStats = realStats.bookings + realStats.flights + realStats.users;
    const useMockData = totalStats === 0;

    const pieData = useMockData ? [12, 8, 5] : [realStats.bookings, realStats.flights, realStats.users]; 
    
    // Set Global Defaults for Gotham Theme
    Chart.defaults.color = '#7f8c8d'; 
    Chart.defaults.borderColor = 'rgba(255,255,255,0.05)';
    Chart.defaults.font.family = "'Rajdhani', sans-serif";

    // 3. Render Revenue Line Chart
    const ctxLine = document.getElementById('revenueLineChart');
    if (ctxLine) {
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: realRevenueLabels,
                datasets: [{
                    label: 'Monthly Revenue',
                    data: realRevenueData,
                    borderColor: '#f1c40f', // Gotham Gold
                    backgroundColor: 'rgba(241, 196, 15, 0.1)',
                    borderWidth: 2,
                    fill: true, 
                    tension: 0.4, 
                    pointRadius: 4, 
                    pointBackgroundColor: '#f1c40f',
                    pointBorderColor: '#000'
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false, 
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(255,255,255,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // 4. Render Resource Pie Chart
    const ctxPie = document.getElementById('resourcePieChart');
    if (ctxPie) {
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Bookings', 'Flights', 'Users'],
                datasets: [{
                    // Use the safe data we prepared above
                    data: pieData, 
                    backgroundColor: ['#f1c40f', '#e74c3c', '#3498db'], // Gold, Red, Blue
                    borderColor: '#121212', // Matches card background for "cutout" look
                    borderWidth: 5,
                    hoverOffset: 10
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false, 
                plugins: { 
                    legend: { 
                        position: 'right', 
                        labels: { 
                            usePointStyle: true, 
                            color: '#ecf0f1',
                            padding: 20,
                            font: { size: 12 }
                        } 
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                // Add a note if using mock data
                                let label = context.label || '';
                                if (label) { label += ': '; }
                                label += context.raw;
                                if (useMockData) { label += ' (Demo Data)'; }
                                return label;
                            }
                        }
                    }
                },
                cutout: '70%' // Makes the donut thinner and sharper
            }
        });
    }
</script>
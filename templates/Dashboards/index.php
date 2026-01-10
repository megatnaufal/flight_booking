<?php
/**
 * @var \App\View\AppView $this
 * @var array $stats
 * @var array $revenueData
 * @var array $revenueLabels
 * @var array $recentBookings
 */
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;500;700&family=Rajdhani:wght@500;700&display=swap');

    :root {
        --gotham-bg: #0a0a0a;
        --glass-bg: rgba(255, 255, 255, 0.05);
        --gotham-accent: #f1c40f; 
        --gotham-orange: #e67e22;
        --gotham-text: #ecf0f1;
        --gotham-success: #2ecc71;
        --gotham-red: #e74c3c;
        --gotham-blue: #3498db;
        --gotham-turquoise: #1abc9c;
    }

    /* Force Black Background and remove framework defaults */
    html, body {
        background-color: var(--gotham-bg) !important;
        background-image: radial-gradient(circle at center, #1a1a1b 0%, #0a0a0a 100%) !important;
        color: var(--gotham-text) !important;
        margin: 0;
        min-height: 100vh;
    }

    .main, .content, .container, .dashboards.index {
        background: transparent !important;
        box-shadow: none !important;
    }
    
    .dashboards.index.content { padding: 40px 20px; }

    h3 {
        font-family: 'Oswald', sans-serif; color: var(--gotham-accent);
        text-transform: uppercase; font-size: 2rem; letter-spacing: 4px;
        border-bottom: 2px solid var(--gotham-accent); padding-bottom: 8px; margin-bottom: 40px; 
        display: inline-block;
    }

    .dashboard-card {
    background: var(--glass-bg) !important;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
    /* Smooth transition for all properties */
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    cursor: pointer;
}

.dashboard-card:hover {
    /* Make the box slightly more opaque */
    background: rgba(255, 255, 255, 0.12) !important; 
    
    /* Subtle lift effect */
    transform: translateY(-8px); 
    
    /* Golden glow to match your gotham-accent */
    border-color: var(--gotham-accent);
    box-shadow: 0 10px 30px rgba(241, 196, 15, 0.2); 
    
    /* Brighten the text slightly */
    filter: brightness(1.2);
}

.dashboards.index.content .dashboard-card:last-of-type {
    margin-bottom: 0px !important;
}

    .stat-number { 
        font-family: 'Oswald', sans-serif; 
        font-size: 2.8rem; 
        font-weight: 700; 
        margin: 0;
    }

    .revenue-highlight { color: var(--gotham-success) !important; }

    /* Table Styling for the Gotham Mission Log */
    .table-responsive { overflow-x: auto; }
    .table-gotham { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0 10px; 
        color: var(--gotham-text);
        margin-top: 10px;
    }
    .table-gotham th { 
        color: var(--gotham-accent); 
        text-transform: uppercase; 
        font-size: 0.75rem; 
        padding: 10px; 
        text-align: left;
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    }

    .table-gotham tr:hover td i {
        transform: translateX(5px);
        transition: transform 0.3s ease;
        color: var(--gotham-accent);
    }

    .table-gotham td { 
        padding: 15px 10px; 
        font-size: 0.85rem; 
        background: rgba(255, 255, 255, 0.03); /* Slight tint for rows */
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .table-gotham tr td:first-child { border-left: 1px solid rgba(255, 255, 255, 0.05); border-radius: 4px 0 0 4px; }
    .table-gotham tr td:last-child { border-right: 1px solid rgba(255, 255, 255, 0.05); border-radius: 0 4px 4px 0; }

    .status-paid { color: var(--gotham-success); font-weight: bold; }
    .status-pending { color: var(--gotham-orange); font-weight: bold; }

    .chart-container { position: relative; height: 320px; width: 100%; }

    /* Gotham Dark Footer Styling */
.footer-gotham { 
    background: rgba(255, 255, 255, 0.02); 
    backdrop-filter: blur(10px);
    padding-top: 30px; /* Reduced from 60px to keep top content close */
    border-top: 1px solid rgba(255, 255, 255, 0.05); 
    margin-top: 30px; /* This controls the gap between the table card and the footer */
    width: 100%;
}
.footer-title-gotham { 
    font-size: 0.95rem; 
    font-weight: 700; 
    margin-bottom: 25px; 
    color: var(--gotham-accent); /* Golden headers to match dashboard */
    text-transform: uppercase;
    letter-spacing: 1px;
}
.footer-link-gotham { 
    font-size: 0.85rem; 
    color: #888; 
    text-decoration: none; 
    display: block; 
    margin-bottom: 10px; 
    transition: color 0.3s ease;
}
.footer-link-gotham:hover { 
    color: var(--gotham-accent); 
}
.payment-opacity {
    opacity: 0.4;
    transition: opacity 0.3s ease;
}
.payment-opacity:hover {
    opacity: 1;
}
</style>

<div class="dashboards index content">
    <div style="text-align: center;">
        <h3><?= __('ADMIN DASHBOARD') ?></h3>
    </div>

    <div class="row" style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 200px;">
            <div class="dashboard-card text-center">
                <h4 style="color: #888; font-size: 0.8rem; text-transform: uppercase;">Total Revenue</h4>
                <p class="stat-number revenue-highlight">RM <?= number_format($stats['revenue'], 2) ?></p>
            </div>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <div class="dashboard-card text-center">
                <h4 style="color: #888; font-size: 0.8rem; text-transform: uppercase;">Flights</h4>
                <p class="stat-number"><?= $this->Number->format($stats['flights']) ?></p>
            </div>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <div class="dashboard-card text-center">
                <h4 style="color: #888; font-size: 0.8rem; text-transform: uppercase;">Bookings</h4>
                <p class="stat-number"><?= $this->Number->format($stats['bookings']) ?></p>
            </div>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <div class="dashboard-card text-center">
                <h4 style="color: #888; font-size: 0.8rem; text-transform: uppercase;">Users</h4>
                <p class="stat-number"><?= $this->Number->format($stats['users']) ?></p>
            </div>
        </div>
    </div>

    <div class="row" style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 20px;">
        <div style="flex: 2; min-width: 300px;">
            <div class="dashboard-card">
                <h4 style="color: #888; font-size: 0.8rem; text-transform: uppercase;">Revenue Trend (MYR)</h4>
                <div class="chart-container">
                    <canvas id="revenueLineChart"></canvas>
                </div>
            </div>
        </div>
        <div style="flex: 1; min-width: 250px;">
            <div class="dashboard-card">
                <h4 style="color: #888; font-size: 0.8rem; text-transform: uppercase;">Resource Distribution</h4>
                <div class="chart-container">
                    <canvas id="missionPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <h4 style="color: #888; font-size: 0.8rem; text-transform: uppercase;">Recent Mission Logs (Bookings)</h4>
                <div class="table-responsive">
                    <table class="table-gotham">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Passenger</th>
                                <th>Route</th>
                                <th>Status</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentBookings as $log): ?>
                            <tr>
                                <td style="color: #777; font-weight: bold;"><?= h($log['id']) ?></td>
                                <td><?= h($log['user']) ?></td>
                                <td><i class="bi bi-airplane-fill" style="margin-right: 8px; color: var(--gotham-accent);"></i><?= h($log['route']) ?></td>
                                <td>
                                    <span class="<?= $log['status'] == 'Paid' ? 'status-paid' : 'status-pending' ?>">
                                        <?= h($log['status']) ?>
                                    </span>
                                </td>
                                <td style="font-weight: bold;"><?= h($log['amount']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer-gotham">
    <div class="container">
        <div class="text-center mb-5 pb-4 border-bottom border-secondary" style="border-color: rgba(255,255,255,0.05) !important;">
            <p class="text-muted small fw-bold mb-4" style="letter-spacing: 2px;">SECURE MISSION PAYMENTS</p>
            <div class="d-flex flex-wrap justify-content-center gap-4 payment-opacity">
                <span class="fw-bold text-white small">VISA</span> 
                <span class="fw-bold text-white small">MasterCard</span> 
                <span class="fw-bold text-white small">PayPal</span> 
                <span class="fw-bold text-white small">Maybank2u</span>
                <span class="fw-bold text-white small">CIMB Clicks</span> 
                <span class="fw-bold text-white small">HSBC</span>
                <span class="fw-bold text-white small">UOB</span> 
                <span class="fw-bold text-white small">RHB</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <h6 class="footer-title-gotham">FlyHigh Intelligence</h6>
                <a href="#" class="footer-link-gotham">Global Hub</a>
                <a href="#" class="footer-link-gotham">Company Profile</a>
                <a href="#" class="footer-link-gotham">Aviation Blog</a>
                <a href="#" class="footer-link-gotham">Career Portal</a>
            </div>
            <div class="col-md-2">
                <h6 class="footer-title-gotham">Identity</h6>
                <a href="#" class="footer-link-gotham">Terminal Access</a>
                <a href="#" class="footer-link-gotham">Reset Passcode</a>
            </div>
            <div class="col-md-2">
                <h6 class="footer-title-gotham">Support</h6>
                <a href="#" class="footer-link-gotham">Comms Center</a>
                <a href="#" class="footer-link-gotham">Booking Manual</a>
                <a href="#" class="footer-link-gotham">Rules of Engagement</a>
            </div>
            <div class="col-md-2 text-center">
                <h6 class="footer-title-gotham">Encryption</h6>
                <div class="d-flex justify-content-center gap-3">
                    <i class="bi bi-facebook fs-5 text-muted footer-link-gotham"></i>
                    <i class="bi bi-instagram fs-5 text-muted footer-link-gotham"></i>
                    <i class="bi bi-twitter-x fs-5 text-muted footer-link-gotham"></i>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <h6 class="footer-title-gotham">Mobile Uplink</h6>
                <div class="mb-2">
                    <span class="badge border border-secondary p-2 w-75 text-muted" style="background: rgba(255,255,255,0.02);">G-PLAY STORE</span>
                </div>
                <div>
                    <span class="badge border border-secondary p-2 w-75 text-muted" style="background: rgba(255,255,255,0.02);">APPLE iSTORE</span>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5 py-4 border-top border-secondary" style="border-color: rgba(255,255,255,0.05) !important;">
            <p class="text-muted small mb-1">System Time: <?= date('Y-m-d H:i:s') ?> | © 2026 FlyHigh.com Intelligence</p>
            <p class="text-muted small" style="font-size: 0.65rem; opacity: 0.5;">Global Airlines Holiday Sdn Bhd Bhd 105929-H</p>
        </div>
    </div>
</footer>

<script>
    const colors = {
        orange: '#e67e22',
        red: '#e74c3c',
        blue: '#3498db',
        turquoise: '#1abc9c',
        grid: 'rgba(255, 255, 255, 0.05)',
        text: '#ecf0f1'
    };

    Chart.defaults.color = colors.text;
    Chart.defaults.font.family = "'Rajdhani', sans-serif";

    // 1. Revenue Line Chart (Orange)
    new Chart(document.getElementById('revenueLineChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($revenueLabels) ?>,
            datasets: [{
                label: 'Revenue (RM)',
                data: <?= json_encode($revenueData) ?>,
                borderColor: colors.orange,
                backgroundColor: 'rgba(230, 126, 34, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: colors.orange
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { grid: { color: colors.grid }, beginAtZero: true },
                x: { grid: { display: false } }
            },
            plugins: { legend: { display: false } }
        }
    });

    // 2. Resource Pie Chart (Red, Blue, Turquoise)
    new Chart(document.getElementById('missionPieChart'), {
        type: 'pie',
        data: {
            labels: ['Bookings', 'Passengers', 'Users'],
            datasets: [{
                data: [<?= (int)$stats['bookings'] ?>, <?= (int)$stats['passengers'] ?>, <?= (int)$stats['users'] ?>],
                backgroundColor: [colors.red, colors.blue, colors.turquoise],
                borderColor: 'rgba(0,0,0,0.5)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
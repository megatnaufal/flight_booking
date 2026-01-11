<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Monthly Report - FlyHigh</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Rajdhani:wght@500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Rajdhani', sans-serif; color: #000; padding: 40px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 2rem; font-family: 'Oswald', sans-serif; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; }
        .sub-header { color: #666; font-size: 0.9rem; }
        
        .stats-grid { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .stat-box { border: 1px solid #ccc; padding: 15px; width: 22%; text-align: center; }
        .stat-title { font-weight: bold; font-size: 0.8rem; text-transform: uppercase; color: #666; }
        .stat-value { font-size: 1.5rem; font-weight: bold; margin-top: 5px; }

        table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        th { text-align: left; border-bottom: 2px solid #000; padding: 10px; text-transform: uppercase; font-size: 0.8rem; }
        td { padding: 8px 10px; border-bottom: 1px solid #eee; }
        
        .footer { margin-top: 50px; text-align: center; font-size: 0.8rem; color: #666; border-top: 1px solid #ccc; padding-top: 20px; }
        
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #000; color: #fff; cursor: pointer; border: none; font-weight: bold;">DOWNLOAD PDF / PRINT</button>
        <a href="<?= $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']) ?>" style="margin-left: 10px; text-decoration: none; color: #000;">Back to Dashboard</a>
    </div>

    <div class="header">
        <div class="logo">FlyHigh System Report</div>
        <div class="sub-header">Generated on: <?= $generatedDate ?></div>
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-title">Total Revenue</div>
            <div class="stat-value">MYR <?= number_format($totalRevenue, 2) ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-title">Total Flights</div>
            <div class="stat-value"><?= number_format($totalFlights) ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-title">Total Bookings</div>
            <div class="stat-value"><?= number_format(count($bookings)) ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-title">System Users</div>
            <div class="stat-value"><?= number_format($totalUsers) ?></div>
        </div>
    </div>

    <h3>Recent Bookings</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Passenger</th>
                <th>Flight</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td>#<?= $booking->id ?></td>
                <td><?= h($booking->has('passenger') ? $booking->passenger->first_name . ' ' . $booking->passenger->last_name : '-') ?></td>
                <td><?= h($booking->has('flight') ? $booking->flight->airline_name : '-') ?></td>
                <td><?= h($booking->booking_date) ?></td>
                <td><?= h($booking->status) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>CONFIDENTIAL REPORT</p>
        <p>&copy; <?= date('Y') ?> FlyHigh System. All rights reserved.</p>
    </div>

    <script>
        // Auto-trigger print on load
        window.onload = function() {
           // window.print(); 
        };
    </script>
</body>
</html>

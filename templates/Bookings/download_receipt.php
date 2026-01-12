<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var \App\Model\Entity\Booking|null $returnBooking
 * @var array $passengers
 * @var float $totalPrice
 * @var float $departurePrice
 * @var float $returnPrice
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Receipt - <?= h($booking->id) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background: #fff;
            padding: 40px;
        }
        .receipt {
            max-width: 800px;
            margin: 0 auto 40px;
            border: 1px solid #ddd;
            padding: 40px;
            page-break-after: always;
        }
        .receipt:last-of-type {
            page-break-after: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #4C1D95;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #4C1D95;
        }
        .logo span {
            color: #7C3AED;
        }
        .receipt-title {
            text-align: right;
        }
        .receipt-title h1 {
            font-size: 24px;
            color: #4C1D95;
            margin-bottom: 5px;
        }
        .receipt-title p {
            color: #666;
            font-size: 13px;
        }
        .flight-type-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .badge-departure {
            background: #4C1D95;
            color: white;
        }
        .badge-return {
            background: #10B981;
            color: white;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #4C1D95;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #E5E7EB;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .info-item {
            padding: 12px;
            background: #F9FAFB;
            border-radius: 8px;
        }
        .info-label {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #111;
        }
        .flight-card {
            background: #F9FAFB;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
        }
        .flight-header {
            font-weight: 600;
            color: #4C1D95;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .flight-route {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .flight-city {
            text-align: center;
        }
        .flight-city .city {
            font-size: 20px;
            font-weight: 700;
            color: #111;
        }
        .flight-city .code {
            font-size: 13px;
            color: #666;
        }
        .flight-city .time {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }
        .flight-arrow {
            font-size: 24px;
            color: #4C1D95;
            padding: 0 30px;
        }
        .flight-number {
            text-align: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #ddd;
        }
        .flight-number span {
            background: #4C1D95;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
        }
        .passengers-table {
            width: 100%;
            border-collapse: collapse;
        }
        .passengers-table th,
        .passengers-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #E5E7EB;
        }
        .passengers-table th {
            background: #F9FAFB;
            font-size: 12px;
            text-transform: uppercase;
            color: #666;
            font-weight: 600;
        }
        .passengers-table td {
            font-size: 14px;
        }
        .total-section {
            background: linear-gradient(135deg, #4C1D95 0%, #7C3AED 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-label {
            font-size: 16px;
            font-weight: 500;
        }
        .total-amount {
            font-size: 28px;
            font-weight: 700;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #E5E7EB;
            color: #888;
            font-size: 12px;
        }
        .print-btn {
            background: #4C1D95;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            margin: 20px auto;
            display: block;
        }
        .print-btn:hover {
            background: #5B21B6;
        }
        @media print {
            body {
                padding: 0;
            }
            .receipt {
                border: none;
                padding: 20px;
                margin-bottom: 0;
            }
            .print-btn {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <!-- DEPARTURE RECEIPT -->
    <div class="receipt">
        <div class="header">
            <div class="logo">Fly<span>High</span></div>
            <div class="receipt-title">
                <h1>Booking Receipt</h1>
                <p>Generated: <?= date('d M Y, H:i') ?></p>
            </div>
        </div>

        <div class="flight-type-badge badge-departure">✈ Departure Flight</div>

        <div class="section">
            <h3 class="section-title">Booking Details</h3>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Booking Reference</div>
                    <div class="info-value">#<?= h($booking->id) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Booking Date</div>
                    <div class="info-value"><?= h($booking->booking_date?->format('d M Y') ?? 'N/A') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Payment Method</div>
                    <div class="info-value"><?= h($booking->payment_method ?? 'N/A') ?></div>
                </div>
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">Flight Information</h3>
            <div class="flight-card">
                <div class="flight-route">
                    <div class="flight-city">
                        <div class="city"><?= h($booking->flight->origin_airport?->city ?? 'N/A') ?></div>
                        <div class="code"><?= h($booking->flight->origin_airport?->airport_code ?? '') ?></div>
                        <div class="time"><?= h($booking->flight->departure_time?->format('D, d M Y')) ?><br><?= h($booking->flight->departure_time?->format('H:i')) ?></div>
                    </div>
                    <div class="flight-arrow">→</div>
                    <div class="flight-city">
                        <div class="city"><?= h($booking->flight->dest_airport?->city ?? 'N/A') ?></div>
                        <div class="code"><?= h($booking->flight->dest_airport?->airport_code ?? '') ?></div>
                        <div class="time"><?= h($booking->flight->arrival_time?->format('D, d M Y')) ?><br><?= h($booking->flight->arrival_time?->format('H:i')) ?></div>
                    </div>
                </div>
                <div class="flight-number">
                    <span>Flight <?= h($booking->flight->flight_number ?? 'N/A') ?></span>
                </div>
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">Passenger</h3>
            <table class="passengers-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($passengers as $index => $pax): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><strong><?= h($pax->full_name ?? 'N/A') ?></strong></td>
                        <td><?= h($pax->type ?? 'Adult') ?></td>
                        <td><?= h($pax->phone_number ?? '-') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="total-section">
                <div class="total-label">Flight Price</div>
                <div class="total-amount">RM <?= number_format($departurePrice ?? $booking->flight->base_price ?? 0, 2) ?></div>
            </div>
        </div>

        <div class="footer">
            <p>Thank you for choosing FlyHigh!</p>
            <p>This is a computer-generated receipt and does not require a signature.</p>
        </div>
    </div>

    <?php if ($returnBooking): ?>
    <!-- RETURN RECEIPT -->
    <div class="receipt">
        <div class="header">
            <div class="logo">Fly<span>High</span></div>
            <div class="receipt-title">
                <h1>Booking Receipt</h1>
                <p>Generated: <?= date('d M Y, H:i') ?></p>
            </div>
        </div>

        <div class="flight-type-badge badge-return">✈ Return Flight</div>

        <div class="section">
            <h3 class="section-title">Booking Details</h3>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Booking Reference</div>
                    <div class="info-value">#<?= h($returnBooking->id) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Booking Date</div>
                    <div class="info-value"><?= h($returnBooking->booking_date?->format('d M Y') ?? 'N/A') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Payment Method</div>
                    <div class="info-value"><?= h($returnBooking->payment_method ?? 'N/A') ?></div>
                </div>
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">Flight Information</h3>
            <div class="flight-card">
                <div class="flight-route">
                    <div class="flight-city">
                        <div class="city"><?= h($returnBooking->flight->origin_airport?->city ?? 'N/A') ?></div>
                        <div class="code"><?= h($returnBooking->flight->origin_airport?->airport_code ?? '') ?></div>
                        <div class="time"><?= h($returnBooking->flight->departure_time?->format('D, d M Y')) ?><br><?= h($returnBooking->flight->departure_time?->format('H:i')) ?></div>
                    </div>
                    <div class="flight-arrow">→</div>
                    <div class="flight-city">
                        <div class="city"><?= h($returnBooking->flight->dest_airport?->city ?? 'N/A') ?></div>
                        <div class="code"><?= h($returnBooking->flight->dest_airport?->airport_code ?? '') ?></div>
                        <div class="time"><?= h($returnBooking->flight->arrival_time?->format('D, d M Y')) ?><br><?= h($returnBooking->flight->arrival_time?->format('H:i')) ?></div>
                    </div>
                </div>
                <div class="flight-number">
                    <span>Flight <?= h($returnBooking->flight->flight_number ?? 'N/A') ?></span>
                </div>
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">Passenger</h3>
            <table class="passengers-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($passengers as $index => $pax): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><strong><?= h($pax->full_name ?? 'N/A') ?></strong></td>
                        <td><?= h($pax->type ?? 'Adult') ?></td>
                        <td><?= h($pax->phone_number ?? '-') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="total-section">
                <div class="total-label">Flight Price</div>
                <div class="total-amount">RM <?= number_format($returnPrice ?? $returnBooking->flight->base_price ?? 0, 2) ?></div>
            </div>
        </div>

        <div class="footer">
            <p>Thank you for choosing FlyHigh!</p>
            <p>This is a computer-generated receipt and does not require a signature.</p>
        </div>
    </div>
    <?php endif; ?>

    <div style="text-align: center; margin-top: 20px;">
        <button class="print-btn" onclick="window.print()">🖨️ Print Receipt<?= $returnBooking ? 's' : '' ?></button>
        <?= $this->Html->link('🏠 Return to Home', ['controller' => 'Pages', 'action' => 'display', 'home'], ['class' => 'print-btn', 'style' => 'text-decoration: none; display: inline-block; background: #10B981;']) ?>
    </div>
</body>
</html>

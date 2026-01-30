<?php
/**
 * Receipt Template - Printable via browser (Ctrl+P)
 * @var \App\Model\Entity\Booking $booking
 * @var \App\Model\Entity\Booking|null $returnBooking
 * @var array $passengers
 * @var float $departurePrice
 * @var float $returnPrice
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt - #<?= h($booking->id) ?></title>
    <style>
        @page {
            margin: 10mm;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            background: #fff;
            width: 100%;
            max-width: 100%;
        }
        .receipt {
            width: 100%;
            max-width: 100%;
            padding: 15px;
            padding-right: 30px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            page-break-inside: avoid;
        }
        .header {
            border-bottom: 2px solid #4C1D95;
            padding-bottom: 15px;
            margin-bottom: 20px;
            width: 100%;
        }
        .header table {
            width: 100%;
            table-layout: fixed;
        }
        .header table td {
            width: 50%;
            overflow: hidden;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4C1D95;
        }
        .logo span {
            color: #7C3AED;
        }
        .receipt-title {
            text-align: right;
            padding-right: 30px;
        }
        .receipt-title h1 {
            font-size: 18px;
            color: #4C1D95;
            margin-bottom: 5px;
        }
        .receipt-title p {
            color: #666;
            font-size: 10px;
        }
        .flight-type-badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 15px;
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
            margin-bottom: 20px;
            padding-right: 30px;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #4C1D95;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #E5E7EB;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 10px;
            background: #F9FAFB;
            border-radius: 5px;
            vertical-align: top;
            width: 33.333%;
        }
        .info-label {
            font-size: 9px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }
        .info-value {
            font-size: 13px;
            font-weight: bold;
            color: #111;
        }
        .flight-card {
            background: #F9FAFB;
            border-radius: 8px;
            padding: 15px;
        }
        .flight-table {
            width: 100%;
        }
        .flight-table td {
            vertical-align: middle;
        }
        .flight-city {
            text-align: center;
            width: 40%;
        }
        .city-name {
            font-size: 16px;
            font-weight: bold;
            color: #111;
        }
        .city-code {
            font-size: 11px;
            color: #666;
        }
        .city-time {
            font-size: 10px;
            color: #888;
            margin-top: 3px;
        }
        .flight-arrow {
            text-align: center;
            font-size: 18px;
            color: #4C1D95;
            width: 20%;
        }
        .flight-number {
            text-align: center;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
        }
        .flight-number span {
            background: #4C1D95;
            color: white;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        .passengers-table {
            width: 100%;
            border-collapse: collapse;
        }
        .passengers-table th,
        .passengers-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #E5E7EB;
        }
        .passengers-table th {
            background: #F9FAFB;
            font-size: 10px;
            text-transform: uppercase;
            color: #666;
            font-weight: bold;
        }
        .passengers-table td {
            font-size: 12px;
        }
        .total-section {
            background: linear-gradient(135deg, #4C1D95 0%, #7C3AED 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
        .total-table {
            width: 100%;
        }
        .total-label {
            font-size: 14px;
        }
        .total-amount {
            text-align: right;
            font-size: 22px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #E5E7EB;
            color: #888;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <!-- DEPARTURE RECEIPT -->
    <div class="receipt">
        <div class="header">
            <table>
                <tr>
                    <td><div class="logo">Fly<span>High</span></div></td>
                    <td class="receipt-title">
                        <h1>Booking Receipt</h1>
                        <p>Generated: <?= date('d M Y, H:i') ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="flight-type-badge badge-departure">Departure Flight</div>

        <div class="section">
            <div class="section-title">Booking Details</div>
            <table class="info-table">
                <tr>
                    <td>
                        <div class="info-label">Booking Reference</div>
                        <div class="info-value">#<?= h($booking->id) ?></div>
                    </td>
                    <td>
                        <div class="info-label">Booking Date</div>
                        <div class="info-value"><?= h($booking->booking_date?->format('d M Y') ?? 'N/A') ?></div>
                    </td>
                    <td>
                        <div class="info-label">Payment Method</div>
                        <div class="info-value"><?= h($booking->payment_method ?? 'N/A') ?></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Flight Information</div>
            <div class="flight-card">
                <table class="flight-table">
                    <tr>
                        <td class="flight-city">
                            <div class="city-name"><?= h($booking->flight->origin_airport?->city ?? 'N/A') ?></div>
                            <div class="city-code"><?= h($booking->flight->origin_airport?->airport_code ?? '') ?></div>
                            <div class="city-time"><?= h($booking->flight->departure_time?->format('D, d M Y')) ?><br><?= h($booking->flight->departure_time?->format('H:i')) ?></div>
                        </td>
                        <td class="flight-arrow">---&gt;</td>
                        <td class="flight-city">
                            <div class="city-name"><?= h($booking->flight->dest_airport?->city ?? 'N/A') ?></div>
                            <div class="city-code"><?= h($booking->flight->dest_airport?->airport_code ?? '') ?></div>
                            <div class="city-time"><?= h($booking->flight->arrival_time?->format('D, d M Y')) ?><br><?= h($booking->flight->arrival_time?->format('H:i')) ?></div>
                        </td>
                    </tr>
                </table>
                <div class="flight-number">
                    <span>Flight <?= h($booking->flight->flight_number ?? 'N/A') ?></span>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Passenger</div>
            <table class="passengers-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Seat</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($passengers as $index => $pax): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><strong><?= h($pax->full_name ?? 'N/A') ?></strong></td>
                        <td><?= h($pax->type ?? 'Adult') ?></td>
                        <td><?= h($pax->seat_number ?? '-') ?></td>
                        <td><?= h($pax->phone_number ?? '-') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="total-section">
                <table class="total-table">
                    <tr>
                        <td class="total-label">Flight Price</td>
                        <td class="total-amount">RM <?= number_format($departurePrice ?? $booking->flight->base_price ?? 0, 2) ?></td>
                    </tr>
                </table>
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
            <table>
                <tr>
                    <td><div class="logo">Fly<span>High</span></div></td>
                    <td class="receipt-title">
                        <h1>Booking Receipt</h1>
                        <p>Generated: <?= date('d M Y, H:i') ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="flight-type-badge badge-return">Return Flight</div>

        <div class="section">
            <div class="section-title">Booking Details</div>
            <table class="info-table">
                <tr>
                    <td>
                        <div class="info-label">Booking Reference</div>
                        <div class="info-value">#<?= h($returnBooking->id) ?></div>
                    </td>
                    <td>
                        <div class="info-label">Booking Date</div>
                        <div class="info-value"><?= h($returnBooking->booking_date?->format('d M Y') ?? 'N/A') ?></div>
                    </td>
                    <td>
                        <div class="info-label">Payment Method</div>
                        <div class="info-value"><?= h($returnBooking->payment_method ?? 'N/A') ?></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Flight Information</div>
            <div class="flight-card">
                <table class="flight-table">
                    <tr>
                        <td class="flight-city">
                            <div class="city-name"><?= h($returnBooking->flight->origin_airport?->city ?? 'N/A') ?></div>
                            <div class="city-code"><?= h($returnBooking->flight->origin_airport?->airport_code ?? '') ?></div>
                            <div class="city-time"><?= h($returnBooking->flight->departure_time?->format('D, d M Y')) ?><br><?= h($returnBooking->flight->departure_time?->format('H:i')) ?></div>
                        </td>
                        <td class="flight-arrow">---&gt;</td>
                        <td class="flight-city">
                            <div class="city-name"><?= h($returnBooking->flight->dest_airport?->city ?? 'N/A') ?></div>
                            <div class="city-code"><?= h($returnBooking->flight->dest_airport?->airport_code ?? '') ?></div>
                            <div class="city-time"><?= h($returnBooking->flight->arrival_time?->format('D, d M Y')) ?><br><?= h($returnBooking->flight->arrival_time?->format('H:i')) ?></div>
                        </td>
                    </tr>
                </table>
                <div class="flight-number">
                    <span>Flight <?= h($returnBooking->flight->flight_number ?? 'N/A') ?></span>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Passenger</div>
            <table class="passengers-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Type</th>
                        <th>Seat</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($returnPassengers as $index => $pax): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><strong><?= h($pax->full_name ?? 'N/A') ?></strong></td>
                        <td><?= h($pax->type ?? 'Adult') ?></td>
                        <td><?= h($pax->seat_number ?? '-') ?></td>
                        <td><?= h($pax->phone_number ?? '-') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="total-section">
                <table class="total-table">
                    <tr>
                        <td class="total-label">Flight Price</td>
                        <td class="total-amount">RM <?= number_format($returnPrice ?? $returnBooking->flight->base_price ?? 0, 2) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer">
            <p>Thank you for choosing FlyHigh!</p>
            <p>This is a computer-generated receipt and does not require a signature.</p>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>

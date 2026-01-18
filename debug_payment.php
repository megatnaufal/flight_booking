<?php
// bin/cake console script
// Usage: bin/cake console src/scripts/debug_payment.php

// Load the app
require dirname(__DIR__) . '/config/bootstrap.php';

use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

$bookingsTable = TableRegistry::getTableLocator()->get('Bookings');
$schema = $bookingsTable->getSchema();

echo "Checking Bookings Table Schema...\n";
if ($schema->hasColumn('payment_method')) {
    echo "SUCCESS: 'payment_method' column exists.\n";
    print_r($schema->getColumn('payment_method'));
} else {
    echo "ERROR: 'payment_method' column MISSING.\n";
}

echo "\nChecking Recent Bookings...\n";
$booking = $bookingsTable->find()->order(['id' => 'DESC'])->first();
if ($booking) {
    echo "ID: " . $booking->id . "\n";
    echo "Payment Method: " . var_export($booking->payment_method, true) . "\n";
    echo "Ticket Status: " . $booking->ticket_status . "\n";
} else {
    echo "No bookings found.\n";
}

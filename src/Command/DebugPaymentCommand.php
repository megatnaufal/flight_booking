<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\ORM\TableRegistry;

class DebugPaymentCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $bookingsTable = TableRegistry::getTableLocator()->get('Bookings');
        $schema = $bookingsTable->getSchema();

        $io->out("Checking Bookings Table Schema...");
        if ($schema->hasColumn('payment_method')) {
            $io->out("SUCCESS: 'payment_method' column exists.");
            $col = $schema->getColumn('payment_method');
            $io->out(print_r($col, true));
        } else {
            $io->out("ERROR: 'payment_method' column MISSING.");
        }

        $io->out("\nChecking Recent Bookings...");
        $booking = $bookingsTable->find()->order(['id' => 'DESC'])->first();
        if ($booking) {
            $io->out("ID: " . $booking->id);
            $io->out("Payment Method: " . var_export($booking->payment_method, true));
            $io->out("Ticket Status: " . $booking->ticket_status);
        } else {
            $io->out("No bookings found.");
        }
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $id
 * @property int|null $passenger_id
 * @property int|null $flight_id
 * @property \Cake\I18n\Date|null $booking_date
 * @property string|null $seat_number
 * @property string|null $ticket_status
 * @property string|null $payment_method
 *
 * @property \App\Model\Entity\Passenger $passenger
 * @property \App\Model\Entity\Flight $flight

 */
class Booking extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'passenger_id' => true,
        'flight_id' => true,
        'booking_date' => true,
        'seat_number' => true,
        'ticket_status' => true,
        'payment_method' => true,
        'passenger' => true,
        'flight' => true,

    ];
}

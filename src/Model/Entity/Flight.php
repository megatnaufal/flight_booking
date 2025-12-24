<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Flight Entity
 *
 * @property int $id
 * @property string $flight_number
 * @property int|null $origin_airport_id
 * @property int|null $dest_airport_id
 * @property \Cake\I18n\DateTime|null $departure_time
 * @property string|null $base_price
 *
 * @property \App\Model\Entity\Airport $origin_airport
 * @property \App\Model\Entity\Airport $dest_airport
 * @property \App\Model\Entity\Booking[] $bookings
 */
class Flight extends Entity
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
        'flight_number' => true,
        'origin_airport_id' => true,
        'dest_airport_id' => true,
        'departure_time' => true,
        'base_price' => true,
        'origin_airport' => true,
        'dest_airport' => true,
        'bookings' => true,
    ];
}

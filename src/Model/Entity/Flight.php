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
 * @property \Cake\I18n\DateTime|null $arrival_time
 * @property string|null $base_price
 * @property string|null $airline_name
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
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'flight_number' => true,
        'origin_airport_id' => true,
        'dest_airport_id' => true,
        'departure_time' => true,
        'arrival_time' => true,
        'base_price' => true,
        'airline_name' => true,
        'origin_airport' => true,
        'dest_airport' => true,
        'bookings' => true,
    ];

    /**
     * Virtual field: duration_text
     * Calculates the flight duration from departure and arrival times.
     *
     * @return string|null
     */
    protected function _getDurationText(): ?string
    {
        if (!$this->departure_time || !$this->arrival_time) {
            return null;
        }
        
        $diff = $this->departure_time->diff($this->arrival_time);
        $hours = $diff->h + ($diff->days * 24);
        $minutes = $diff->i;
        
        return "{$hours}h {$minutes}m";
    }

    /**
     * Virtual field: airline_logo
     * Returns the logo URL for the airline.
     *
     * @return string|null
     */
    protected function _getAirlineLogo(): ?string
    {
        $logos = [
            'AirAsia' => 'https://airhex.com/images/airline-logos/airasia.png',
            'Malaysia Airlines' => 'https://logos-world.net/wp-content/uploads/2023/01/Malaysia-Airlines-Logo.png',
            'Batik Air Malaysia' => 'https://airhex.com/images/airline-logos/batik-air.png',
            'Firefly' => 'https://airhex.com/images/airline-logos/firefly.png',
        ];
        
        return $logos[$this->airline_name] ?? null;
    }

    /**
     * Virtual field: duration_minutes
     * Returns the flight duration in minutes.
     *
     * @return int|null
     */
    protected function _getDurationMinutes(): ?int
    {
        if (!$this->departure_time || !$this->arrival_time) {
            return null;
        }
        
        $diff = $this->departure_time->diff($this->arrival_time);
        return ($diff->h * 60) + $diff->i + ($diff->days * 24 * 60);
    }
}

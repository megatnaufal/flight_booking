<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Luggage Entity
 *
 * @property int $id
 * @property int|null $booking_id
 * @property string|null $weight_kg
 * @property string|null $luggage_type
 *
 * @property \App\Model\Entity\Booking $booking
 */
class Luggage extends Entity
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
        'booking_id' => true,
        'weight_kg' => true,
        'luggage_type' => true,
        'booking' => true,
    ];
}

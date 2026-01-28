<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Passenger Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $full_name
 * @property string|null $passport_number
 * @property string|null $phone_number
 * @property string|resource|null $passport_photo
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Booking[] $bookings
 */
class Passenger extends Entity
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
        'user_id' => true,
        'full_name' => true,
        'passport_number' => true,
        'phone_number' => true,
        'dob' => true,
        'type' => true,
        'booking_id' => true,
        'seat_number' => true,
        'user' => true,
        'bookings' => true,
    ];
}

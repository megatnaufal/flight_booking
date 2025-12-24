<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Airport Entity
 *
 * @property int $id
 * @property string $airport_code
 * @property string $airport_name
 * @property string|null $city
 * @property string|null $country
 */
class Airport extends Entity
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
        'airport_code' => true,
        'airport_name' => true,
        'city' => true,
        'country' => true,
    ];
}

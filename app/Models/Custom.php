<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Custom
 *
 * @property int $id
 * @property string $name
 * @property string $id_card
 * @property int $id_card_type 1 身份证 2 香港身份证 3 其他证件
 * @property int $phone
 * @property string $address
 * @property string $pic
 * @method static \Illuminate\Database\Eloquent\Builder|Custom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Custom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Custom query()
 * @method static \Illuminate\Database\Eloquent\Builder|Custom whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Custom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Custom whereIdCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Custom whereIdCardType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Custom whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Custom wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Custom wherePic($value)
 * @mixin \Eloquent
 */
class Custom extends Model
{
    protected $table = 'custom';
}

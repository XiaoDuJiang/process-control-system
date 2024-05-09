<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Car
 *
 * @property int $id
 * @property string $price 车辆价格
 * @property string $license 车牌号
 * @property string $vin 车架号
 * @property string $brand 车辆品牌
 * @property string $model 型号
 * @method static \Illuminate\Database\Eloquent\Builder|Car newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car query()
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereVin($value)
 * @mixin \Eloquent
 */
class Car extends Model
{
    protected $table = 'car';
}

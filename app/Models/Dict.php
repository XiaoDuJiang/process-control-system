<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Dict
 *
 * @property int $id
 * @property string $code 字典编码
 * @property string $value 值
 * @property string $group 字典分组
 * @method static \Illuminate\Database\Eloquent\Builder|Dict newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dict newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dict query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dict whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dict whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dict whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dict whereValue($value)
 * @mixin \Eloquent
 */
class Dict extends Model
{
    protected $table = 'dict';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Flow
 *
 * @property int $id
 * @property string $name 流程名称
 * @property string $ele_table 关联主表
 * @property int $soft_del 软删除标记
 * @method static \Illuminate\Database\Eloquent\Builder|Flow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Flow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Flow query()
 * @method static \Illuminate\Database\Eloquent\Builder|Flow whereEleTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flow whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Flow whereSoftDel($value)
 * @mixin \Eloquent
 */
class Flow extends Model
{
    protected $table = 'flow';
}

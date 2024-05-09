<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ele
 *
 * @property int $id
 * @property string $name 元素名称-元素在表中的字段名
 * @property string $table 元素所属表
 * @property string $cname 中文名 用于显示
 * @property int $order 用于排序
 * @property string $type 类型 用于显示或者操作
 * @property string $dict_table 字典表 有的记录为id所以需要字典
 * @property string $dict_value 字典表字段
 * @property string $dict_where 字典表查询条件
 * @property string $check 验证规则
 * @method static \Illuminate\Database\Eloquent\Builder|Ele newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ele newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ele query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereCname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereDictTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereDictValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereDictWhere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ele whereType($value)
 * @mixin \Eloquent
 */
class Ele extends Model
{
    protected $table = 'ele';
}

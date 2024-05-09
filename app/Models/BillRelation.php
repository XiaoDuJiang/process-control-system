<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BillRelation
 *
 * @property int $id
 * @property int $bill_id 订单编号
 * @property int $relation_id 关联编号
 * @property string $relation_table 关联表名
 * @method static \Illuminate\Database\Eloquent\Builder|BillRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillRelation whereBillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillRelation whereRelationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillRelation whereRelationTable($value)
 * @mixin \Eloquent
 */
class BillRelation extends Model
{
    protected $table = 'bill_relation';
}

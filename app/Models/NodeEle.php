<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NodeEle
 *
 * @property int $id
 * @property int $node_id 节点编号
 * @property int $ele_id 元素编号
 * @property int $type 关联类型
 * 1 必填元素
 * 2 选填元素
 * 3 可见元素
 * 4 不可见元素
 * @method static \Illuminate\Database\Eloquent\Builder|NodeEle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeEle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeEle query()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeEle whereEleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeEle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeEle whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeEle whereType($value)
 * @mixin \Eloquent
 */
class NodeEle extends Model
{
    protected $table = 'node_ele';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NodeRelation
 *
 * @property int $id
 * @property int $node_id
 * @property int $next_node_id
 * @property int|null $create_time
 * @property int|null $update_time
 * @property string|null $node_draw_begin 连线起始点 用于绘制线
 * @property string|null $node_draw_end 连线结束点
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation whereNextNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation whereNodeDrawBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation whereNodeDrawEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRelation whereUpdateTime($value)
 * @mixin \Eloquent
 */
class NodeRelation extends Model
{
    protected $table = 'node_relation';
}

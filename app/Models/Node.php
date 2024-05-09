<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Node
 *
 * @property int $id
 * @property string $name 节点名称
 * @property int $flow_id 流程编号
 * @property string $position 节点位置信息
 * @property int $type 1 普通节点 2 条件节点 3 并行开始节点 4 并行结束节点
 * @property int $back_flag 是否能退回 1 能 0 不能
 * @property int|null $create_time
 * @property int|null $update_time
 * @method static \Illuminate\Database\Eloquent\Builder|Node newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Node newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Node query()
 * @method static \Illuminate\Database\Eloquent\Builder|Node whereBackFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Node whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Node whereFlowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Node whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Node whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Node wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Node whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Node whereUpdateTime($value)
 * @mixin \Eloquent
 */
class Node extends Model
{
    protected $table = 'node';
}

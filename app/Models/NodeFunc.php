<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NodeFunc
 *
 * @property int $id
 * @property int $node_id 节点编号
 * @property string $func_name 方法名称
 * @property int $type 函数类型
 * 1 条件函数(判断是否能进入此节点)
 * 2 执行前函数(节点线程创建前的函数)
 * 3 执行后函数(节点完成时执行的函数)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeFunc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeFunc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeFunc query()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeFunc whereFuncName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeFunc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeFunc whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeFunc whereType($value)
 * @mixin \Eloquent
 */
class NodeFunc extends Model
{
    protected $table = 'node_func';
}

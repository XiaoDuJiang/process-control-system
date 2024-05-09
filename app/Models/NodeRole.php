<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NodeRole
 *
 * @property int $id
 * @property int $role_id
 * @property int $node_id
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRole whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NodeRole whereRoleId($value)
 * @mixin \Eloquent
 */
class NodeRole extends Model
{
    protected $table = 'node_role';
}

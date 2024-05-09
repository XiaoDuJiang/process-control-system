<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoleAuth
 *
 * @property int $id
 * @property int $role_id
 * @property int $auth_id
 * @method static \Illuminate\Database\Eloquent\Builder|RoleAuth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleAuth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleAuth query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleAuth whereAuthId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleAuth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleAuth whereRoleId($value)
 * @mixin \Eloquent
 */
class RoleAuth extends Model
{
    protected $table = 'role_auth';

    public static function getAuthByRoleIds(array $role_ids): array
    {
        return RoleAuth::whereIn('role_id', $role_ids)->pluck('auth_id')->toArray();
    }
}

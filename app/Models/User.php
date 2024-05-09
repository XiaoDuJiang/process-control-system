<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $account 账号
 * @property string $password 密码
 * @property string $name 用户名
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @mixin \Eloquent
 */
class User extends Model
{
    protected $table = 'user';

    /**
     * 根据id获取用户信息  包括 id name 角色 权限信息
     * @param int $id
     * @return array
     */
    public static function getUserLoginInfo(int $id): array
    {
        # 获取用户信息
        $user = User::select(['id', 'name'])->find($id);
        if (!$user) {
            return [];
        }
        $user_info = $user->toArray();
        # 获取角色信息
        $role_ids = UserRole::getRoleListByUserId($user_info['id']);
        if (isEmpty($role_ids)) {
            return [];
        }
        # 获取权限信息
        $auth_ids = RoleAuth::getAuthByRoleIds($role_ids);
        if (isEmpty($auth_ids)) {
            return [];
        }
        # 获取权限信息并返回
        return [
            'user_info' => $user_info,
            'auth_info' => Auth::getAuthInfoTreeDataByIds($auth_ids)
        ];
    }

    /**
     * 验证用户登录信息 并且返回用户id
     * @param string $account
     * @param string $password
     * @return int
     */
    public static function verifyUserLogin(string $account, string $password): int
    {
        # 加密密码之后对比
        $password = password_md5($password);
        $id = self::getUserIdByData([
            'account' => $account,
            'password' => $password
        ]);
        return $id;
    }

    /**
     * 根据传入的数据获取用户编号
     * @param array $data
     * @return int
     */
    public static function getUserIdByData(array $data): int
    {
        $id = User::where($data)->value('id');
        return $id ?: 0;
    }

    /**
     * 查看是否存在账号
     * @param string $account
     * @return bool
     */
    public static function hvAccount(string $account): bool
    {
        $hv_id = User::where('account', $account)->value('id');
        return $hv_id ? true : false;
    }

    /**
     * 注册用户方法
     * @param array $data
     * @return bool
     */
    public static function register(array $data): bool
    {
        try {
            # 加密密码
            $data['password'] = password_md5($data['password']);
            User::insert($data);
            return true;
        } catch (\Exception $e) {
            print_r($e);
            return false;
        }
    }
}

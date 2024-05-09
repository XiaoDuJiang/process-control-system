<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isEmpty;

/**
 * App\Models\Auth
 *
 * @property int $id
 * @property string $name
 * @property int $pid
 * @property string $url
 * @method static \Illuminate\Database\Eloquent\Builder|Auth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Auth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Auth query()
 * @method static \Illuminate\Database\Eloquent\Builder|Auth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auth whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auth wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Auth whereUrl($value)
 * @mixin \Eloquent
 */
class Auth extends Model
{
    protected $table = 'auth';

    public static function getAuthInfoByIds(array $auth_ids): array
    {
        return Auth::whereIn('id', $auth_ids)->get()->toArray();
    }

    /**
     * 获取权限树形信息
     * @param array $auth_ids 权限id数组
     * @return array 树形数据 ['1'=> '2'=> '3'=>] 根据层级传递
     */
    public static function getAuthInfoTreeDataByIds(array $auth_ids): array
    {
        //获取所有的权限数据
        $auth_info = self::getAllLevelAuthInfo($auth_ids);
        //组织成特定数据根据等级分层 ['1'=>,'2'=>,'3'=>] 这种 树形数据反而不好拿
        $auth_tree_data = self::getTreeDataByAllAuthInfo($auth_info);
        return $auth_tree_data;
    }

    private function getTreeDataByAllAuthInfo($auth_info, $pids = [0], $tree_data = [])
    {
        //当前层级
        $now_level = sizeof($tree_data) + 1;
        //当前层级所有的id 成为下一层级的pid
        $now_ids = [];
        //是否有当前层的数据 用于跳出递归
        $hv_now_level = false;
        //获取当前数组
        foreach ($auth_info as $ai) {
            //如果是这一层级的数据 (根据上一层的pid去找)
            if (in_array($ai['pid'], $pids)) {
                $now_ids[] = $ai['id'];
                $hv_now_level = true;
                if (!isset($tree_data[$now_level])) {
                    $tree_data[$now_level] = [];
                }
                $tree_data[$now_level][] = $ai;
            }
        }
        if (!$hv_now_level) {
            // 如果没有这一层的数据 则结束递归
            return $tree_data;
        } else {
            // 如果有这一层的数据 就再去找下一层
            return $this->getTreeDataByAllAuthInfo($auth_info, $now_ids, $tree_data);
        }
    }

    /**
     * 根据权限id数组获取所有层级的权限数据
     * @param array $auth_ids 权限列表
     * @param array $level_list 递归传入的数组
     * @return array 全部权限数据
     */
    private function getAllLevelAuthInfo(array $auth_ids, array $level_list = []): array
    {
        $auth_info = self::getAuthInfoByIds($auth_ids);
        if (isEmpty($auth_info)) {
            return $level_list;
        } else {
            # 合并数组
            $level_list = array_merge($level_list, $auth_info);
            # 递归去找父亲
            $p_auth_ids = [];
            foreach ($auth_info as $v) {
                $p_auth_ids[] = $v['pid'];
            }
            return $this->getAllLevelAuthInfo($p_auth_ids, $level_list);
        }
    }

}

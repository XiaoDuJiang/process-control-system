<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bill
 *
 * @property int $id
 * @property string $bill_number 订单编号(加密)
 * @property int $plan_id 方案编号
 * @property int $claimer_id 报单人编号
 * @property string $commission 手续费
 * @property string|null $remark 备注
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereBillNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereClaimerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereRemark($value)
 * @mixin \Eloquent
 */
class Bill extends Model
{
    protected $table = 'bill';
}

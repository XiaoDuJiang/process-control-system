<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Loan
 *
 * @property int $id
 * @property string $amount 贷款金额
 * @property string $bank_name 银行名称
 * @property string $rate 贷款利率
 * @property int $number 贷款期数
 * @property string|null $start_date 贷款开始时间
 * @property int|null $pay_day 还款日
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan wherePayDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStartDate($value)
 * @mixin \Eloquent
 */
class Loan extends Model
{
    protected $table = 'loan';
}

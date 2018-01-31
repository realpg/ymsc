<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/31
 * Time: 13:36
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsCaseModel extends Model
{
    use SoftDeletes;
    protected $table = 'goods_case_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
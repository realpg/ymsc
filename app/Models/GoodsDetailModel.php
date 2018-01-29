<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/29
 * Time: 15:27
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsDetailModel extends Model
{
    use SoftDeletes;
    protected $table = 'goods_detail_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
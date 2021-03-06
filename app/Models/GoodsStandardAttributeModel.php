<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25
 * Time: 15:03
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsStandardAttributeModel extends Model
{
    use SoftDeletes;
    protected $table = 'goods_standard_attribute_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
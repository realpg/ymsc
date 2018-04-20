<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 10:40
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsExplainModel extends Model
{
    use SoftDeletes;
    protected $table = 'goods_explain_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
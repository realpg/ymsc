<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25
 * Time: 15:02
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsChemAttributeModel extends Model
{
    use SoftDeletes;
    protected $table = 'goods_chem_attribute_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
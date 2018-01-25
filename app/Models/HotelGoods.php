<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/23
 * Time: 10:56
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelGoods extends Model
{
    use SoftDeletes;
    protected $table = 'hotel_goodses';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
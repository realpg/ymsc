<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25
 * Time: 14:59
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressProvinceModel extends Model
{
    use SoftDeletes;
    protected $table = 'address_province_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
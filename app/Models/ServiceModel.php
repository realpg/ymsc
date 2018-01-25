<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25
 * Time: 15:06
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceModel extends Model
{
    use SoftDeletes;
    protected $table = 'service_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
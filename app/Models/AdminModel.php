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

class AdminModel extends Model
{
    use SoftDeletes;
    protected $table = 'admin_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
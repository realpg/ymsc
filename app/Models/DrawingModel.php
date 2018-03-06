<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/6
 * Time: 15:07
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrawingModel extends Model
{
    use SoftDeletes;
    protected $table = 'drawing_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
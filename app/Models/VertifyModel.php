<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25
 * Time: 16:44
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VertifyModel extends Model
{
    use SoftDeletes;
    protected $table = 'vertify_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
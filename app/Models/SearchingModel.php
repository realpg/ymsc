<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25
 * Time: 15:05
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SearchingModel extends Model
{
    use SoftDeletes;
    protected $table = 'searching_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
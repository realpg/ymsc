<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/18
 * Time: 15:51
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FriendshipModel extends Model
{
    use SoftDeletes;
    protected $table = 'friendship_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
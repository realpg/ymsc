<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/6
 * Time: 9:27
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WordModel extends Model
{
    use SoftDeletes;
    protected $table = 'word_info';
    public $timestamps = true;
    protected $dates=['deleted_at'];
}
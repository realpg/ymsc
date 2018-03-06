<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/6
 * Time: 9:32
 */

namespace app\Components;

use App\Models\WordModel;

class WordManager
{
    /*
     * 配置关键字参数
     *
     * By zm
     *
     * 2018-03-06
     */
    public static function setWord($word, $data)
    {
        if (array_key_exists('name', $data)) {
            $word->name = array_get($data, 'name');
        }
        if (array_key_exists('sort', $data)) {
            $word->sort = array_get($data, 'sort');
        }
        return $word;
    }

    /*
     * 根据id获取关键字信息
     *
     * By zm
     *
     * 2018-03-06
     */
    public static function getWordById($id)
    {
        $word = WordModel::find($id);
        return $word;
    }

    /*
     * 查找关键字
     *
     * By zm
     *
     * 2018-03-06
     */
    public static function getAllWordLists($search)
    {
        $words = WordModel::where('name','like','%'.$search.'%')->orderBy('sort','desc')->get();
        return $words;
    }

    /*
     * 输出关键字
     *
     * By zm
     *
     * 2018-03-06
     */
    public static function getAllWords()
    {
        $words = WordModel::orderBy('sort','desc')->get();
        return $words;
    }

    /*
     * 前台输出关键字（个数限制）
     *
     * By zm
     *
     * 2018-03-06
     */
    public static function getAllWordsForIndex()
    {
        $words = WordModel::orderBy('sort','desc')->offset(0)->limit(10)->get();
        return $words;
    }
}
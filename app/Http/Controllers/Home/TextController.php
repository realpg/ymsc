<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 17:54
 */

namespace App\Http\Controllers\Home;


class TextController
{
    public function text(Request $request){
        $data = $request->all();
        return view('home.text.text', $data);
    }
}
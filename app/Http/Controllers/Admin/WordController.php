<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/6
 * Time: 9:31
 */

namespace app\Http\Controllers\Admin;

use App\Components\WordManager;
use App\Models\WordModel;
use Illuminate\Http\Request;

class WordController
{
    //首页
    public function index(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(array_key_exists('search',$data)){
            $search=$data['search'];
        }
        else{
            $search='';
        }
//        $words = WordManager::getAllWordLists($search);  //无分页
        $words = WordManager::getAllWordListsWithPage($search);  //有分页
        $param=array(
            'admin'=>$admin,
            'datas'=>$words,
            'search'=>$search
        );
        return view('admin.word.index', $param);
    }
    
    //删除
    public function del(Request $request)
    {
        $data=$request->all();
        if(array_key_exists('id',$data)){
            $id=$data['id'];
            if (is_numeric($id) !== true) {
                $return['result']=false;
                $return['msg']='合规校验失败，参数类型不正确';
            }
            else{
                $word = WordModel::find($id);
                $return=null;
                $result=$word->delete();
                if($result){
                    $return['result']=true;
                    $return['msg']='删除成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='删除失败';
                }
            }
        }
        else{
            $return['result']=false;
            $return['msg']='合规校验失败，缺少参数';
        }
        return $return;
    }

    //新建或编辑关键字-get
    public function edit(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if (array_key_exists('id', $data)) {
            $word = WordManager::getWordById($data['id']);
        }
        else{
            $word = new WordModel();
        }
        $param=array(
            'admin'=>$admin,
            'data'=>$word
        );
        return view('admin.word.edit', $param);
    }

    //新建或编辑关键字-post
    public function editDo(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(empty($data['id'])){
            $word=new WordModel();
        }
        else{
            $word = WordManager::getWordById($data['id']);
        }
        $word = WordManager::setWord($word,$data);
        $result=$word->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑关键字成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑关键字失败';
        }
        return $return;
    }
}
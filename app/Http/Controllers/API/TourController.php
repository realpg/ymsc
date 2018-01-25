<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/22
 * Time: 16:45
 */

namespace App\Http\Controllers\API;

use App\Components\TourCategorieManager;
use App\Components\TourGoodsManager;
use App\Http\Controllers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TourController extends Controller
{
    /*
     * 获取旅游产品的目的地
     */
    public function getTourCategories(Request $request){
        $data = $request->all();
        $type=$data['type'];
        $categories=TourCategorieManager::getCategorieLists($type);
        if ($categories) {
            return ApiResponse::makeResponse(true, $categories, ApiResponse::SUCCESS_CODE);
        } else {
            return ApiResponse::makeResponse(false, ApiResponse::$errorMassage[ApiResponse::MISSING_PARAM], ApiResponse::MISSING_PARAM);
        }
    }
    /*
     * 获取旅游产品列表
     */
    public function getTourGoodsLists(Request $request){
        $data = $request->all();
        $tour_goodses=TourCategorieManager::getTourGoodsLists($data);
        if ($tour_goodses) {
            return ApiResponse::makeResponse(true, $tour_goodses, ApiResponse::SUCCESS_CODE);
        } else {
            return ApiResponse::makeResponse(false, ApiResponse::$errorMassage[ApiResponse::MISSING_PARAM], ApiResponse::MISSING_PARAM);
        }
    }
    /*
     * 获取旅游产品的详细信息
     */
    public function getTourGoodsDetail(Request $request){
        $data = $request->all();
        $tour_goods=TourGoodsManager::getTourGoodsDetail($data);
        if ($tour_goods) {
            return ApiResponse::makeResponse(true, $tour_goods, ApiResponse::SUCCESS_CODE);
        } else {
            return ApiResponse::makeResponse(false, ApiResponse::$errorMassage[ApiResponse::MISSING_PARAM], ApiResponse::MISSING_PARAM);
        }
    }
}
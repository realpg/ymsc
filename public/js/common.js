//初始化body的高度
$(function () {
    var winHeight=$(window).height();
    $('#main-body').css('min-height',winHeight-45);
    $('#main-body').css('border-bottom','#06131B 3px solid');
});

// 接口部分
//基本的ajax访问后端接口类
function ajaxRequest(url, param, method, callBack) {
    console.log("url:" + url + " method:" + method + " param:" + JSON.stringify(param));
    $.ajax({
        type: method,  //提交方式
        url: url,//路径
        data: param,//数据，这里使用的是Json格式进行传输
        contentType: "application/json", //必须有
        dataType: "json",
        success: function (ret) {//返回数据根据结果进行相应的处理
            console.log("ret:" + JSON.stringify(ret));
            callBack(ret)
        },
        error: function (err) {
            console.log(JSON.stringify(err));
            console.log("responseText:" + err.responseText);
            callBack(err)
        }
    });
}

//设置管理员状态
function setAdminStatus(url, param, callBack) {
    ajaxRequest(url + "admin/admin/setStatus/" + param.id, param, "GET", callBack);
}
//删除管理员
function delAdmin(url, param, callBack) {
    ajaxRequest(url + "admin/admin/del", param, "GET", callBack);
}
//删除Banner
function delBanner(url, param, callBack) {
    ajaxRequest(url + "admin/banner/del", param, "GET", callBack);
}
//加盟信息标记已联系
function stampLeague(url, param, callBack) {
    $.post(url + "admin/league/stamp",param,callBack);
}
//删除加盟信息
function delLeague(url, param, callBack) {
    ajaxRequest(url + "admin/league/del", param, "GET", callBack);
}
//批量删除加盟信息
function delMoreLeague(url, param, callBack) {
    ajaxRequest(url + "admin/league/delMore", param, "GET", callBack);
}
//投诉信息标记已联系
function stampAdvice(url, param, callBack) {
    $.post(url + "admin/advice/stamp",param,callBack);
}
//删除投诉信息
function delAdvice(url, param, callBack) {
    ajaxRequest(url + "admin/advice/del", param, "GET", callBack);
}
//批量删除投诉信息
function delMoreAdvice(url, param, callBack) {
    ajaxRequest(url + "admin/advice/delMore", param, "GET", callBack);
}
//找货信息标记已联系
function stampSearching(url, param, callBack) {
    $.post(url + "admin/searching/stamp",param,callBack);
}
//删除找货信息
function delSearching(url, param, callBack) {
    ajaxRequest(url + "admin/searching/del", param, "GET", callBack);
}
//批量删除找货信息
function delMoreSearching(url, param, callBack) {
    ajaxRequest(url + "admin/searching/delMore", param, "GET", callBack);
}
//删除栏目
function delMenu(url, param, callBack) {
    ajaxRequest(url + "admin/menu/del", param, "GET", callBack);
}
//删除搜索属性
function delAttribute(url, param, callBack) {
    ajaxRequest(url + "admin/attribute/del", param, "GET", callBack);
}
//删除商品
function delGoods(url, param, callBack) {
    ajaxRequest(url + "admin/goods/del", param, "GET", callBack);
}
//批量删除商品
function delMoreGoods(url, param, callBack) {
    ajaxRequest(url + "admin/goods/delMore", param, "GET", callBack);
}

//删除化学商品大类
function delChemClass(url, param, callBack) {
    ajaxRequest(url + "admin/chem/delClass", param, "GET", callBack);
}
//删除化学商品
function delChem(url, param, callBack) {
    ajaxRequest(url + "admin/chem/del", param, "GET", callBack);
}
//批量删除化学商品
function delMoreChem(url, param, callBack) {
    ajaxRequest(url + "admin/chem/delMore", param, "GET", callBack);
}
//删除第三方检测商品
function delTesting(url, param, callBack) {
    ajaxRequest(url + "admin/testing/del", param, "GET", callBack);
}
//批量删除第三方检测商品
function delMoreTesting(url, param, callBack) {
    ajaxRequest(url + "admin/testing/delMore", param, "GET", callBack);
}
//删除第三方检测商品详情
function delTestingDetail(url, param, callBack) {
    ajaxRequest(url + "admin/testingdetail/del", param, "GET", callBack);
}
//修改第三方检测商品详情
function editTestingDetail(url, param, callBack) {
    $.post(url + "admin/testingdetail/edit",param,callBack);
}
//删除机加工商品
function delMachining(url, param, callBack) {
    ajaxRequest(url + "admin/machining/del", param, "GET", callBack);
}
//批量删除机加工商品
function delMoreMachining(url, param, callBack) {
    ajaxRequest(url + "admin/machining/delMore", param, "GET", callBack);
}
//删除加工商品详情
function delMachiningDetail(url, param, callBack) {
    ajaxRequest(url + "admin/machiningdetail/del", param, "GET", callBack);
}
//修改加工商品详情
function editMachiningDetail(url, param, callBack) {
    $.post(url + "admin/machiningdetail/edit",param,callBack);
}
//删除加工商品案例
function delMachiningCase(url, param, callBack) {
    ajaxRequest(url + "admin/machiningcase/del", param, "GET", callBack);
}
//修改加工商品案例
function editMachiningCase(url, param, callBack) {
    $.post(url + "admin/machiningcase/edit",param,callBack);
}


//下发短信验证码
function sendSMSCode(url, param, callBack) {
    ajaxRequest(url + "smscode", param, "GET", callBack);
}
//下发邮箱验证码
function sendEmailCode(url, param, callBack) {
    ajaxRequest(url + "emailcode", param, "GET", callBack);
}
//////////////////////////////////////////////////////////////////////////////////////////////////


/*
 * 校验手机号js
 *
 * By TerryQi
 */

function isPoneAvailable(phone_num) {
    var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
    if (!myreg.test(phone_num)) {
        return false;
    } else {
        return true;
    }
}

/*
 * 校验邮箱js
 *
 * By zm
 */

function isEmail(email) {
    var myreg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
    if (!myreg.test(email)) {
        return false;
    } else {
        return true;
    }
}

// 判断参数是否为空
function judgeIsNullStr(val) {
    if (val == null || val == "" || val == undefined || val == "未设置") {
        return true
    }
    return false
}

// 判断参数是否为空
function judgeIsAnyNullStr() {
    if (arguments.length > 0) {
        for (var i = 0; i < arguments.length; i++) {
            if (!isArray(arguments[i])) {
                if (arguments[i] == null || arguments[i] == "" || arguments[i] == undefined || arguments[i] == "未设置" || arguments[i] == "undefined") {
                    return true
                }
            }
        }
    }
    return false
}

// 判断数组时候为空, 服务于 judgeIsAnyNullStr 方法
function isArray(object) {
    return Object.prototype.toString.call(object) == '[object Array]';
}


// 七牛云图片裁剪
function qiniuUrlTool(img_url, type) {
    //如果不是七牛的头像，则直接返回图片
    //consoledebug.log("img_url:" + img_url + " indexOf('isart.me'):" + img_url.indexOf('isart.me'));
    if (img_url.indexOf('7xku37.com') < 0 && img_url.indexOf('isart.me') < 0) {
        return img_url;
    }
    //七牛链接
    var qn_img_url;
    const size_w_500_h_200 = '?imageView2/2/w/500/h/200/interlace/1/q/75|imageslim'
    const size_w_200_h_200 = '?imageView2/2/w/200/h/200/interlace/1/q/75|imageslim'
    const size_w_500_h_300 = '?imageView2/2/w/500/h/300/interlace/1/q/75|imageslim'
    const size_w_500_h_250 = '?imageView2/2/w/500/h/250/interlace/1/q/75|imageslim'

    const size_w_500 = '?imageView1/1/w/500/interlace/1/q/75'

    //除去参数
    if (img_url.indexOf("?") >= 0) {
        img_url = img_url.split('?')[0]
    }
    //封装七牛链接
    switch (type) {
        case "ad":  //广告图片
            qn_img_url = img_url + size_w_500_h_300
            break
        case "folder_list":  //作品列表图片样式
            qn_img_url = img_url + size_w_500_h_200
            break
        case  'head_icon':      //头像信息
            qn_img_url = img_url + size_w_200_h_200
            break
        case  'work_detail':      //作品详情的图片信息
            qn_img_url = img_url + size_w_500
            break
        default:
            qn_img_url = img_url
            break
    }
    return qn_img_url
}


// 文字转html，主要是进行换行转换
function Text2Html(str) {
    if (str == null) {
        return "";
    } else if (str.length == 0) {
        return "";
    }
    str = str.replace(/\r\n/g, "<br>")
    str = str.replace(/\n/g, "<br>");
    return str;
}

//null变为空str
function nullToEmptyStr(str) {
    if (judgeIsNullStr(str)) {
        str = "";
    }
    return str;
}


/*
 * 获取url中get的参数
 *
 * By TerryQi
 *
 * 2017-12-23
 *
 */
function getQueryString(name) {
    var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return unescape(r[2]);
    }
    return null;
}





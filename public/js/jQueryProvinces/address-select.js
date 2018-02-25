var address_province=$("#address_province"),address_city=$("#address_city"),address_town=$("#address_town");
for(var i=0;i<provinceList.length;i++){
    addEle(address_province,provinceList[i].name);
}
function addEle(ele,value){
    var optionStr="";
    optionStr="<option value="+value+">"+value+"</option>";
    ele.append(optionStr);
}
function removeEle(ele){
    ele.find("option").remove();
    var optionStar="<option value="+""+">"+"请选择"+"</option>";
    ele.append(optionStar);
}
var provinceText,cityText,cityItem;
address_province.on("change",function(){
    provinceText=$(this).val();
    $.each(provinceList,function(i,item){
        if(provinceText == item.name){
            cityItem=i;
            return cityItem
        }
    });
    removeEle(address_city);
    removeEle(address_town);
    $.each(provinceList[cityItem].cityList,function(i,item){
        addEle(address_city,item.name)
    })
});
address_city.on("change",function(){
    cityText=$(this).val();
    removeEle(address_town);
    $.each(provinceList,function(i,item){
        if(provinceText == item.name){
            cityItem=i;
            return cityItem
        }
    });
    $.each(provinceList[cityItem].cityList,function(i,item){
        if(cityText == item.name){
            for(var n=0;n<item.areaList.length;n++){
                addEle(address_town,item.areaList[n])
            }
        }
    });
});
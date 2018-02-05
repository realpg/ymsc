$(function(){
    var flag=0;
    var winHeight=$(window).height();
    var headerHeight=$('header').outerHeight();
    for(var i=0;i<4;i++){
        $("#floatDivBoxs"+i).css("height",winHeight);
        $("#floatDivBoxs"+i).css("top",headerHeight+"px");
    }
})

function changeChannel(index){
    for(var i=0;i<4;i++){
        $("#rightArrow"+i).animate({right: '270px'},300);
        if(index==i){
            $("#rightArrow"+index).find("a").css('background','#182F41');
            $("#floatDivBoxs"+index).animate({right: '0'},300);
        }
        else{
            $("#rightArrow"+i).find("a").css('background','#06131B');
            $("#floatDivBoxs"+i).animate({right: '-275px'},300);
        }
    }
    flag=1;
}
function cloaseChannel(){
    for(var j=0;j<4;j++){
        $("#rightArrow"+j).animate({right: '0px'},300);
        $("#floatDivBoxs"+j).animate({right: '-275px'},300);
        $("#rightArrow"+j).find("a").css('background','#06131B');
    }
    flag=0;
}
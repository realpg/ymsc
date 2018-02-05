$(function(){
    var flag=0;
    var winHeight=$(window).height();
    for(var i=0;i<4;i++){
        $("#floatDivBoxs"+i).css("height",winHeight);
    }
    // for(var i=0;i<4;i++){
    //     $('#rightArrow'+i).click(function(){
    //         $("#rightArrow"+i).find("a").css('background','#fff');
    //         if(flag==1){
    //             // $("#floatDivBoxs0").animate({right: '-175px'},300);
    //             for(var j=0;j<4;j++){
    //                 $("#rightArrow"+j).animate({right: '0px'},300);
    //             }
    //             flag=0;
    //         }else{
    //             // $("#floatDivBoxs0").animate({right: '0'},300);
    //             for(var j=0;j<4;j++){
    //                 $("#rightArrow"+j).animate({right: '170px'},300);
    //             }
    //             flag=1;
    //         }
    //     });
    // }

    // $('#rightArrow0').click(function(){
    //     if(flag==1){
    //         $("#floatDivBoxs0").animate({right: '-175px'},300);
    //         $(this).animate({right: '0px'},300);
    //         $(this).css('background-position','-50px 0');
    //         $("#floatDivBoxs0").css('height',winHeight);
    //         flag=0;
    //     }else{
    //         $("#floatDivBoxs0").animate({right: '0'},300);
    //         $(this).animate({right: '170px'},300);
    //         $(this).css('background-position','0px 0');
    //         $("#floatDivBoxs0").css('height',winHeight);
    //         flag=1;
    //     }
    // });
    // $('#rightArrow1').click(function(){
    //     if(flag==1){
    //         $("#floatDivBoxs1").animate({right: '-175px'},300);
    //         $(this).animate({right: '0px'},300);
    //         $(this).css('background-position','-50px 0');
    //         $("#floatDivBoxs").css('height',winHeight);
    //         flag=0;
    //     }else{
    //         $("#floatDivBoxs1").animate({right: '0'},300);
    //         $(this).animate({right: '170px'},300);
    //         $(this).css('background-position','0px 0');
    //         $("#floatDivBoxs").css('height',winHeight);
    //         flag=1;
    //     }
    // });
    // $('#rightArrow2').click(function(){
    //     if(flag==1){
    //         $("#floatDivBoxs2").animate({right: '-175px'},300);
    //         $(this).animate({right: '0px'},300);
    //         $(this).css('background-position','-50px 0');
    //         $("#floatDivBoxs").css('height',winHeight);
    //         flag=0;
    //     }else{
    //         $("#floatDivBoxs2").animate({right: '0'},300);
    //         $(this).animate({right: '170px'},300);
    //         $(this).css('background-position','0px 0');
    //         $("#floatDivBoxs").css('height',winHeight);
    //         flag=1;
    //     }
    // });
    //
    // $('#rightArrow3').click(function(){
    //     if(flag==1){
    //         $("#floatDivBoxs3").animate({right: '-175px'},300);
    //         $(this).animate({right: '0px'},300);
    //         $(this).css('background-position','-50px 0');
    //         $("#floatDivBoxs").css('height',winHeight);
    //         flag=0;
    //     }else{
    //         $("#floatDivBoxs3").animate({right: '0'},300);
    //         $(this).animate({right: '170px'},300);
    //         $(this).css('background-position','0px 0');
    //         $("#floatDivBoxs").css('height',winHeight);
    //         flag=1;
    //     }
    // });
})

function changeChannel(index){
    for(var i=0;i<4;i++){
        $("#rightArrow"+i).animate({right: '185px'},300);
        if(index==i){
            $("#rightArrow"+index).find("a").css('background','#182F41');
            $("#floatDivBoxs"+index).animate({right: '0'},300);
        }
        else{
            $("#rightArrow"+i).find("a").css('background','#06131B');
            $("#floatDivBoxs"+i).animate({right: '-190px'},300);
        }
    }
    flag=1;
}
function cloaseChannel(){
    for(var j=0;j<4;j++){
        $("#rightArrow"+j).animate({right: '0px'},300);
        $("#floatDivBoxs"+j).animate({right: '-190px'},300);
    }
    flag=0;
}
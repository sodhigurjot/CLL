/* 
    Created on : 15 Aug, 2016, 2:15:08 PM
    Author     : Gurjot
*/
$(document).ready(function () {
    $('.menu a').hover(function () {
        $(this).stop().animate({
            opacity:1
        }, 200);
    }, function () {
        $(this).stop().animate({
            opacity:0.5
        }, 200);
    });
});
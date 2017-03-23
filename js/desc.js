/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(".yel").mouseover(function() {
    $(this).children(".desc1").show();
}).mouseout(function() {
    $(this).children(".desc1").hide();
});

$(".gre").mouseover(function() {
    $(this).children(".desc2").show();
}).mouseout(function() {
    $(this).children(".desc2").hide();
});
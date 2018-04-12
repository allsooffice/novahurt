
//guzik pierwszys lajd
function previously ()
{
var first = $( "#prev-btn" ).next().attr("id");
var last = $( "#next-btn" ).prev().attr("id");
var wyswietlany = $( ".visible-image" ).attr("id");
if(wyswietlany == first)
{
    var next = last;
    var visible = wyswietlany;
}
    
if(wyswietlany != first)
{
    var next = --wyswietlany;
    var visible = ++wyswietlany;   
}
$("#"+next).fadeIn(100, function()
{
$("#"+visible).fadeOut(100).removeClass("visible-image");   
}).addClass("visible-image");
//zaznaczanie thumbow 
$("#tmb"+visible).removeClass("selected");
$("#tmb"+next).addClass("selected");

    if(wyswietlany > 5)
    {
        var koniec = last - wyswietlany;
        if(koniec > 3){
        $(".thumbs-true").css({
        "left": "+=94px",
        "width": "-=94px"
        })}
        
    }
//alert(wyswietlany);    
if(wyswietlany == 2)
    {
    $( ".prev i" ).hide();
    }
if(wyswietlany < last+1)
    {
    $( "#next-btn" ).fadeIn();
    }
 
}


//guzik nastepny slajd
function nextimage()
{
var first = $( "#prev-btn" ).next().attr("id");
var last = $( "#next-btn" ).prev().attr("id");
var wyswietlany = $( ".visible-image" ).attr("id");
if(wyswietlany == last)
{
    var next = first;
    var visible = wyswietlany;  
}
if(wyswietlany != last)
{
    var next = ++wyswietlany;
    var visible = --wyswietlany;
}
    
$("#"+next).fadeIn(100, function()
{
$("#"+visible).fadeOut(100).removeClass("visible-image");   
}).addClass("visible-image");
//zaznaczanie thumbow 
$("#tmb"+visible).removeClass("selected");
$("#tmb"+next).addClass("selected");
    
    if(wyswietlany > 4)
    {
        var koniec = last - wyswietlany;
        if(koniec > 4){
        $(".thumbs-true").css({
        "left": "-=94px",
        "width": "+=94px"
        })}
        
        if(wyswietlany == last-1){
        $( "#next-btn" ).hide();
        }
    }    

if(wyswietlany > 0)
    {
    $( ".prev i" ).fadeIn();
    }
}

$("#next-btn").on("click" ,function(){
nextimage();

})
    
$("#prev-btn").on("click" ,function(){
previously();      
})

$(".thumbs ul li").on("click" ,function(){
    var klikniete = $(this).attr("name");
    var wyswietlane = $( ".visible-image" ).attr("id");
    var last = $( "#next-btn" ).prev().attr("id");
    $("#"+klikniete).fadeIn(300, function(){
    $("#"+wyswietlane).fadeOut(100).removeClass("visible-image");
    }).addClass("visible-image");
    //zaznaczanie thumbow
    $("#tmb"+wyswietlane).removeClass("selected");
    $("#tmb"+klikniete).addClass("selected");
        if(wyswietlane > 4)
    {
        var koniec = last - wyswietlane;
        if(koniec > 4){
        $(".thumbs-true").css({
        "left": "-=94px",
        "width": "+=94px"
        })}
        
        if(wyswietlany == last-1){
        $( "#next-btn" ).hide();
        }
    }   
    
    
})
$( "ul" ).draggable({ containment: "parent" }, { axis: "x" });
$(document).ready(function() {
var first = $( "#prev-btn" ).next().attr("id");
var wyswietlany = $( ".visible-image" ).attr("id");

})
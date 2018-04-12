$(document).ready(function() {
var slideWidth = $(".galeria ol li").first().width();
var thumbWidth = $(".thumbs ul li").first().width();
var thumbFirst = $(".thumbs ul li").first();
var thumbLast = $(".thumbs ul li").last();
var thumbsQua = $(".thumbs ul li").last().attr('name');
var ol = $(".galeria ol");
var ul = $(".thumbs ul");
var changeSlideTine = 300;
var down = '';
//auomatycznie rzesuniecie pierwszego zdiecia na srodek
if(thumbsQua > 7)
{
    var x = 1;
    while (x <= 3) {
    var thumbLi = $(".thumbs ul li");
    thumbLi.first().before(thumbLi.last());
    ul.css({'margin-left' : 0});
    x++;
    }
}
//Przyciśniecie przycisku w lewo   
$(".prev").on("click" ,function(){
    var li = $(".galeria ol li");
    ol.css('margin-left',-slideWidth);
    li.first().before(li.last());
    ol.animate({'margin-left' : 0}, changeSlideTine);
    //thumby
    var runningTmb = $(".thumbs ul li.running");
    if(thumbsQua > 7)
    {
    runningTmb.prev().addClass("running");
    runningTmb.removeClass("running");
    var thumbLi = $(".thumbs ul li");
    ul.css('margin-left',-thumbWidth);
    thumbLi.first().before(thumbLi.last());
    ul.animate({'margin-left' : 0}, changeSlideTine);
    }
    else
    {
        if(runningTmb.attr('name') == thumbFirst.attr('name'))
            {
              thumbLast.addClass("running");
              runningTmb.removeClass("running");
            }
        else
            {
               runningTmb.prev().addClass("running");
               runningTmb.removeClass("running");
            }
    }
});
	
		

	
//Przyciśniecie przycisku w prawo   
$(".next").on("click" ,function(){
    var li = $(".galeria ol li");
    ol.animate({'margin-left' : -slideWidth}, changeSlideTine, function(){
        li.last().after(li.first());
        ol.css({'margin-left' : 0});
    });
    //thumby
    var runningTmb = $(".thumbs ul li.running");
    if(thumbsQua > 7)
    {
    runningTmb.next().addClass("running");
    runningTmb.removeClass("running");
    var thumbLi = $(".thumbs ul li");
    ul.animate({'margin-left' : -thumbWidth}, changeSlideTine, function(){
    thumbLi.last().after(thumbLi.first());
    ul.css({'margin-left' : 0});
    });
    }
    else
    {
       if(runningTmb.attr('name') == thumbsQua)
           {
            thumbFirst.addClass("running");
            runningTmb.removeClass("running");
           }
        else
            {
             runningTmb.next().addClass("running");
             runningTmb.removeClass("running");
            }
    }
});
	
//Przyciśniecie thumba 
$(".thumbs ul li").on("click" ,function(){
	var runningTmb = $(".thumbs ul li.running");
	var runningTmbNumber = $(".thumbs ul li.running").index();
   var clicked = $(this);
   var clickedNumber = $(this).index();
	if(clickedNumber > runningTmbNumber)
		{
			var przeskok = clickedNumber - runningTmbNumber;
			var przesun = slideWidth * przeskok;
			var i = 1;
			clicked.addClass("running");
         runningTmb.removeClass("running");
			//przesuniecie slajdu w prawo
			 ol.animate({'margin-left' : -przesun}, changeSlideTine, function(){
				 while (i <= przeskok) {
					var li = $(".galeria ol li");
				  li.last().after(li.first());
					 i++;
				 }
				  ol.css({'margin-left' : 0});
			 });
						
			
		    if(thumbsQua > 7)
    {
	 var moveThumb = thumbWidth * przeskok;
	 var x = 1;
    ul.animate({'margin-left' : -moveThumb}, changeSlideTine, function(){
		 while (x <= przeskok) {
			 var thumbLi = $(".thumbs ul li");
			 thumbLi.last().after(thumbLi.first());
			 x++;
		 }
    ul.css({'margin-left' : 0});
    });
    }	
			
		}
	if(clickedNumber < runningTmbNumber)
		{
			var przeskok = runningTmbNumber - clickedNumber;
			var przesun = slideWidth * przeskok;
			var i = 1;
			clicked.addClass("running");
         runningTmb.removeClass("running");
			//przesuniecie slajdu w lewo
			 ol.css('margin-left',-przesun);
				 while (i <= przeskok) {
					var li = $(".galeria ol li");
				  li.first().before(li.last());
					 i++;
				 }
				  ol.animate({'margin-left' : 0}, changeSlideTine);
			
			if(thumbsQua > 7)
    {
	var moveThumb = thumbWidth * przeskok;
	 var x = 1;
    ul.css('margin-left',-moveThumb);
		while (x <= przeskok) {
    var thumbLi = $(".thumbs ul li");
    thumbLi.first().before(thumbLi.last());
		x++;
		}
    ul.animate({'margin-left' : 0}, changeSlideTine);
    }
			 
		}
});

//Przesówanie zmiana slajdow
$(".galeria ol li").mousedown(function(wcisniecie){
$(".galeria ol li").draggable({ axis: "x" });
down = wcisniecie.clientX;
});

$(".galeria ol li").mouseup(function(puszczenie){
	
	var uping = puszczenie.clientX;
	if(down > uping)
		{
			var li = $(".galeria ol li");
    		ol.animate({'margin-left' : -898}, changeSlideTine, function(){
        li.last().after(li.first());
        ol.css({'margin-left' : 0});
        li.css({'left' : 0});
		});
			
			//thumby
    var runningTmb = $(".thumbs ul li.running");
    if(thumbsQua > 7)
    {
    runningTmb.next().addClass("running");
    runningTmb.removeClass("running");
    var thumbLi = $(".thumbs ul li");
    ul.animate({'margin-left' : -thumbWidth}, changeSlideTine, function(){
    thumbLi.last().after(thumbLi.first());
    ul.css({'margin-left' : 0});
    });
    }
    else
    {
       if(runningTmb.attr('name') == thumbsQua)
           {
            thumbFirst.addClass("running");
            runningTmb.removeClass("running");
           }
        else
            {
             runningTmb.next().addClass("running");
             runningTmb.removeClass("running");
            }
    }
			
		}
	if(down < uping)
		{
			var li = $(".galeria ol li");
    ol.css('margin-left',-slideWidth);
    li.first().before(li.last());
    ol.animate({'margin-left' : 0}, changeSlideTine);
    li.animate({'left' : 0}, changeSlideTine);
			
		var runningTmb = $(".thumbs ul li.running");
    if(thumbsQua > 7)
    {
    runningTmb.prev().addClass("running");
    runningTmb.removeClass("running");
    var thumbLi = $(".thumbs ul li");
    ul.css('margin-left',-thumbWidth);
    thumbLi.first().before(thumbLi.last());
    ul.animate({'margin-left' : 0}, changeSlideTine);
    }
    else
    {
        if(runningTmb.attr('name') == thumbFirst.attr('name'))
            {
              thumbLast.addClass("running");
              runningTmb.removeClass("running");
            }
        else
            {
               runningTmb.prev().addClass("running");
               runningTmb.removeClass("running");
            }
    }	
			
		}
});
    
})
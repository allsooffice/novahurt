//funkcja sortowania przzeciaganiem
function sort (){
$('#list').disableSelection().sortable({
update: function(event, ui) {
$.ajax({
url: 'php/replace_img.php',
data: $("form").serialize(),
type: 'POST',
success: function() 
{
    $(".pokaz").load("php/replace_img.php");
    $(".error-info").fadeOut(400);
}
    });
    }
    });
}  
//mechanizm dodawanie obrazu i wyswietlanie
$(document).ready(function (e) {
    
	$("#add-image-form").change('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "php/upload_img.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
            
			$(".image-place").load("php/img_display.php", function()
            {
                $(".loading").fadeOut();
                $(".info").load("php/upload_img.php");
                sort();
    	    });
            
            },
		  	error: function() 
	    	{
                
	    	}
            
	   });
        
	}));
  
});
//usuwanie obrazu
function trash(numer)  {
        $("#load"+numer).fadeIn(10);
        var url = "php/delete_img.php?id=" + numer;
        $.get(url);
        $("#img"+numer).fadeOut(400);        
        $(".error-info").fadeOut(400);        
    }
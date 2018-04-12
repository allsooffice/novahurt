//funkcja sortowania przzeciaganiem
function sort (){
$('.table').disableSelection().sortable({
update: function(event, ui) {
$.ajax({
url: 'php/replace_category.php',
data: $("form").serialize(),
type: 'POST',
success: function() 
{

}
    });
    }
    });
}  


$(document).ready(function (e) {
    sort();

  
});

$('#category').change(function()
{
   $('#category-form').submit();
 })
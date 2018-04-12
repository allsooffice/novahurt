//funkcja sortowania przzeciaganiem
function sort (){
$('.table').disableSelection().sortable({
update: function(event, ui) {
$.ajax({
url: 'php/replace_adv.php',
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
$(function () {
   $('#lang').change(function () {
       window.location = '/langs/change?lang=' + $(this).val();
   } )
});
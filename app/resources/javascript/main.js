$(document).ready(function(){

  $('#selectSortTask').change(function(e){

    e.preventDefault();

    var sortParam = $('#selectSortTask').val();

     $.ajax({
         url: $(this).attr('action'),
         type: "GET",
         data: {sort_task: sortParam},
         success: function(data){

            $('#response').fadeOut(200, function(){
                $('#response').empty().append(data).fadeIn();

            });
         },
         error: function(thrownError){
            alert(thrownError);
         }
    });
    return false;
  });


  $('#selectSortList').change(function(e){

    e.preventDefault();

    var sortParam = $('#selectSortList').val();

     $.ajax({
         url: $(this).attr('action'),
         type: "GET",
         data: {sort_list: sortParam},
         success: function(data){

            $('#container').fadeOut(200, function(){
                $('#container').empty().append(data).fadeIn();

            });
         },
         error: function(thrownError){
            alert(thrownError);
         }
    });
    return false;
  });

});

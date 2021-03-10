
///////////////////////////////////////////////////////////////////////////////////////////////////////////


function prob_view() {
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    $.ajax({
        
        url:'task/pre_task',
        data: new FormData($("#create_prob")[0]),
        dataType:'text',
        async:true,
        type:'post',
        processData: false,
        contentType: false,
        success:function(response){
            $('#pred_prob').html(response);
            $('#pred_lar').modal();
        },
    });

}


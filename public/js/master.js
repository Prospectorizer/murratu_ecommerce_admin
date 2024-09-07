

alert('inside master');

$(document).on('click','#master-ajax',function(e){
	$.ajax({
       type:'POST',
       url:'/master-edit',
       dataType:'json',
       data:{'type':'add'},
       success:function(data) {
          $("#msg").html(data.msg);
       }
    });
})
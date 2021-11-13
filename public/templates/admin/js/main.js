$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function RemoveRow(id,url)
{
        if(confirm('Xóa và không thể khôi phục lại. Bạn có chắc không?')){
        $.ajax({
            type:'delete',
            dataType:'json',
            data:{id},
            url:url,
            success:function(result){
                // console.log(result);
                if(result.error === false){
                    alert(result.message)
                    location.reload();
                } else {
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}
$(document).ready(function () {
    $(".deletebutton").click(function () {
        if(confirm("Delete?")){
            var id = $(this).attr('classurlname');
            var data = 'id=' + id;
            var thing = this;
            $.ajax({
                type: 'post',
                url: 'deleteclass',
                dataType: 'json',
                data: data,
                success: function(rdata, status){
                    $(thing).parents("div").eq(1).closest("div").remove();
                }
            });
        }
    });
});
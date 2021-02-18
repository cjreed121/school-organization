$(document).ready(function () {
    $(".deletebutton").click(function () {
        var id = $(this).attr('linkid');
        var thing = this;
        $.ajax({
            type: 'post',
            url: '../deletelink',
            dataType: 'json',
            data: {"id": id, "classid": $("#classname").attr("classid")},
            success: function(rdata, status){
                $(thing).parents("div").eq(1).closest('div').remove();
            }
        });
    });
});
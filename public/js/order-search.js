$(document).ready(function(){
    var og = $('#result2').html();
    $('#keyword').keyup(function(){
        console.log("keyup!");
        var txt = $(this).val();
        if(txt != "")
        {
            $.ajax({
                url:"order-search.php",
                method:"post",
                data:{search:txt},
                dataType:"text",
                success:function(data)
                {
                    $('#result2').html(data);
                }
            });
        }
        else
        {
            $('#result2').html(og);
        }
    });
});
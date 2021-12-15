
$(document).ready(function(){
    $('#keyword').keyup(function(){
        console.log("keyup!");
        var txt = $(this).val();
        if(txt != "")
        {
            $.ajax({
                url:"../page/fetch.php",
                method:"post",
                data:{search:txt},
                dataType:"text",
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
        else
        {
            $('#result').html('');
        }
    });
});

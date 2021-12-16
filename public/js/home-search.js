$(document).ready(function(){
    var og = $('#result2').html();
    //console.log(og);
    $('#keyword').keyup(function(){
        console.log("keyup!");
        var txt = $(this).val();
        if(txt != "")
        {
            $.ajax({
                url:"homepage.php",
                method:"post",
                data:{search:txt},
                dataType:"text",
                success:function(data)
                {
                    $('#result2').html(data);
                    //console.log($('#result2').html());
                    // UNCOMMENT THIS IF YOU WANT TO HAVE PAGE FRAGMENT 
                    // $arr = document.querySelectorAll(".res");
                    // $last_item = Math.min(10,$arr.length)

                    // for($i = 0; $i < $last_item; $i++) {
                    //     $arr[$i].classList.toggle("d-none")
                    // }
                }
            });
        }
        else
        {
            $('#result2').html(og);
        }
    });
});
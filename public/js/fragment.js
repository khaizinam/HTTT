$(document).ready(function(){
    console.log("alo");
    $arr = document.querySelectorAll(".res");
    $last_item = Math.min(10, $arr.length)

    for($i = 0; $i < $last_item; $i++) {
        $arr[$i].classList.toggle("d-none")
    }
})

function changePage($p){
$nItem = 10
$arr = document.querySelectorAll(".res");
$last_item = Math.min($nItem * $p,$arr.length)
$last_page = Math.ceil($arr.length / $nItem)
for($i = 0; $i < $arr.length; $i++) {
    $arr[$i].classList.add("d-none")
    if(Math.ceil(($i + 1) / $nItem) == $p)
    {
        $arr[$i].classList.remove("d-none")
    }
}
var e = ``;
if($p <= 3){
    for($i = 1; $i <= $last_page && $i <= 5; $i++){
        if($i == $p){
            e = e + "<li class='btn btn-primary active' onclick='changePage("+$i+")'>"+$i+"</li>"
        }
        else{
            e = e + "<li class='btn btn-primary' onclick='changePage("+$i+")'>"+$i+"</li>"
        }
    }
}
else if($p >= $last_page - 2){
    console.log("alo" + $last_page)
    for($i = $last_page - 6; $i <= $last_page ; $i++){
        if($i == $p){
            e = e + "<li class='btn btn-primary active' onclick='changePage("+$i+")'>"+$i+"</li>"
        }
        else{
            e = e + "<li class='btn btn-primary' onclick='changePage("+$i+")'>"+$i+"</li>"
        }
    }
}
else{
    for($i = $p - 2; $i <= $p + 2 ; $i++){
        if($i == $p){
            e = e + "<li class='btn btn-primary active'onclick='changePage("+$i+")'>"+$i+"</li>"
        }
        else{
            e = e + "<li class='btn btn-primary' onclick='changePage("+$i+")'>"+$i+"</li>"
        }
    }
}
document.querySelector("#PageFragment").innerHTML = e
}
document.getElementById("usrBtn").addEventListener("click", function(){
    $.get("index.php?controller=user&action=kill",
            function(data){
                $("html").html(data);
        });
});

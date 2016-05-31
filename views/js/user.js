document.getElementById("processSignIn").addEventListener("click", function(){
    var data;
    var some = getValuesSigIn();
    var statusForm = $.isNumeric(some);
    if(statusForm == true){
        var msg = "";
        switch(some){
            case 0:
                msg = "All fields must be filled";
                break;
            case 1:
                msg = "UserName must be  just numbers or letters";
                break;
            case 2:
                msg = "Name must be just letters";          
                break;
            case 3:
                msg = "Lastname must be just letters";
                break;
            case 4:   
                msg = "Password must be  just numbers or letters";
                break;
        }
        swal({
                title:'Woops!',
                text:  msg ,
                type: 'error',
                closeOnConfirm: true
            },
            function(){
            })

    }else{
        $.post( "/playlistYnot/index.php?controller=user&action=sign",
                some,
                function(data){
                    $("html").html(data);
                }
        );
    }
});

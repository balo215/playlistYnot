document.getElementById("processSignIn").addEventListener("click", function(){
    var data;
    var some = getValuesSigIn();
    var statusForm = $.isNumeric(some);
    if(statusForm == true){
        
    }
    $.post( "../index.php?controller=user&action=sign",
            some,
            function(data){
            }
    );
});

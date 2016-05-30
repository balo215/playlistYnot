function openTemplate(values){
    $.post( 
        "/playlistYnot/index.php?controller=list&action=join",
        values,
        function(data){
            if(data != 'false'){
                if(data != 1){
                    window.location.href = "views/plTemplate.php";
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }
    );

}

function deletePlaylist(id){
console.log(id);
    $.post("index.php?controller=user&action=deletePlaylist",
           {'id': id},
            function(data){
                location.reload();
            }
        );
}


document.getElementById("deleteAccount").addEventListener("click", function(){
    makeSure();
});

function makeSure(){
    swal({title: 'De verdad quieres BORRAR tu cuenta?',
          html: 'Estas muy MUY seguro?',
        closeOnConfirm: true,
        showCancelButton: true,
        closeOnCancel: true
     },function(isConfirm){
        if(isConfirm){
            $.get("index.php?controller=user&action=deleteUser",
                  function(data){
                    }
                 );

        }
     });
};

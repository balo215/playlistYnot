var join = document.getElementById("join");
join.addEventListener("click", function(){
    callJoinAlert();
});

function callJoinAlert(){
    swal({title: 'Join to playlist',
        html: '<p><input id="playlistName" placeholder="Name" required></p> '+
              '<label> Password: </label> <input type=checkbox id="pwdCB">' +
              '<p><input id="pwd" placeholder="Password" type=password hidden="hidden"></p>',
        closeOnConfirm: false,
        showCancelButton: true
     },
     function() {
         if($('#playlistName').val() != ""){
            swal.disableButtons();
            setTimeout(function(){
                var returnCode = 1;
                if(returnCode === 1){
                    swal({
                        title: "Enjoy it!",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                        });
                        window.location.href = "views/plTemplate.php";
                }else{
                    sweetAlert(
                               'Oops...',
                               'Something went wrong!',
                               'error'
                    )
                }
            }, 2000);
            
        }else{
            swal({
                title:'Woops!',
                text: 'You must write a name',
                type: 'error',
                closeOnConfirm: false
            }, 
            function(){
                callJoinAlert();
            })
        }
    })
    var pwdCB = document.getElementById("pwdCB");
    var passField = document.getElementById("pwd");
    pwdCB.addEventListener("click", function(){
        if(pwdCB.checked == false){
            passField.setAttribute("hidden", "hidden");
        }else{
            passField.removeAttribute("hidden");
        }
    });
};




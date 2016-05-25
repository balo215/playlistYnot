$(window).load(function(){

    document.getElementById("processSignIn").addEventListener("click", function(){
        addUser();
    });

    function addUser(){
        $.ajax({
            url:"/playlistYnot/controllers/UsersController.php",
            type: 'POST',
            data:{ "name": "new", "lastName":"user", "nick":"tobit", "pass":"you2", "email":"tobi2@hotmail.com" },
            success: function(response){
                console.log(response);
            }
        });
    }
});

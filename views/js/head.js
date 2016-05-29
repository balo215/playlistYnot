$(window).load(function(){
    document.getElementById("signUpBtn").addEventListener("click", function(){
        window.location.href = "/playlistYnot/views/signUp.php"; 
    });

    document.getElementById("lognBtn").addEventListener("click", function(){
        $.get( "/playlistYnot/index.php?controller=user&action=logForm",
                  function(data){
                      $("html").html(data);
                  }
              );
    });

});

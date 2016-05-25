$(window).load(function(){

    document.getElementById("userBtn").addEventListener("click", function(){
        $.get("index.php?controller=user&action=kill",
              function(){
                  console.log("killed");
                  window.location.reload();
              });
        
    });

});

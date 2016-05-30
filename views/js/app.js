function tplawesome(e,t){
    res=e;
    for(var n=0;n<t.length;n++){
        res=res.replace(/\{\{(.*?)\}\}/g,function(e,r){ return t[n][r]})
        
    }
    return res;
    
}
arreglo = [];
$(function() {
    $("#searchForm").on("submit", function(e) {
console.log("clicked");
       e.preventDefault();
       // prepare the request
       var request = gapi.client.youtube.search.list({
            part: "snippet",
            type: "video",
            q: encodeURIComponent($("#searchInput").val()).replace(/%20/g, "+"),
            maxResults: 5,
            order: "viewCount",
       }); 
       // execute the request
       request.execute(function(response) {
          var results = response.result;
          $("#results").html("");
          $.each(results.items, function(index, item) {
            $.get("item.html", function(data) {
                var url = item.id.videoId.replace(/[\"\']/g,'');
                var title = item.snippet.title.replace(/[\"\']/g, '');
                $("#results").append(tplawesome(data, [{"title":title, "image":item.snippet.thumbnails.default.url, "id":url}]));
            });
          });
          resetVideoHeight();
       });
    });    
    $(window).on("resize", resetVideoHeight);
});

function resetVideoHeight() {
    $(".video").css("height", $("#results").width() * 9/16);
}

window.onload = function init() {
    gapi.client.setApiKey("AIzaSyA5mmyKsmb5nZiCufGZUHgHE-ChjIwieVY");
    gapi.client.load("youtube", "v3", function() {
    });
}

function addVideo(id, image, title){
    createQueuedVideos(id, image, title);
    arreglo.push(title={"id":id,"img":image,"title":title});
    $.post("../index.php?controller=list&action=addSong",
            {'id': id},
            function(data){
                console.log(data);
            }
        );
}

function addSavedVideos(id, image, title){
    createQueuedVideos(id, image, title);
    arreglo.push(title={"id":id,"img":image,"title":title});
}


function createQueuedVideos(id, image, title){
    var div             = document.createElement("div");
    var divForLabel     = document.createElement("div");
    var img             = document.createElement("img");
    var label           = document.createElement("label");
    var p               = document.createElement("p");
    var span            = document.createElement("span");
    p.className         = "btn btn-danger btn-xs";
    span.className      = "glyphicon glyphicon-trash";
    p.addEventListener("click", function(){
        deleteVideo(this.parentElement);
    });
    div.style.textAlign = "left";
    div.style.display   = "flex";
    div.id              = id;
    div.style.padding   = "10px";
    p.style.height      = "24px";
    img.src             = image;
    label.innerHTML     = title;
    div.appendChild(img);
    divForLabel.appendChild(label);
    p.appendChild(span);
    div.appendChild(divForLabel);
    div.appendChild(p);
    document.getElementById("queuedVideos").appendChild(div);
    document.getElementById("next").removeAttribute("disabled");

}

function deleteVideo(element){
    for(var single in arreglo){
        if(arreglo[single]["id"] == element.id){
            if(single < i){
                i--;
            }
            arreglo.splice(single, 1);
            element.remove();
            return;
        }
    }
}


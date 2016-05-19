function tplawesome(e,t){
    res=e;
    for(var n=0;n<t.length;n++){
        res=res.replace(/\{\{(.*?)\}\}/g,function(e,r){ return t[n][r]})
        
    }
    return res;
    
}
arreglo = [];
$(function() {
    $("form").on("submit", function(e) {
       e.preventDefault();
       // prepare the request
       var request = gapi.client.youtube.search.list({
            part: "snippet",
            type: "video",
            q: encodeURIComponent($("#searchInput").val()).replace(/%20/g, "+"),
            maxResults: 5,
            order: "viewCount",
//            publishedAfter: "2015-01-01T00:00:00Z"
       }); 
       // execute the request
       request.execute(function(response) {
          var results = response.result;
          $("#results").html("");
          $.each(results.items, function(index, item) {
            $.get("item.html", function(data) {
                $("#results").append(tplawesome(data, [{"title":item.snippet.title, "image":item.snippet.thumbnails.default.url, "id":item.id.videoId}]));
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
                console.log(i);
            }
            arreglo.splice(single, 1);
            element.remove();
            return;
        }
    }
}

function fillPlayList(playlist){
    for(var single in playlist){
        createQueuedVideos(playlist[single].id, playlist[single].image, playlist[single].title)
    }
}

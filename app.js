function tplawesome(e,t){
    res=e;
    for(var n=0;n<t.length;n++){
        res=res.replace(/\{\{(.*?)\}\}/g,function(e,r){ return t[n][r]})
        
    }
    return res
}
playlist =  [];
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
            $.get("item1.html", function(data) {
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
    playlist.push(id);
    createQueuedVideos(image, title);
    console.log(document.getElementById("queuedVideos").childNodes);
}

function createQueuedVideos(image, title){
    var div             = document.createElement("div");
    var divForLabel     = document.createElement("div");
    var img             = document.createElement("img");
    var label           = document.createElement("label");
    div.style.textAlign = "left";
    div.style.display   = "flex";
    div.style.padding   = "10px";
    img.src             = image;
    label.innerHTML     = title;
    div.appendChild(img);
    divForLabel.appendChild(label);
    div.appendChild(divForLabel);
    document.getElementById("queuedVideos").appendChild(div);
    document.getElementById("next").removeAttribute("disabled");
}

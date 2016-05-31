var tag = document.createElement('script');

tag.src = "http://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('principalVideo', {
        height: '390',
        width: '640',
        videoId: 'amZLLYqjyKQ',
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

      // 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    event.target.playVideo();
}
document.getElementById("next").addEventListener("click", function(){
    var element = document.getElementById("queuedVideos").childNodes[i+1];       
    element.style.background = "rgba(51,122,183,.53)";
    player.cueVideoById({videoId:arreglo[i].id,
                         startSeconds:0
    })
    player.playVideo();
    i++;
    if(i >= arreglo.length){
        document.getElementById("next").setAttribute("disabled", "disabled");
    }
    if(i > 1){
        var prevElement = document.getElementById("queuedVideos").childNodes[i-1];
        prevElement.style.background = "white";
    }
    document.getElementById("prev").removeAttribute("disabled");

});

document.getElementById("prev").addEventListener("click", function(){
    var element = document.getElementById("queuedVideos").childNodes[i-1];
    element.style.background = "rgba(51,122,183,.53)";
    player.cueVideoById({videoId:arreglo[i-2].id,
                         startSeconds:0
    })
    player.playVideo();
    i--;
    if(i == 1){
        document.getElementById("prev").setAttribute("disabled", "disabled");
    }
    document.getElementById("next").removeAttribute("disabled");
    var prevElement = document.getElementById("queuedVideos").childNodes[i+1];
    prevElement.style.background = "white";
});

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
var i = 0;
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.ENDED && i == arreglo.length) {
        setTimeout(stopVideo, 600);
        if(arreglo.length > 0){
            var prevElement = document.getElementById("queuedVideos").childNodes[i];
            prevElement.style.background = "white";
        }
        i=0;
    }
    if(event.data == YT.PlayerState.ENDED && i < arreglo.length){
        var element = document.getElementById("queuedVideos").childNodes[i+1];
        element.style.background = "rgba(51,122,183,.53)";
        player.cueVideoById({videoId:arreglo[i].id,
                   startSeconds:0      
        })
        i++;
        if(i > 1){
            var prevElement = document.getElementById("queuedVideos").childNodes[i-1];
            prevElement.style.background = "white";
        }
        event.target.playVideo();

    }
}
function stopVideo() {
    player.stopVideo();
}

function getPlaylistDetails(){
    $.get(
         "../index.php?controller=list&action=details",
         function(dat){
            var playlist = JSON.parse(dat);
            document.getElementById("title").innerHTML = playlist['name'];
            if(playlist["logued"] == true){
                document.getElementById("logSection_2").removeAttribute("hidden");
                document.getElementById("logSection_2").style.display = "inline-block";
                document.getElementById("logSection_1").remove();
                document.getElementById("userBtn").value = playlist['email'];
                document.getElementById("userBtn").innerHTML = playlist['email'];
            }else{
                document.getElementById("logSection_1").removeAttribute("hidden");
                document.getElementById("logSection_1").style.display = "inline-block";
                document.getElementById("logSection_2").remove();
            }
            var songs = playlist['canciones'].substring(1, playlist['canciones'].length-1);
            fillPlayList(songs.split(','));
        }
    );
}

function fillPlayList(playlist){
    var singleVideo;
    for(var single in playlist){
console.log(playlist[single]);
        $.ajax({
            url:"https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" + playlist[single] + "&key=AIzaSyA5mmyKsmb5nZiCufGZUHgHE-ChjIwieVY",
            type: "get",
            async: false,
            success: function(data){
                singleVideo = data.items[0].snippet;
                addSavedVideos(playlist[single], singleVideo['thumbnails']['default']['url'], singleVideo['title']);
            }
        });
    }
}

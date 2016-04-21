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

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var i = 0;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.ENDED && i == playlist.length) {
            setTimeout(stopVideo, 600);
            if(playlist.length > 0){
                var prevElement = document.getElementById("queuedVideos").childNodes[i];
                prevElement.style.background = "white";
            }
            i=0;
        }
        if(event.data == YT.PlayerState.ENDED && i < playlist.length){
            var element = document.getElementById("queuedVideos").childNodes[i+1];
            element.style.background = "rgba(51,122,183,.53)";
            player.cueVideoById({videoId:playlist[i],
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
//        if(playlist[0] != null){
//            player.cueVideoById({videoId:playlist[0],
//                     startSeconds:0      
//                     })
//            playlist.splice( 0, 1 );
//            console.log("inside function");
//        }else{
            player.stopVideo();
//            done = false;
//        }
      }

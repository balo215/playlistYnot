<?php
include_once "headerT.html";
?>
<div class="row">
    <h2 id="title">{{TITLE}}</h2>
<aside id="videoSection"  class="col-md-4 col-lg-4">
    <div class="panel panel-primary"> 
        <div class= "panel-heading">
            <h4 class="panel-title"> Video title </h4>
        </div>

        <div id="principalVideo">
        </div>
    </div>
    <button id="prev"> prev </button>
    <button id="next"> next </button>
    <div id="queuedVideos">
    </div>
</aside>           
<section id="searchSection" class="col-md-4 col-lg-4">
    <div id="searchFields">
        <form id="searchForm"  action="#">
            <input placeholder="Search Something..." id="searchInput"> </input>
            <input type="submit" value="Search" id="searchBtn" class="btn btn-lg btn-danger"> 
        </form>
    </div>
    <div id="results">
    </div>
</section>
<aside id="chatSection"  class="col-md-4 col-lg-4">
    <div id="comments">
        <p>
            some stuff to make things looks better anyway nobody reads this, so lets talk about nonsense stuff like some nonimportant stuff
        </p>
    </div>
    <div id="chat">
        <textarea id="chatArea">
        </textarea>
        <input id="messageInput">
        <button value="submit" id="submit" class="btn btn-info"> Submit </button>
    </div>
</aside>
</div>
</div>
<?php
    require_once "footer.html";
?>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://apis.google.com/js/client.js?onload=init"></script>
<script src="js/app.js"></script>
<script src="js/video.js"></script>
<script> getPlaylistDetails();</script>

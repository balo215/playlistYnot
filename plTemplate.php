<?php
    include_once "header.html";
?>
    <body>
        <div id="container">
        <header>
            <h2>Tittle</h2>
        </header>
        <aside id="videoSection">
            <div> 
                <iframe width="336" height="252"
                    src="http://www.youtube.com/embed/amZLLYqjyKQ?playlist=8jL2DPylmhE">
                    <!--El segundo video despues de 'playlist=' sera reemplazado con JS para de esta manera
                        dinamicamente ir agregando videos con la API de youtube -->
                </iframe>
            </div>
            <div id="queuedVideos">
                <img src="thumbnail.jpg"> <label><strong> Video tittle </strong></label> 
            </div>
        </aside>           
        <section id="searchSection">
            <div id="searchFields">
                <input placeholder="Search Something..." id="searchInput"> </input>
                <input type="button" value="Search" id="searchBtn" class="btn btn-lg btn-danger"> 
            </div>
            <div id="results">
                 <img src="thumbnail.jpg"> <label><strong> Video tittle </strong></label> 
                <!--La linea anterior sera reemplazada con jQuery usando la api de youtube, esto porque
                    es mas sencillo manipular el objeto que obtenemos al hacer la busqueda del video
                    asi generamos el thumnail y el titulo automaticamente, solo para ubicarlo dentro del div 
                -->

            </div>
        </section>
        <aside id="chatSection">
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
    </body>

</html>
<?php require_once "header.html"; ?>
        <div class="row">
            <section class="col-md-3 col-lg-3" >
                <h2> {USER} </h2>
                <div id="list">
                    <table border=”1″>
                        <tr>
                            <th> Nombre </th>
                            <th> Ultima Adicíon </th>
                            <th> Eliminar¿? </th>
                        </tr>
                        <tr>
                            <td> {{NAME}}</td>
                            <td> {{DATE}}</td>
                            <td> <p class="btn btn-danger btn-s" id="playlist_{{ID}}" onclick='deletePlaylist({{ID}});'> <span class="glyphicon glyphicon-trash"> </p></span>
                        </tr>
                    </table>    
                </div>
            <button id="logOut" onclick="location.href='index.php?controller=user&action=kill'"> Log Out </button>
            </section>
        </div>
        <p>
            <button class="btn btn-lg btn-danger" id="deleteAccount" style="width:initial;margin-top:50px"> Borrar Cuenta!!! </button>
        </p>
    </div>
</body>
<script src="views/js/userButton.js"></script>
<?php require_once "footer.html"; ?>

<?php
    include_once "header.html";
?>
            <div class="row">
                <aside class="col-md-2 col-lg-2">
                    <div class="panel panel-primary">
                         <div class= "panel-heading">
                            <h4 class="panel-title"> List tittle </h4>
                         </div>
                         <ul>
                            <li><a href="#"> electroMusic </a> </li>
                            <li><a href="#"> ejemplo </a> </li>
                            <li><a href="#"> tutos </a> </li>
                        </ul>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title"> List tittle2 </h4>
                        </div>
                        <ul>
                            <li><a href= "#"> deadmau5 </a> </li>
                            <li><a href="#"> adam k </a> </li>
                            <li><a href="#"> bt </a></li>
                        </ul>
                    </div>
                </aside>
    
                <section class="col-md-5 col-lg-5" id="about">
                    <form class="form-login" action="/playlistYnot/index.php?controller=user&action=login" method="post" id="login" name="log">
                        <div class="signUpSection" id="login">
                            <h3> Log in</h3>
                            <p>    
                                <input id="inputEmail" type="email" name="email" placeholder="User" class="form-control">
                            </p>
                            <p>
                            <p>
                                <input id="inputPwd" type="password" name="pass" placeholder="password" class="form-control">
                            </p>
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="submit">
                        </div>
                     </form>
                </section>
            </div>
        </div>   
    </body>
<?php
    require_once "footer.html";
?>

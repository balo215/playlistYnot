function getValuesSigIn(){
    var username = document.getElementById("user").value;
    var name = document.getElementById("name").value;
    var lastname = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    if(username == "" || name == "" || lastname == "" || email == "" || password == ""){
        return 0;
    }
    var pat = /[^a-zA-Z0-9+$]/g
    if(pat.test(username)){
        return 1;
    }
    pat = /[^a-zA-Z+$]/g
    if(pat.test(name)){
        return 2;
    }
    pat = /[^a-zA-Z+$]/g
    if(pat.test(lastname)){
        return 3;
    }
    pat = /[^a-zA-Z0-9+$]/g
    if(pat.test(password)){
        return 4;
    }
    var data ={
                "username": username,
                "name": name,
                "lastname": lastname,
                "email":email,
                "password":password
                };
    return data;
}
function getPlaylistValues(name, pass){
    console.log(name + "heeeeeeere");
    var data = {
                    "name": name,
                    "password":pass
                }
    return data;
}

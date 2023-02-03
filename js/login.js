function login(){
    event.preventDefault()
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var request= new XMLHttpRequest();
    var url= "http://localhost:3000/php/login.php";
    var val="email="+email+"&password="+password;
    request.open("POST", url, true);
    request.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    request.send(val);
    request.onload=function(){
        
        var result = request.response;
        var res=result.trim();
        console.log(res)
        if(res == 'Correct password'){
            localStorage.setItem('email',email);
            alert(res);
            window.location.href='./profile.html'
        } else if(res == 'Check password'){
            alert(res);
        } else {
            alert('User does not exist, please register');
        }
    }
}
function register(){
    event.preventDefault();
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    
    var request= new XMLHttpRequest();
    var url= "http://localhost:3000/php/register.php";
    var val="firstName="+firstName+"&lastName="+lastName+"&email="+email+"&password="+password;
    request.open("POST", url, true);
    request.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    request.send(val);
    request.onload=function(){
        var result=request.response;
        var res=result.trim();
        console.log(res);
        if(res == 'Successfully registered'){
            alert('Successfully registered');    
            document.getElementById('firstName').innerHTML="";
            document.getElementById('lastName').innerHTML="";
            document.getElementById('email').innerHTML="";
            document.getElementById('password').innerHTML="";
            window.location.href='./index.html';
        } else {
            alert("User already exists, try again with another email");
        }

    }
}
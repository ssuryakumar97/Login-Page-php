
var email=localStorage.getItem('email');

document.getElementById('email').value= email;

function getdata(){
 event.preventDefault();


var designation = document.getElementById('designation').value;
var dateofbirth = document.getElementById('dateofbirth').value;
var contact = document.getElementById('contact').value;


var request = new XMLHttpRequest();
var url = "http://localhost:3000/php/profile.php";
var val = "email="+email+"&designation="+designation+"&dateofbirth="+dateofbirth+"&contact="+contact;
request.open('POST', url, true);
request.setRequestHeader("content-type", "application/x-www-form-urlencoded");
request.send(val);
request.onload = function() {
    var res = JSON.parse(request.response);
    console.log(res);
    alert(res.insertStatus);
}

}

function logout(){
    event.preventDefault();
    localStorage.removeItem('email');
    window.location.href="../index.html"
}
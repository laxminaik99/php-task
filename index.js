var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

function check(){
    var username=document.getElementById("username").value.toLowerCase();
    var password=document.getElementById("password").value.toLowerCase();

    if(username == "" && password == ""){
        document.getElementById("status").innerHTML="Please Enter the Credentials";
        
    }else if(username == "" && password != "")
    {
        document.getElementById("username").style.border = "1px outset red";
        document.getElementById("username").focus();
        document.getElementById("status").innerHTML="Please Enter Username";
    }else if(username != "" && password == ""){
        document.getElementById("password").style.border = "1px outset red";
        document.getElementById("password").focus();
        document.getElementById("status").innerHTML="Please Enter Password";

    }
    
}

function cleardata(){  

    document.getElementById("username").style.border = "1px outset black";
    document.getElementById("password").style.border = "1px outset black";
    document.getElementById("status").innerHTML="";

}

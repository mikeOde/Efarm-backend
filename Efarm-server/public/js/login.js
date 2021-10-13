$("document").ready(function(){
    var emailValid;
    var passwordValid;

    $("#submit_form").click(function(){
        validateEmail();
        passwordLength();
        if(emailValid && passwordValid){
            $("#loginForm").submit();
        }
    })

    function validateEmail(){
        var emailValue = $("#email").val();
        if (
            emailValue.length > 5 &&
            emailValue.lastIndexOf(".") > emailValue.lastIndexOf("@") &&
            emailValue.lastIndexOf("@") != -1
          ) {
            emailValid = true;
        }else{
            emailValid = false;
            alert("Enter a valid Email");
        }
    }

    function passwordLength(){
        var pass = $("#password").val();
        if(pass.length < 8){
            passwordValid = false;
            alert("Password must be at least 8 characters");
        }else{
            passwordValid = true;
        }
    }
})
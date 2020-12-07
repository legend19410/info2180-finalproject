import login from './login.js';
export default function addUser(element){

    element.addEventListener("click", ()=>{

        const request = new XMLHttpRequest();
        let key = "new-user=query";
        request.onreadystatechange = function(){
            //response from the server may be 404,403, 401
    

            if(request.readyState === 4){
                let respObj = JSON.parse(this.responseText);
                if(request.status === 200){
                    const main = document.querySelector("main");
                    if(respObj["loggedIn"]){
                        main.innerHTML = respObj['message'];
                        onSubmitNewUser();
                    }
                }
                if(request.status === 404){
                    //msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                }
            }
        }
        request.open('GET', 'controller/controller.php?'+key, true);
        //request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send();
    });
}

function onSubmitNewUser(){
    let submitBtn = document.getElementById('submit-new-user-btn');
    let firstname = document.getElementById('new-firstname');
    let lastname = document.getElementById('new-lastname');
    let password = document.getElementById('new-password');
    let email = document.getElementById('new-email');

    if(submitBtn){
        submitBtn.addEventListener('click', function(){
            const request = new XMLHttpRequest();
            let response = document.getElementById('response');
            let firstnameError = document.getElementById('firstname-error');
            let lastnameError = document.getElementById('lastname-error');
            let emailError = document.getElementById('email-error');
            let passwordError = document.getElementById('password-error');

            request.onreadystatechange = function(){
                if(request.readyState === 4){
                    let respObj = JSON.parse(this.responseText);
                    if(request.status === 200){
                        response.innerText = respObj['message'];
                    }
                }
            };

            let isValid = true;

            if (firstname.value === "" || firstname.value === null){
                isValid = false;
                firstnameError.innerText = "Enter the user's firstname";
            }
            else{
                firstnameError.innerText = "";
            }

            if (lastname.value === "" || lastname.value === null){
                isValid = false;
                lastnameError.innerText = "Enter the user's lastname";
            }
            else{
                lastnameError.innerText = "";
            }

            if (email.value === "" || email.value === null){
                isValid = false;
                emailError.innerText = "Enter the user's email";
            }
            else{
                emailError.innerText = "";
            }

            let regEx = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[0-9a-zA-Z]{7,}/;

            if(!regEx.test(password.value)){

                isValid = false;
                passwordError.innerText = "Password must be at least 8 characters long and needs to have at least one lowercase letter, one uppercase letter and one digit";
            }
            else{
                passwordError.innerText = "";
            }

            if (isValid){
                let body = "firstname="+firstname.value+"&lastname="+lastname.value+"&email="+email.value+"&password="+password.value;
                request.open('POST', 'controller/controller.php', true);
                request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                request.setRequestHeader('Accept', 'application/json');
                request.send(body);
            }
        });
    }
}
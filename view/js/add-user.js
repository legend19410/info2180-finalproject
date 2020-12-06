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
                    else{
                        main.innerHTML = respObj['message'];
                        let loginButto = document.querySelector("#login_button");
                        login(loginButto);
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

    submitBtn.addEventListener('click', function(){
        const request = new XMLHttpRequest();
        let body = "firstname="+firstname.value+"&lastname="+lastname.value+"&email="+email.value+"&password="+password.value;
        let response = document.getElementById('response');

        request.onreadystatechange = function(){
            if(request.readyState === 4){
                let respObj = JSON.parse(this.responseText);
                if(request.status === 200){
                   response.innerText = respObj['message'];
                }
            }
        };
        request.open('POST', 'controller/controller.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.setRequestHeader('Accept', 'application/json');
        request.send(body);
    });
}
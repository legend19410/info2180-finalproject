import login from './login.js';
import addIssue from './add-new-issue.js';
import home from './home.js';
import addUser from './add-user.js';
import logout from './logout.js';

document.addEventListener("DOMContentLoaded", function(){
    
    const loginButton = document.querySelector("#login_button");

    const addNewIssue = document.getElementById('new-issue-link');
    const homeLink = document.getElementById('home-link');
    const addUserLink = document.getElementById('add-user-link');
    const logoutLink = document.getElementById('logout-link');

    
    const request = new XMLHttpRequest();
    loadPage(request,  "index=query");

    login(loginButton);
    addIssue(addNewIssue);
    home(homeLink);
    addUser(addUserLink);
    logout(logoutLink);

});

//added load page function
//this would dynamically request the main view  regardless of
//being previously logged in or not
function loadPage(request, key){
        
    request.onreadystatechange = function(){
        // console.log(request.responseText)
        if(request.readyState === 4){
            if(request.status === 200){
                console.log(request.responseText)
                const main = document.querySelector("main");
                main.innerHTML = request.responseText;

            }
            if(request.status === 404){
            
            }
        }
    };
    request.open('GET', 'controller/controller.php?'+key, true);
    request.send();
}
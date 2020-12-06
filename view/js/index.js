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
    
    const views={"addIssue": addNewIssue, "home": homeLink,"addUser": addUserLink}

    addIssue(addNewIssue);
    home(homeLink);
    addUser(addUserLink);
    logout(logoutLink);

    const request = new XMLHttpRequest();
    loadPage(request,  "index=query", views);


});

//added load page function
//this would dynamically request the main view  regardless of
//being previously logged in or not
function loadPage(request, key, views){
    const main = document.querySelector("main");
        
    request.onreadystatechange = function(){
        console.log(request.responseText)
        if(request.readyState === 4){
            let respObj = JSON.parse(request.responseText);
            if(request.status === 200){
                if (respObj['loggedIn']){
                    console.log(views[respObj["view"]]);
                    views[respObj["view"]].click();
                }
                else{
                    main.innerHTML = respObj['message'];
                    const loginButton = document.querySelector("#login_button");
                    login(loginButton);
                }
            }
            if(request.status === 404){
            
            }
        }
    };
    request.open('GET', 'controller/controller.php?'+key, true);
    request.send();
}
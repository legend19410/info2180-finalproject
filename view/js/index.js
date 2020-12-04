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

    login(loginButton);
    addIssue(addNewIssue);
    home(homeLink);
    addUser(addUserLink);
    logout(logoutLink);


});
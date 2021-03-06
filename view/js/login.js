import {loadTableWithAllIssues} from './home.js';
import {addEventListenersToTableFilters} from './home.js';

export default function login(element){

    element.addEventListener('click', () =>{

        const email = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;
        const request = new XMLHttpRequest();
        let key = "email="+email+"&password="+password;
        sendRequest(request, key);

    });
}

export function sendRequest(requestObj, key=""){
        
    requestObj.onreadystatechange = () => {
    
        console.log(requestObj.responseText);

        if(requestObj.readyState === 4){
            let respObj = JSON.parse(requestObj.responseText);
            let msgArea = document.querySelector("#login .error_msg");
            if(requestObj.status === 200){
                if(respObj["loggedIn"]){
                    const main = document.querySelector("main");
                    main.innerHTML = respObj['message'];
                    addEventListenersToTableFilters();
                    loadTableWithAllIssues('all-btn');
                }
                else{
                    msgArea.innerHTML = respObj['message'];
                }
            }else if(requestObj.status === 404){
                msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                
            }
        }
    }

    requestObj.open('GET', 'controller/controller.php?'+key, true);
    requestObj.send();

}


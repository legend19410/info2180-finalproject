import login from './login.js';
export default function home(element){
    
    element.addEventListener("click",()=>{
        const request = new XMLHttpRequest();
        let key = "home-view=query";
        const main = document.querySelector('main');

        request.onreadystatechange = function(){

            console.log(request.responseText);
            if(request.readyState === 4){
                let respObj = JSON.parse(request.responseText);
                if(request.status === 200){
                    if(respObj["loggedIn"]){
                        main.innerHTML = respObj['message'];
                        loadTableWithAllIssues();
                    }
                    else{
                        main.innerHTML = respObj['message'];
                        const loginButton = document.querySelector("#login_button");
                        login(loginButton);
                    }
                }
                else if(request.status === 404){
                    // msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                }
            }
        }
        request.open('GET', 'business_logic/controller.php?'+key, true);
        request.send();
    });
}

export function loadTableWithAllIssues(){

    const homeBody = document.querySelector("#home .home-body");
    const request = new XMLHttpRequest();
    let key = "allIssues=query";
    request.onreadystatechange = function(){

        console.log(request.responseText)
        if(request.readyState === 4){
            if(request.status === 200){
                
                homeBody.innerHTML = request.responseText;
                addEventListenersToTableElements();
            }
            if(request.status === 404){
                // msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
            }
        }
    };
    request.open('GET', 'business_logic/controller.php?'+key, true);
    request.send();
}

function addEventListenersToTableElements(){
    
    const tableBody = document.querySelectorAll('tbody > * ');
    console.log(tableBody)

    tableBody.forEach(ele => {
        ele.addEventListener('click', (event)=>{
            event.stopPropagation();
            const main = document.querySelector("main");
            const request = new XMLHttpRequest();
            let key = "issue="+ele.id;
            request.onreadystatechange = function(){

                console.log(request.responseText)
                if(request.readyState === 4){
                    if(request.status === 200){
                        
                        main.innerHTML = request.responseText;
                        
                    }
                    if(request.status === 404){
                        // msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                    }
                }
            };
            request.open('GET', 'business_logic/controller.php?'+key, true);
            request.send();
        });
    });
}
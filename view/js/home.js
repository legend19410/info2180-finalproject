import addIssue from './add-new-issue.js';
import login from './login.js';


export default function home(element){
    element.addEventListener("click",()=>{
        const request = new XMLHttpRequest();
        let key = "home-view=query";
        const main = document.querySelector('main');
        
        request.onreadystatechange = function(){
            console.log(request.responseText)
            if(request.readyState === 4){
                console.log(request.responseText);
                let respObj = JSON.parse(request.responseText);
                if(request.status === 200){
                    if(respObj["loggedIn"]){
                        main.innerHTML = respObj['message'];
                        loadTableWithAllIssues('all-btn');
                        addEventListenersToTableFilters();
                    }
                    else{
                        document.innerHTML = respObj['message'];
                        const loginButton = document.querySelector("#login_button");
                        login(loginButton);
                    }
                }
                else if(request.status === 404){
                    // msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                }
            }
        }
        request.open('GET', 'controller/controller.php?'+key, true);
        request.send();
    });
}

export function loadTableWithAllIssues(value){

    const homeBody = document.querySelector("#home .home-body");
    const request = new XMLHttpRequest();
    let key = "issues="+value;
    request.onreadystatechange = function(){

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
    request.open('GET', 'controller/controller.php?'+key, true);
    request.send();
}

function addEventListenersToTableElements(){
    
    const tableBody = document.querySelectorAll('tbody > * ');

    tableBody.forEach(ele => {
        ele.addEventListener('click', (event)=>{
            event.stopPropagation();
            const main = document.querySelector("main");
            const request = new XMLHttpRequest();
            let key = "issues=single-issue&issue-id="+ele.id;
            request.onreadystatechange = function(){

                if(request.readyState === 4){
                    if(request.status === 200){
                        
                        main.innerHTML = request.responseText;
                        addEventListenersToMarkButtons(ele.id);
                        
                    }
                    if(request.status === 404){
                        // msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                    }
                }
            };
            request.open('GET', 'controller/controller.php?'+key, true);
            request.send();
        });
    });
}

export function addEventListenersToTableFilters(){
    let homeButtons = document.querySelectorAll('.home-btn');
    
    homeButtons.forEach(element => {
        if(element.id === 'create-issue-btn'){
            addIssue(element);
        }
        else{
            element.addEventListener('click',()=>{
            loadTableWithAllIssues(element.id);    
            });
        }
    });
}

function addEventListenersToMarkButtons(id){
    let closedBtn = document.getElementsByClassName('mark-close-btn')[0];
    let progressBtn = document.getElementsByClassName('mark-progress-btn')[0];

    closedBtn.addEventListener('click', function(event){
        event.stopPropagation();
        const request = new XMLHttpRequest();
        const main = document.querySelector("main");
        let key = "close-issue="+id;
        request.onreadystatechange = function(){

            if(request.readyState === 4){
                if(request.status === 200){
                    main.innerHTML = request.responseText;  
                    addEventListenersToMarkButtons(id);    
                }
                if(request.status === 404){
                    // msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                }
            }
        };
        request.open('GET', 'controller/controller.php?'+key, true);
        request.send();
    });

    progressBtn.addEventListener('click', function(event){
        event.stopPropagation();
        const request = new XMLHttpRequest();
        const main = document.querySelector("main");
        let key = "progress-issue="+id;
        request.onreadystatechange = function(){

            if(request.readyState === 4){
                if(request.status === 200){
                    main.innerHTML = request.responseText; 
                    addEventListenersToMarkButtons(id);     
                }
                if(request.status === 404){
                    // msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                }
            }
        };
        request.open('GET', 'controller/controller.php?'+key, true);
        request.send();
    });
}
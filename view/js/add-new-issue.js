import login from './login.js';
export default function addIssue(element){

    element.addEventListener("click", function(){
        const request = new XMLHttpRequest();
        let key = "add_issue=yes";

        request.onreadystatechange = function(){
            //response from the server may be 404,403, 401

            if(request.readyState === 4){
                // console.log(this.responseText);
                let respObj = JSON.parse(this.responseText);
                if(request.status === 200){
                    const main = document.querySelector("main");
                    if(respObj["loggedIn"]){
                        main.innerHTML = respObj['message'];
                        loadUsersInForm(respObj['users']);
                        onSubmitNewIssue();
                    }
                }
                if(request.status === 404){
                    msgArea.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                }
            }
        }
        request.open('GET', 'controller/controller.php?'+key, true);
        //request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send();
    });

}

function onSubmitNewIssue(){
    const submitIssue = document.getElementById('submit-issue-btn');
    submitIssue.addEventListener("click", function(){
        let title = document.getElementById('title').value;
        let description = document.getElementById('description').value;
        let assignedTo = document.getElementById('assigned_to').value;
        let type = document.getElementById('type').value;
        let priority = document.getElementById('priority').value;
        let titleError = document.getElementById('title-error');
        let descriptionError = document.getElementById('description-error');
        const request = new XMLHttpRequest();

        request.onreadystatechange = function(){
            if(request.readyState === 4){
                let respObj = JSON.parse(this.responseText);
                if(request.status === 200){
                    if(respObj["status"]){
                        const msg = document.querySelector(".msg");
                        msg.innerHTML = respObj['message'];
                        msg.style.color = '#00AA00';//green
                    }
                    else{
                        msg.innerHTML = respObj['message'];
                    }
                }
                if(request.status === 404){
                    msg.innerHTML = "404 ERROR PAGE COULD NOT BE FOUND"; 
                }
            }
        };

        let isValid = true;

        if (title === "" || title === null){
            isValid = false;
            titleError.innerText = "Enter the issue title";
        }
        else{
            titleError.innerText = "";
        }

        if (description === "" || description === null){
            isValid = false;
            descriptionError.innerText = "Enter the issue description";
        }
        else{
            descriptionError.innerText = "";
        }

        if(isValid){
            let key = "title="+title+"&description="+description+"&assigned_to="+assignedTo+"&type="+type+"&priority="+priority;
            request.open('POST', 'controller/controller.php', true);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.setRequestHeader('Accept', 'application/json');
            request.send(key);
        }
    });
}

function loadUsersInForm(users){

    const assignedToField = document.getElementById('assigned_to');
    let userList = JSON.parse(users);
    let option;
    userList.forEach(element => {
        option = document.createElement('option');
        option.textContent = element.firstname+" "+element.lastname;
        option.value = element.id;
        assignedToField.appendChild(option);
    });


}
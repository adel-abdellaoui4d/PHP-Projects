const form = document.querySelector("form");
statusTxt = form.querySelector('.button-area span');

form.onsubmit = (e)=>{
    e.preventDefault();
    statusTxt.style.display = "block";
    statusTxt.style.color = "#0D6EFD";

    let xhr = new XMLHttpRequest();
    xhr.open("POST","message.php",true);
    
    xhr.onload = ()=>{ //once ajax loaded
        if(xhr.readyState = 4 && xhr.status==200){
            let response = xhr.response;
            if(response.indexOf("Email and password field is required ")!= -1 || response.indexOf("Enter a valid email address !")!= -1 || response.indexOf("Sorry, failed to send your message !")!= -1){
                statusTxt.style.color = "red";
            }else {
                form.reset();
                setTimeout(()=>{
                statusTxt.style.display = "none";
                }, 3000);
            }
            statusTxt.innerText = response ;
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}





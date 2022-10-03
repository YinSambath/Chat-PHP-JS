const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault(); //preventing form from submitting 
}

continueBtn.onclick = () => {
    // let's start Ajx
    let xhr = new XMLHttpRequest(); // creating XML object
    // console.log(xhr);
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                if (data == "success") {
                    location.href = "users.php"
                } else {
                    errText.textContent = data;
                    errText.style.display = "block";
                }
            } 
        }
    }
    // send form data through Ajax to php
    let formData = new FormData(form); //formData object
    xhr.send(formData); //send formData to php
}
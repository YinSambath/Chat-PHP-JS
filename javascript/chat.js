const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault(); //preventing form from submitting 
}

sendBtn.onclick = () => {
    // let's start Ajx
    let xhr = new XMLHttpRequest(); // creating XML object
    // console.log(xhr);
    xhr.open("POST", "php/insert-chat.php", true);
    console.log(xhr);
    xhr.onload = () => {
        console.log(xhr);
        if(xhr.readyState === XMLHttpRequest.DONE) {
            console.log(xhr.status);
            if(xhr.status === 200) {
                console.log("Chatted");
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    // send form data through Ajax to php
    let formData = new FormData(form); //formData object
    xhr.send(formData); //send formData to php
}

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}
chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

setInterval(() => {
    // let's start Ajx
    let xhr = new XMLHttpRequest(); // creating XML object
    // console.log(xhr);
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    // send form data through Ajax to php
    let formData = new FormData(form); //formData object
    xhr.send(formData); //send formData to php
}, 500); // this function will run frequently after 500ms

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}
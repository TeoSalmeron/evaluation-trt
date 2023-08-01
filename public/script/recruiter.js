const form = document.getElementById("form")
const formStatus = document.getElementById("formStatus")

form.addEventListener("submit", (e) => {
    e.preventDefault()
    let formData = new FormData(form)
    var xhr = new XMLHttpRequest
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.response
            formStatus.innerText = response.msg
            formStatus.style.display = "block"
            if(response.error == 1) {
                formStatus.style.color = "red"
            } else {
                formStatus.style.color = "green"
            }
        } else if (xhr.readyState == 4) {
            console.log("Erreur")
        }
    }
    xhr.open("POST", "/profil/employeur_actions", true)
    xhr.responseType = "json"
    xhr.send(formData)
    
})
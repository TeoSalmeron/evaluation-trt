const form = document.getElementById("form")
const formStatus = document.getElementById("formStatus")

form.addEventListener("submit", (e) => {
    e.preventDefault()
    var formData = new FormData(form)
    var xhr = new XMLHttpRequest
    xhr.onreadystatechange = function() {
        if(xhr.status == 200 && xhr.readyState == 4) {
            var response = xhr.response
            formStatus.innerText = response.msg
            console.log(response)
            if(response.error == 1) {
                formStatus.style.color = "red"
            } else {
                formStatus.style.color = "green"
            }
        } else if(xhr.readyState == 4) {
            console.log("Erreur")
        }
    }
    xhr.open("POST", "/profil/ajout_consultant", true)
    xhr.responseType = "json"
    xhr.send(formData)
})
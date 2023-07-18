const form = document.getElementById("signInForm")
const formStatus = document.getElementById("formStatus")

form.addEventListener("submit", (e) => {
    e.preventDefault()
    const formData = new FormData(form)
    var xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.response
            formStatus.innerText = response.msg
            if(response.error == 1) {
                formStatus.style.color = "red"
            } else {
                location.assign("/profil")
            }
        } else if (xhr.status == 4) {
            console.log("ERREUR LORS DE L'ENVOI DU FORMULAIRE")
        }
    }
    xhr.responseType = "json"
    xhr.open("POST", "/connexion/sign_in", true)
    xhr.send(formData)
})
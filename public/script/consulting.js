const recruiterForms = document.getElementsByClassName("recruiter_forms")
const recruiterFormStatus = document.getElementById("recruiterFormStatus")
const recruiterWarning = document.getElementById("recruiterWarning")
const recruiterTable = document.getElementById("recruiterTable")

const candidateForms = document.getElementsByClassName("candidate_forms")
const candidateFormStatus = document.getElementById("candidateFormStatus")
const candidateWarning = document.getElementById("candidateWarning")
const candidateTable = document.getElementById("candidateTable")

const trs = document.getElementsByTagName("tr")

function listenToFormAndConfirmUser(f, role) {
    f.addEventListener("submit", (e) => {
        e.preventDefault()
        let action = f[1].value
        let id = f[0].value
        let status = role === "candidate" ? candidateFormStatus : recruiterFormStatus
        let xhr = new XMLHttpRequest
        xhr.onreadystatechange = function() {
            if(xhr.status == 200 && xhr.readyState == 4) {
                let response = xhr.response
                status.innerText = response.msg
                if(response.error == 1) {
                    status.style.color = "red"
                } else {
                    status.style.color = "green"
                    for (let tr of trs) {
                        if(tr.className == f.id) {
                            tr.style.display = "none"
                        }
                    }
                }
            } else if (xhr.readyState == 4) {
                console.log("Erreur")
            }
        }
        xhr.open("POST", "/profil/consultant_actions", true)
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
        xhr.responseType = "json"
        xhr.send("action=" + action + "&id=" + id)
    })
}

for (let f of recruiterForms) {
    listenToFormAndConfirmUser(f, "recruiter")
}

for (let f of candidateForms) {
    listenToFormAndConfirmUser(f, "candidate")
}
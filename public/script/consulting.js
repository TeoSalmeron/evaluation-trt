const recruiterForms = document.getElementsByClassName("recruiter_forms")
const recruiterFormStatus = document.getElementById("recruiterFormStatus")
const recruiterWarning = document.getElementById("recruiterWarning")
const recruiterTable = document.getElementById("recruiterTable")

const candidateForms = document.getElementsByClassName("candidate_forms")
const candidateFormStatus = document.getElementById("candidateFormStatus")
const candidateWarning = document.getElementById("candidateWarning")
const candidateTable = document.getElementById("candidateTable")

const trs = document.getElementsByTagName("tr")

for (let f of recruiterForms) {
    f.addEventListener("submit", (e) => {
        e.preventDefault()
        let action = f[1].value
        let id = f[0].value
        let xhr = new XMLHttpRequest
        xhr.onreadystatechange = function() {
            if(xhr.status == 200 && xhr.readyState == 4) {
                let response = xhr.response
                recruiterFormStatus.innerText = response.msg
                if(response.error == 1) {
                    recruiterFormStatus.style.color = "red"
                } else {
                    recruiterFormStatus.style.color = "green"
                    for (let tr of trs) {
                        if(tr.className == f.id) {
                            tr.style.display = "none"
                        }
                    }
                    console.log(recruiterTable)
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

for (let f of candidateForms) {
    f.addEventListener("submit", (e) => {
        e.preventDefault()
        let action = f[1].value
        let id = f[0].value
        let xhr = new XMLHttpRequest
        xhr.onreadystatechange = function() {
            if(xhr.status == 200 && xhr.readyState == 4) {
                let response = xhr.response
                candidateFormStatus.innerText = response.msg
                if(response.error == 1) {
                    candidateFormStatus.style.color = "red"
                } else {
                    candidateFormStatus.style.color = "green"
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
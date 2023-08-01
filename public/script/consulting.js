const recruiterForms = document.getElementsByClassName("recruiter_forms")
const recruiterFormStatus = document.getElementById("recruiterFormStatus")
const recruiterWarning = document.getElementById("recruiterWarning")
const recruiterTable = document.getElementById("recruiterTable")

const candidateForms = document.getElementsByClassName("candidate_forms")
const candidateFormStatus = document.getElementById("candidateFormStatus")
const candidateWarning = document.getElementById("candidateWarning")
const candidateTable = document.getElementById("candidateTable")

const ads = document.getElementsByClassName("ad")
const adForms = document.getElementsByClassName("ad_forms")
const adFormStatus = document.getElementById("adFormStatus")

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

function advertisementAction(f) {
    f.addEventListener("submit", (e) => {
        e.preventDefault()
        let action = e.submitter.value
        let id = f[0].value
        var xhr = new XMLHttpRequest
        xhr.onreadystatechange = function() {
            if(xhr.status == 200 && xhr.readyState == 4) {
                var response = xhr.response
                adFormStatus.innerText = response.msg
                if(response.error == 1) {
                    adFormStatus.style.color = "red"
                } else {
                    adFormStatus.scrollIntoView()
                    window.scrollTo(0, 500)
                    adFormStatus.style.color = "green"

                    for(let a of ads) {
                        if(a.id === f.id) {
                            a.style.display = "none"
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

for (let f of adForms) {
    advertisementAction(f)
}
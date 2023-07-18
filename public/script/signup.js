const signUpRole = document.getElementById("signUpRole")
const candidateSignUpForm = document.getElementById("candidateSignUpForm")
const recruiterSignUpForm = document.getElementById("recruiterSignUpForm")
const candidateFormStatus = document.getElementById("candidateFormStatus")
const recruiterFormStatus = document.getElementById("recruiterFormStatus")

// Display sign up form depending user role
signUpRole.addEventListener("input", (e) => {
    if(e.target.value == 1) {
        candidateSignUpForm.style.display = "none"
        recruiterSignUpForm.style.display = "flex"
    } else if (e.target.value == 0) {
        recruiterSignUpForm.style.display = "none"
        candidateSignUpForm.style.display = "flex"
    }
})

candidateSignUpForm.addEventListener("submit", (e) => {
    e.preventDefault()
    const formData = new FormData(candidateSignUpForm)
    var xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.response
            candidateFormStatus.innerText = response.msg
            window.scrollTo(0, 0)
            if(response.error == 1) {
                candidateFormStatus.style.color = "red"
            } else {
                candidateFormStatus.style.color = "green"
            }
        }
    }
    xhr.responseType = "json"
    xhr.open("POST", "/inscription/candidate_sign_up", true)
    xhr.send(formData)
})

recruiterSignUpForm.addEventListener("submit", (e) => {
    e.preventDefault()
    const formData = new FormData(recruiterSignUpForm)
    var xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.response
            recruiterFormStatus.innerText = response.msg
            window.scrollTo(0, 0)
            if(response.error == 1) {
                recruiterFormStatus.style.color = "red"
            } else {
                recruiterFormStatus.style.color = "green"
            }
        }
    }
    xhr.responseType = "json"
    xhr.open("POST", "/inscription/recruiter_sign_up", true)
    xhr.send(formData)
})

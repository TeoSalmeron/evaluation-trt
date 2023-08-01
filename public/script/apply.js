const applyBtns = document.getElementsByClassName("btn_apply")

for (let btn of applyBtns) {
    btn.addEventListener("click", (e) => {
        var xhr = new XMLHttpRequest
        var id = btn.value
        xhr.onreadystatechange = function() {
            if(xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.response
                if(response.error == 1 && response.redirect !== "") {
                    window.location.assign(response.redirect)
                } else if (response.error == 1) {
                    alert(response.msg)
                } else {
                    alert(response.msg)
                    btn.style.backgroundColor = "gray"
                    btn.style.border = "3px solid gray"
                    btn.disabled = true
                    btn.style.pointerEvents = "none"
                }
            } else if (xhr.readyState == 4) {
                console.log("Erreur")
            }
        }
        xhr.open("POST", "/applications/action", true)
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
        xhr.responseType = "json"
        xhr.send("action=apply&id=" + id)
    })
}
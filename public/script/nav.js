const toggleNav = document.getElementById("toggleNav")
const closeNav = document.getElementById("closeNav")
const navList = document.getElementById("navList")
const linkMyAccount = document.getElementById("linkMyAccount")
const subNavMyAccount = document.getElementById("subNavMyAccount")

toggleNav.addEventListener("click", () => {
    navList.style.left = "0px"    
})

closeNav.addEventListener("click", () => {
    navList.style.left = "-100vw"
})

linkMyAccount.addEventListener("click", () => {
    
    subNavMyAccount.classList.toggle("is_active")

    if(subNavMyAccount.classList.contains("is_active")) {
        subNavMyAccount.style.display = "flex"
        linkMyAccount.innerText = "- Mon compte"
    } else {
        subNavMyAccount.style.display = "none"
        linkMyAccount.innerText = "+ Mon compte"
    }
})
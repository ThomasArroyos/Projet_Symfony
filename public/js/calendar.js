let deconnexion = document.querySelector("#deconnexion")

deconnexion.addEventListener('click', (e) => {
    let xhr = new XMLHttpRequest
    xhr.open("GET", `/logout`)
    xhr.send()
    //document.location.replace('/login');
})
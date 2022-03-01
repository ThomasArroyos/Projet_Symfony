let modalContainerMatiereAdd = document.querySelector("#modal_container_matiere_add")
let bouttonAjouter = document.querySelector("#bouttonAjouter")
let form = document.querySelector("#form")
let divDeBas = document.querySelector("#matieres")
let plus = document.querySelectorAll(".plus")[0]
let minus = document.querySelectorAll(".minus")
let enregistrer = document.querySelector("#enregistrer")
let bouttonAnulerEdition = document.querySelector("#bouttonAnulerEdition")
let modalContainerUsersEdition = document.querySelector("#modal_container_users_selected")
let bouttonAnulerCreation = document.querySelector("#bouttonAnulerCreation")
let ajouter = document.querySelector("#ajouter")

bouttonAjouter.addEventListener("click", () => {
    modalContainerMatiereAdd.classList.add("show")
})

ajouter.addEventListener("click", () => {
    let url = `/api/matieres/add`

    let donnees = {
        "nomMatiere": document.querySelector("#matiere").value,
        "dureeTotale": document.querySelector("#duree").value,
        "intervenantAffecte": document.querySelector("#mySelect").value
    }
    let xhr = new XMLHttpRequest

    xhr.open("PUT", url)
    xhr.send(JSON.stringify(donnees))
    //location.reload();
})
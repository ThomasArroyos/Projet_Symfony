let modal_container_event_non_accepte_click = document.getElementById('modal_container_event_non_accepte_click')
let modal_container_event_non_accepte_click_titre = document.getElementById('modal_container_event_non_accepte_click_titre')
let modal_container_event_non_accepte_click_boutton_accepter = document.getElementById('modal_container_event_non_accepte_click_boutton_accepter')
let modal_container_event_non_accepte_click_boutton_supprimer = document.getElementById('modal_container_event_non_accepte_click_boutton_supprimer')
let modal_container_event_non_accepte_click_boutton_annuler = document.getElementById('modal_container_event_non_accepte_click_boutton_annuler')
let modal_container_event_accepte_click = document.getElementById('modal_container_event_accepte_click')
let modal_container_event_accepte_click_titre = document.getElementById('modal_container_event_accepte_click_titre')
let modal_container_event_accepte_click_boutton_supprimer = document.getElementById('modal_container_event_accepte_click_boutton_supprimer')
let modal_container_event_accepte_click_boutton_annuler = document.getElementById('modal_container_event_accepte_click_boutton_annuler')
let dernier_evenement_clicker


function afficherModalContainerEventClick(event) {
    if (event.event.extendedProps.accepte === false) {
        dernier_evenement_clicker = event.event
        modal_container_event_non_accepte_click_titre.innerHTML = "Voulez-vous accepter l'évenement : " + event.event.title
        modal_container_event_non_accepte_click.classList.add("show")
    } else {
        dernier_evenement_clicker = event.event
        modal_container_event_accepte_click_titre.innerHTML = "Voulez-vous vraiment supprimer l'évenement : " + event.event.title
        modal_container_event_accepte_click.classList.add("show")
    }
}

modal_container_event_non_accepte_click_boutton_accepter.addEventListener('click', (e) => {
    accepterEvenement(dernier_evenement_clicker)
    modal_container_event_non_accepte_click.classList.remove("show")
})

modal_container_event_non_accepte_click_boutton_supprimer.addEventListener('click', (e) => {
    supprimerEvenement(dernier_evenement_clicker)
    modal_container_event_non_accepte_click.classList.remove("show")
})

modal_container_event_non_accepte_click_boutton_annuler.addEventListener('click', (e) => {
    modal_container_event_non_accepte_click.classList.remove("show")
})

modal_container_event_accepte_click_boutton_supprimer.addEventListener('click', (e) => {
    supprimerEvenement(dernier_evenement_clicker)
    modal_container_event_accepte_click.classList.remove("show")
})

modal_container_event_accepte_click_boutton_annuler.addEventListener('click', (e) => {
    modal_container_event_accepte_click.classList.remove("show")
})

function accepterEvenement(evenement) {
    let url = `/api/accepter_evenement/${evenement.id}`

    /*let donnees = {
        'id': evenement.id,
        'title': evenement.title,
        'start': formaterHeure(evenement),
        'end': formaterHeure(evenement,0),
        'backgroundColor': evenement.backgroundColor,
        'borderColor': evenement.borderColor,
        'textColor': evenement.textColor,
        'allDay': evenement.allDay,
        'editable': evenement.editable,
        'overlap': evenement.overlap,
        'display': evenement.display,
        'en_fond': evenement.extendedProps.en_fond,
        'accepte': evenement.extendedProps.accepte,
        'matiere': evenement.extendedProps.matiere,
        'specialite': evenement.extendedProps.specialite,
        'matiere': evenement.extendedProps.matiere,
        'intervenant': evenement.extendedProps.intervenant,
        'specialite': evenement.extendedProps.specialite
    }*/

    /*if (evenement.extendedProps.matiere !== null){
        donnees = Object.assign({}, donnees, {
            'matiere': evenement.extendedProps.matiere
        })
    }

    if (evenement.extendedProps.intervenant !== null){
        donnees = Object.assign({}, donnees, {
            'intervenant': evenement.extendedProps.intervenant
        })
    }

    if (evenement.extendedProps.specialite !== null){
        donnees = Object.assign({}, donnees, {
            'intervenant': evenement.extendedProps.specialite
        })
    }*/

    let xhr = new XMLHttpRequest

    xhr.open("PUT", url)
    xhr.send()

    location.reload();
}

function supprimerEvenement(evenement) {
    let url = `/api/supprimer_evenement/${evenement.id}`

    let xhr = new XMLHttpRequest

    xhr.open("PUT", url)
    xhr.send()

    location.reload();
}
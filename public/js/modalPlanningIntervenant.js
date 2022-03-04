let modal_container_calendar_click = document.getElementById('modal_container_calendar_click')
let modal_container_calendar_click_titre = document.getElementById('modal_container_calendar_click_titre')
let modal_container_calendar_click_start = document.getElementById('modal_container_calendar_click_start')
let modal_container_calendar_click_end = document.getElementById('modal_container_calendar_click_end')
let modal_container_calendar_click_allDay = document.getElementById('modal_container_calendar_click_allDay')
let modal_container_calendar_click_overlap = document.getElementById('modal_container_calendar_click_overlap')
let modal_container_calendar_click_editable = document.getElementById('modal_container_calendar_click_editable')
let modal_container_calendar_click_accepte = document.getElementById('modal_container_calendar_click_accepte')
let modal_container_calendar_click_en_fond = document.getElementById('modal_container_calendar_click_en_fond')
let modal_container_calendar_click_reccurent = document.getElementById('modal_container_calendar_click_reccurent')
let modal_container_calendar_click_boutton_enregistrer = document.getElementById('modal_container_calendar_click_boutton_enregistrer')
let modal_container_calendar_click_boutton_annuler = document.getElementById('modal_container_calendar_click_boutton_annuler')
let dernier_evenement_clicker


function afficherModalContainerCalendarClick(event) {
    if (event.start.toLocaleTimeString()<"12:00:00") {
        modal_container_calendar_click_start = formaterHeure(event).replace(formaterHeure(event).split('T')[1],'08:00')
        modal_container_calendar_click_end = formaterHeure(event).replace(formaterHeure(event).split('T')[1],'12:00')
    } else {
        modal_container_calendar_click_start = formaterHeure(event).replace(formaterHeure(event).split('T')[1],'13:00')
        modal_container_calendar_click_end = formaterHeure(event).replace(formaterHeure(event).split('T')[1],'16:00')
    }
    //modal_container_calendar_click_start
    modal_container_calendar_click.classList.add("show")
}

modal_container_calendar_click_boutton_enregistrer.addEventListener('click', (e) => {
    ajouterEvenement()
    modal_container_event_non_accepte_click.classList.remove("show")
})

modal_container_event_non_accepte_click_boutton_supprimer.addEventListener('click', (e) => {
    supprimerEvenement(dernier_evenement_clicker)
    modal_container_event_non_accepte_click.classList.remove("show")
})

modal_container_event_non_accepte_click_boutton_annuler.addEventListener('click', (e) => {
    modal_container_event_non_accepte_click.classList.remove("show")
})

function ajouterEvenement() {
    let url = `/api/ajouter_evenement`

    let donnees = {
        //'id': evenement.id,
        'titre': modal_container_calendar_click_titre.value,
        'date_debut': modal_container_calendar_click_start,
        'date_fin': modal_container_calendar_click_end,
        //'backgroundColor': evenement.backgroundColor,
        //'borderColor': evenement.borderColor,
        //'textColor': evenement.textColor,
        'journee_entiere': modal_container_calendar_click_allDay.value,
        'modifiable': modal_container_calendar_click_editable.value,
        'chevauchable': modal_container_calendar_click_overlap.value,
        'en_fond': modal_container_calendar_click_en_fond.value,
        'accepte': modal_container_calendar_click_accepte.value,
        //'matiere': evenement.extendedProps.matiere,
        //'specialite': evenement.extendedProps.specialite,
        //'matiere': evenement.extendedProps.matiere,
        'reccurent': modal_container_calendar_click_reccurent.value,
        //'specialite': evenement.extendedProps.specialite
    }

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
    xhr.send(JSON.stringify(donnees))

    //location.reload();
}

function supprimerEvenement(evenement) {
    let url = `/api/supprimer_evenement/${evenement.id}`

    let xhr = new XMLHttpRequest

    xhr.open("PUT", url)
    xhr.send()

    location.reload();
}
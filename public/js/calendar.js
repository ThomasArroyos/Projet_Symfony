window.onload = function(){

    let lastEventClicked;
    let lastStartTime;
    let lastEndTime;
    let lastAllDay;

    let ajouter = document.querySelector("#ajouter")

    let modal_container_event_selected = document.querySelector("#modal_container_event_selected")

    let modal_container_grid_selected = document.querySelector("#modal_container_grid_selected")

    let modal_container_modification_form = document.querySelector("#modal_container_modification_form")

    let titre = document.querySelector("#titre")
    let description = document.querySelector("#description")

    let modifier = document.querySelector("#modifier")
    let supprimer = document.querySelector("#supprimer")

    let modifierEvent = document.querySelector("#modifierEvent")
    let closeEventSelect = document.querySelector("#closeEventSelect")
    let closeGridSelect = document.querySelector("#closeGridSelect")
    let closeModificationForm = document.querySelector("#closeModificationForm")

    let calendarElt = document.querySelector("#calendrier")

    calendar.on('select', (e) => {
        lastStartTime = e.startStr
        lastEndTime = e.endStr
        lastAllDay = e.allDay
        document.querySelector("#start").value = lastStartTime.slice(0,16)
        document.querySelector("#end").value = lastEndTime.slice(0,16)
        modal_container_grid_selected.classList.add('show')
    })

    ajouter.addEventListener('click', (e) => {
        let url = `/api/add`

        let donnees = {
            "title": document.querySelector("#title").value,
            "description": document.querySelector("#descriptionForm").value,
            "start": lastStartTime,
            "end": lastEndTime,
            "backgroundColor": document.querySelector("#backgroundColor").value,
            "borderColor": document.querySelector("#borderColor").value,
            "textColor": document.querySelector("#textColor").value,
            "allDay": lastAllDay
        }
        console.log(donnees)
        let xhr = new XMLHttpRequest

        xhr.open("PUT", url)
        xhr.send(JSON.stringify(donnees))

        modal_container_event_selected.classList.remove('show');
        location.reload();
    })

    calendar.on('eventChange', (e) => {
        let url = `/api/${e.event.id}/edit`
        let donnees = {
            "title": e.event.title,
            "description": e.event.extendedProps.description,
            "start": e.event.start,
            "end": e.event.end,
            "backgroundColor": e.event.backgroundColor,
            "borderColor": e.event.borderColor,
            "textColor": e.event.textColor,
            "allDay": e.event.allDay
        }
        console.log(donnees)
        let xhr = new XMLHttpRequest

        xhr.open("PUT", url)
        xhr.send(JSON.stringify(donnees))
    })

    calendar.on('eventClick', (e) => {
        lastEventClicked = e
        titre.innerHTML = e.event.title
        description.innerHTML = e.event.extendedProps.description
        modal_container_event_selected.classList.add('show');
    })

    supprimer.addEventListener('click', (e) => {
        let url = `/api/${lastEventClicked.event.id}/delete`
        let donnees = {
            "title": lastEventClicked.event.title,
            "description": lastEventClicked.event.extendedProps.description,
            "start": lastEventClicked.event.start,
            "end": lastEventClicked.event.end,
            "backgroundColor": lastEventClicked.event.backgroundColor,
            "borderColor": lastEventClicked.event.borderColor,
            "textColor": lastEventClicked.event.textColor,
            "allDay": lastEventClicked.event.allDay
        }
        console.log(lastEventClicked)
        let xhr = new XMLHttpRequest

        xhr.open("PUT", url)
        xhr.send(JSON.stringify(donnees))
        modal_container_event_selected.classList.remove('show');
        lastEventClicked.event.remove();
    })

    modifier.addEventListener('click', (e) => {
        // Enlever le modal de choix
        modal_container_event_selected.classList.remove('show');

        // Remplissage du formulaire de modification
        document.querySelector("#modificationFormTitle").value = lastEventClicked.event.title
        document.querySelector("#modificationFormDescription").value = lastEventClicked.event._def.extendedProps.description
        document.querySelector("#modificationFormStart").value = formaterHeure(lastEventClicked)
        document.querySelector("#modificationFormEnd").value = formaterHeure(lastEventClicked,false)
        document.querySelector("#modificationFormBackgroundColor").value = lastEventClicked.event.backgroundColor
        document.querySelector("#modificationFormBorderColor").value = lastEventClicked.event.borderColor
        document.querySelector("#modificationFormTextColor").value = lastEventClicked.event.textColor
        document.querySelector("#modificationFormAllDay").checked = lastEventClicked.event.allDay

        // Afficher le modal de modification
        modal_container_modification_form.classList.add('show');
    })

    /*
     * Sert a formatter les heures
     */
    function formaterHeure(HTMLScriptElement, start=true) {
        console.log(HTMLScriptElement.event.end.toString())
        let datetime_locale_format
        if (start===true && HTMLScriptElement.event.start !== null) {
            datetime_locale_format = HTMLScriptElement.event.start.toString().split(" ")[3]+"-"
            switch (HTMLScriptElement.event.start.toString().split(" ")[1]) {
                case "Jan": datetime_locale_format += "01-";
                    break;
                case "Feb": datetime_locale_format += "02-";
                    break;
                case "Mar": datetime_locale_format += "03-";
                    break;
                case "Apr": datetime_locale_format += "04-";
                    break;
                case "May": datetime_locale_format += "05-";
                    break;
                case "Jun": datetime_locale_format += "06-";
                    break;
                case "Jul": datetime_locale_format += "07-";
                    break;
                case "Aug": datetime_locale_format += "08-";
                    break;
                case "Sep": datetime_locale_format += "09-";
                    break;
                case "Oct": datetime_locale_format += "10-";
                    break;
                case "Nov": datetime_locale_format += "11-";
                    break;
                case "Dec": datetime_locale_format += "12-";
                    break;
            }
            if (parseInt(HTMLScriptElement.event.start.toString().split(" ")[4].split(":")[0],10)<11) {
                datetime_locale_format += HTMLScriptElement.event.start.toString().split(" ")[2]+"T0"+(parseInt(HTMLScriptElement.event.start.toString().split(" ")[4].split(":")[0],10)-1).toString()+":"+HTMLScriptElement.event.start.toString().split(" ")[4].split(":")[1]
            } else {
                datetime_locale_format += HTMLScriptElement.event.start.toString().split(" ")[2]+"T"+(parseInt(HTMLScriptElement.event.start.toString().split(" ")[4].split(":")[0],10)-1).toString()+":"+HTMLScriptElement.event.start.toString().split(" ")[4].split(":")[1]
            }
        } else if (start===false && HTMLScriptElement.event.end !== null) {
            datetime_locale_format = HTMLScriptElement.event.end.toString().split(" ")[3]+"-"
            switch (HTMLScriptElement.event.end.toString().split(" ")[1]) {
                case "Jan": datetime_locale_format += "01-";
                    break;
                case "Feb": datetime_locale_format += "02-";
                    break;
                case "Mar": datetime_locale_format += "03-";
                    break;
                case "Apr": datetime_locale_format += "04-";
                    break;
                case "May": datetime_locale_format += "05-";
                    break;
                case "Jun": datetime_locale_format += "06-";
                    break;
                case "Jul": datetime_locale_format += "07-";
                    break;
                case "Aug": datetime_locale_format += "08-";
                    break;
                case "Sep": datetime_locale_format += "09-";
                    break;
                case "Oct": datetime_locale_format += "10-";
                    break;
                case "Nov": datetime_locale_format += "11-";
                    break;
                case "Dec": datetime_locale_format += "12-";
                    break;
            }
            if (parseInt(HTMLScriptElement.event.end.toString().split(" ")[4].split(":")[0],10)<11) {
                datetime_locale_format += HTMLScriptElement.event.end.toString().split(" ")[2]+"T0"+(parseInt(HTMLScriptElement.event.end.toString().split(" ")[4].split(":")[0],10)-1).toString()+":"+HTMLScriptElement.event.end.toString().split(" ")[4].split(":")[1]
            } else {
                datetime_locale_format += HTMLScriptElement.event.end.toString().split(" ")[2]+"T"+(parseInt(HTMLScriptElement.event.end.toString().split(" ")[4].split(":")[0],10)-1).toString()+":"+HTMLScriptElement.event.end.toString().split(" ")[4].split(":")[1]
            }
        } else if (start===false && HTMLScriptElement.event.end === null) {
            datetime_locale_format = ""
        }
        return datetime_locale_format
    }

    /*
     * Modification d'événement
     */
    modifierEvent.addEventListener('click', (e) => {
        let url = `/api/${lastEventClicked.event.id}/edit`
        let donnees = {
            "title": document.querySelector("#modificationFormTitle").value,
            "description": document.querySelector("#modificationFormDescription").value,
            "start": document.querySelector("#modificationFormStart").value,
            "end": document.querySelector("#modificationFormEnd").value,
            "backgroundColor": document.querySelector("#modificationFormBackgroundColor").value,
            "borderColor": document.querySelector("#modificationFormBorderColor").value,
            "textColor": document.querySelector("#modificationFormTextColor").value,
            "allDay": document.querySelector("#modificationFormAllDay").checked,
        }
        console.log(donnees);

        let xhr = new XMLHttpRequest

        xhr.open("PUT", url)
        xhr.send(JSON.stringify(donnees))

        modal_container_modification_form.classList.remove('show');
        location.reload();
    })

    closeEventSelect.addEventListener('click', (e) => {
        modal_container_event_selected.classList.remove('show');
    })

    closeGridSelect.addEventListener('click', (e) => {
        modal_container_grid_selected.classList.remove('show');
    })

    closeModificationForm.addEventListener('click', (e) => {
        modal_container_modification_form.classList.remove('show');
    })

    calendar.render()
}
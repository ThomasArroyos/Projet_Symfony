let modal_container_event_click = document.getElementById('modal_container_event_click')


function afficherModalContainerEventClick(event) {
    console.log(event)
    //fetch(`/api/usermatiere/${e.startStr}`).then(res => console.log(res)).catch()
    if (event.extendedProps.en_fond=="auto"){
        modal_container_event_click.classList.add("show")
    }
}
let form = document.querySelector("#form")
let divDeBas = document.querySelector("#matieres")
      let plus = document.querySelectorAll(".plus")[0]
      let minus = document.querySelectorAll(".minus")
      let enregistrer = document.querySelector("#enregistrer")

  document.querySelector("#email").addEventListener("input", ()=> {
    document.querySelector("#email").parentNode.classList.remove('vide')
  })

      plus.addEventListener("click", ( )=>{
        let matiereValue = document.querySelector("#matiereValue").value
        if (matiereValue.length !== 0 && matiereValue !== matiereValue.split(' ').length-1) {
          let div = document.createElement("div")
          let text = document.createElement("input")
          text.value = matiereValue
          text.classList.add('matieresV')
          document.querySelector("#matiereValue").value = ""
          let i = document.createElement("i")

          i.classList.add('uil')
          i.classList.add('uil-minus-circle')
          i.classList.add('minus')
          div.classList.add('input-field')
          div.appendChild(text)
          div.appendChild(i)

          divDeBas.after(div)

          divDeBas.classList.remove('vide')
          document.querySelector("#matiereValue").placeholder = "Matières"

          document.querySelectorAll(".forms")[0].style.height = document.querySelectorAll(".forms")[0].clientHeight + 85 + "px";

          i.addEventListener("click", ( )=>{
            div.parentElement.removeChild(div);
            document.querySelectorAll(".forms")[0].style.height = document.querySelectorAll(".forms")[0].clientHeight - 85 + "px";
          })
        } else {
          document.querySelector("#matiereValue").placeholder = "Vide"
          document.querySelector("#matiereValue").focus()
          divDeBas.classList.add("vide")
        }
      })

      enregistrer.addEventListener("click", ( )=>{
        //var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        //var formatPrenomNom = /([A-Z])+([a-z]*)+(((-)+([A-Z])+([a-z]*))?)/s;
        let email = document.querySelector("#email")

        /*if (email.value.match(mailformat) != null) {
          console.log("Oui")
        } else {
          email.parentNode.classList.add("vide")
          email.placeholder = "exemple@limayrac.fr"
          email.focus()
        }*/
        let url = `/api/user/add`

        let toutesLesMatieres = "";

        for (var i = 0; i < document.querySelectorAll(".matieresV").length; i++) {
          toutesLesMatieres += document.querySelectorAll(".matieresV")[i].value + ","
        }

        let donnees = {
          "email": document.querySelector("#email").value,
          "prenomNom": document.querySelector("#prenomNom").value,
          "roles": document.querySelector("#roles").value,
          "matieres": toutesLesMatieres
        }
        console.log(donnees)
        /*let xhr = new XMLHttpRequest

        xhr.open("PUT", url)
        xhr.send(JSON.stringify(donnees))*/
      })
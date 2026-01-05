// Ouverture et fermeture des informations
function openInfo(id) {
    let infoContainer = document.getElementById(id);

    if (infoContainer.classList.contains("show")) {
        infoContainer.classList.remove("show");
        // Attendre la fin de l'animation avant de masquer complètement
        setTimeout(() => {
            infoContainer.style.display = "none";
        }, 20); // 300 ms correspond à la durée de la transition CSS
    } else {
        infoContainer.style.display = "flex"; // S'assurer qu'il est visible
        // Utiliser un timeout pour permettre l'affichage avant d'ajouter l'animation
        setTimeout(() => {
            infoContainer.classList.add("show");
        }, 20); // Petit délai pour garantir que l'affichage s'applique
    }
}


// Ouverture et fermeture des catégories
let categoryButtonAddAccount = document.getElementById("categoryButtonAddAccount");
categoryButtonAddAccount.addEventListener("click", function() {

    let categorySelect = document.getElementById("categorySelectAddAccount");
    let categoryInput = document.getElementById("categoryInputAddAccount");

    if(categorySelect.style.display === "block" || categorySelect.style.display === "") {
        categorySelect.style.display = "none";
        categoryInput.style.display = "block";
    } else{
        categorySelect.style.display = "block";
        categoryInput.style.display = "none";
    }
});

// Ouverture et fermeture des catégories
function swtichCategory(id){

    console.log("id", id);

    let categorySelect = document.getElementById("categorySelectAccount"+id);
    let categoryInput = document.getElementById("categoryInputAccount"+id);

    if(categorySelect.style.display === "block" || categorySelect.style.display === "") {
        categorySelect.style.display = "none";
        categoryInput.style.display = "block";
    } else{
        categorySelect.style.display = "block";
        categoryInput.style.display = "none";
    }
}


// Afficher le mot de passe en clair
document.querySelectorAll('input[type="password"]').forEach(input => {
    input.addEventListener('focusin', function(event) {
        let id = event.target.id;
        let password = document.getElementById(id);
        password.type = "text";
    });
});

document.querySelectorAll('input[type="password"]').forEach(input => {
    input.addEventListener('focusout', function(event) {
        let id = event.target.id;
        let password = document.getElementById(id);
        password.type = "password";
    });
});

// Copier mot de passe //
function copyText(id){
    let value = document.getElementById(id).value;
    navigator.clipboard.writeText(value);
}
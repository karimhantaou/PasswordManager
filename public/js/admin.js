// Fonction //


function random() {

    const passwordLength = Math.floor(Math.random() * (12 - 4 + 1)) + 4;

    // Définir les différents groupes de caractères
    const lowercase = "abcdefghijklmnopqrstuvwxyz";
    const uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const numbers = "1234567890";
    const symbols = "!@#$%^&*()_+";

    // Concaténer tous les groupes pour une génération aléatoire
    const allCharacters = lowercase + uppercase + numbers + symbols;

    // Fonction pour obtenir un caractère aléatoire d'une chaîne
    const getRandomCharacter = (str) => str[Math.floor(Math.random() * str.length)];

    // Contraintes minimales : au moins un de chaque type
    const requiredCharacters = [
        getRandomCharacter(lowercase),
        getRandomCharacter(uppercase),
        getRandomCharacter(numbers),
        getRandomCharacter(symbols)
    ];

    // Compléter avec des caractères aléatoires
    const remainingLength = passwordLength - requiredCharacters.length;
    for (let i = 0; i < remainingLength; i++) {
        requiredCharacters.push(getRandomCharacter(allCharacters));
    }

    // Mélanger le mot de passe pour une distribution aléatoire
    for (let i = requiredCharacters.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [requiredCharacters[i], requiredCharacters[j]] = [requiredCharacters[j], requiredCharacters[i]];
    }

    // Retourner le mot de passe sous forme de chaîne
    return requiredCharacters.join('');
}

// Slider //

let slider = document.getElementById("slider");
let output = document.getElementById("sliderValue");
output.innerHTML = slider.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
  output.innerHTML = this.value;
} 

// Génerer mot de passe //

document.getElementById("generateButton").addEventListener("click", function() {
    let passwordLength = document.getElementById("slider").value;
    document.getElementById("password").value = randomPassword(passwordLength);
});

// Copier mot de passe //

document.getElementById("copyButton").addEventListener("click", function() {
    let password = document.getElementById("password").value;
    navigator.clipboard.writeText(password);
});
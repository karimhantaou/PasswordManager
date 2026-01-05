<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Génerer mot de passe</title>

    <link rel="icon" type="image/png" href="public/ressources/icon/lockIcon.png"/>

    <!-- CSS -->
    <link rel="stylesheet" href="public/Style/global.css">
    <link rel="stylesheet" href="public/Style/password.css">

</head>
<body>

    <div class="main">
       
        <div class="mainContainer">

            <h1 class="title">Génerer un mot de passe</h1>

            <div class="passwordContainer">
                <input type="text" id="password" placeholder="Mot de passe" class="formField inputStyle">
                <svg id="copyButton" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5" stroke="#1C274C" stroke-width="1.5"></path> </g></svg>
            </div>

            <div class="sliderContainer">
                <input type="range" name="passwordLength" min="12" max="30" value="12" class="slider" id="slider">
                <label id="sliderValue" class="">
            </div>

            <button id="generateButton" class="formField submitStyle">Generer</button>

        </div>
        
    </div>

    <!-- JS -->
    <script src="public/js/password.js"></script>
</body>
</html>
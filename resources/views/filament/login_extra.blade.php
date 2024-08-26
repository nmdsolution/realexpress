<div id="model-clock">
    <div id="clock-display"></div>
</div>

<h3 id="slogan">Together we achieve exceptional goodness!</h3>
<p id="tips"> <span style="font-weight: bold;"></span>Pour vous connecter à ce système, veuillez suivre ces conseils :<br>
    1. Seuls les administrateurs peuvent attribuer des identifiants. <br>
    2. Si vous ne disposez pas d'identifiant, contacter le service. <br>
    3. Une fois que vous avez reçu vos identifiants de connexion.<br>
    4. connectez-vous  en utilisant le nom d'utilisateur et <br>le mot de passe qui vous ont été fournis.
</p>
<style>
    body {
        background: rgb(34,193,195) !important;
        background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%)  !important;;
    }

    @media screen and (min-width: 1024px) {
        main {
            position: absolute; right: 100px;
        }

        main:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: darkcyan;
            border-radius: 12px;
            z-index: -9;

            /*box-shadow: -50px 80px 4px 10px #555;*/
            -webkit-transform: rotate(7deg);
            -moz-transform: rotate(7deg);
            -o-transform: rotate(7deg);
            -ms-transform: rotate(7deg);
            transform: rotate(7deg);
        }
        .fi-logo {
            position: fixed;
            left: 100px;
            font-size: 3em;
            color: cornsilk;
        }
        #tips {
            position: fixed;
            left: 100px;
            margin-top: 100px;
            color: bisque;
            font-family: cursive;
            line-height: 1.2;
            font-size: 1.3em;
            font-weight: bold;
            text-shadow: #3f6212 2px 2px 5px;}
        #slogan {
            position: fixed;
            left: 100px;
            margin-top: 50px;
            color: bisque;
            font-family: cursive;
            font-size: 2em;
            font-weight: bold;
            text-shadow: #3f6212 2px 2px 5px;}
        /* New styles for clock positioning */
        #model-clock {
            position: absolute; /* Make the clock absolute for positioning */

            left: 50%; /* Center the clock horizontally */
            transform: translate(-50%, -50%); /* Adjust position based on offset */
        }

    }

</style>
<script>
    // Function to display the current time in Douala, Africa time zone
    function displayDoualaTime() {
        const now = new Date().toLocaleTimeString('fr-CM', { timeZone: 'Africa/Douala' });
        document.getElementById('clock-display').textContent = now;
    }

    // Update clock every second
    setInterval(displayDoualaTime, 1000);

</script>

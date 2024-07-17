<!-- pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $record->name }} PDF</title>


    <div >
        <div style="float: right;">
            <p>Bafoussam|Exp:675.70.70.76.Retrait(venant de douala):<br>
                676.81.68.66..Retrait(venant de Yaounde):651.66.40.90.<br>
                (venant de dschang):675.70.70.76.(venant de DSCHANG)<br>
                :675.70.70.76.</p>
        </div>

        <div style="float: left;">
            <p style="font-size: 14px;">REAL EXPRESS VOYAGES<br>{{ $record->ref_no }}</p>
        </div>

        <div style="clear: both;"></div> <!-- Clear floats -->

        <!-- Centered Image -->
        <div style="text-align: center; position: absolute;top: 23px;left: 280px">
            <img src="{{ $imageSrc }}" width="60" height="60" alt="Logo">
        </div>

        <div style="text-align: center;">
            <p>RECU D EXPEDITION DU COLIS</p>
        </div>
    </div>
</head>
<body>
    <div class='head' style="display: flex; justify-content: space-between; margin-top: 3px;">
        <div class="inf" style="float: left; width: 50%;">

            <p>N° Ticket:  {{ $record->ref_no }}</p>

            <p>Agence de Depart: {{ $record->from_location}}</p>
            <p>Agence Destination: {{ $record->to_location}}</p>

            <p>Description Colis:{{ $record->name}}</p>



            <p>Expéditeur: {{ $record->expeditair}}</p>
            <p>Numeros de L'expéditeur: {{ $record->tel_expeditair}}</p>

            <p>Recepteur: {{ $record->destinatair}}</p>
            <p>Numeros du Recepteur: {{ $record->tel_destinatair}}</p>

            <p>Nombre Colis: {{ $record->qty}} </p>

            <p>Valeur(FCFA):{{ $record->valeur}}</p>

            <p>Frais d'envoi(FCFA): {{ $record->prix}}</p>



        </div>
        <div class="notesup" style="float:right ; width: 50%;">
            <p ><strong>AVIS AUX USAGERS QUI DESIRENT EXPEDIER LES COLIS</strong>
            <p>1)Déclarer toujours la valeur de votre colis
            <p>2)Toute expedition des colis illicites nengage que lexpediteur.</p>
            <p>3)Nous nexpedions pas des produits dangereux,toxique,inflammable etc</p>
            <p>4)Nous navons pas des structures appropriees pour conserver les colis perissabletels que:nouriture,animaux</p>
            <p>5)Frais denvoi du colis:10% de la valeur du colis


            <p><strong>N.B.</strong> En cas de perte ou de détérioration du colis Real express rembourse 02 fois au minimum et au maximum 05(cinq) fois la valeur des frais d'expédition.</p>
        </div>
    </div>

    <div style="clear: both;"></div> <!-- Clear floats -->



    <div style="text-align: center;font-size: 15px">
        <p>Le chiffre (1) dans la zone signifie que client a refusé de déclarer la valeur de son colis</p>
        <p style="font-size: 15px;">Merci pour votre fidélité</p>
    </div>
    <div style="display: flex; justify-content: space-between; margin-top: 20px;">
        <div class="inf" style="float: left; width: 50%;">
            <p>Visa de l'argent: <br>{{ $record->agent }}</p>
        </div>
        <div class="inf" style="float: left; width: 30%;">
            <p>Visa client: <br>{{ $record->expeditair}}</p>
        </div>
        <div class="inf" style="float: left; width: 70%;">
            <p>Visa du chef d'agence:</p>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between; margin-top: 50px;">
        <div>
            <p></p>
        </div>
        <div class="inf" style="float: left; width: 55%;">
            <p>Lu et approuvé:</p>
        </div>
        <div class="inf" style="float: left; width: 20%;">
            <p></p>
        </div>
    </div>
    <div class="inf" style="float: left; width: 40%;">
        <p>Date:{{ $record->created_at}}</p>
    </div>
<style>
    * {
        font-size: 12px;

    }

    .inf p {
        margin-bottom: -5px; /* Adjust as needed */

        font-family: 'Times New Roman';
        font-size: 15px;


    }



    @media print {
        body {
            print-color-adjust: exact;

            font-size: 12pt; /* Example for print */

        }
    }




    .inf p {
        margin-bottom: -12px; /* Adjust as needed */

        font-family: 'Times New Roman';
        font-size: 15px;


    }

    .notesup p {
        margin-bottom: -5px; /* Adjust as needed */
        font-size: 13px;
    }
    .form-group {
        margin-bottom: 5px;
    }
    @page {
        margin-bottom: 1mm; /* Adjust as needed */
    }



    @media print {
        body {
            print-color-adjust: exact;

            font-size: 12pt;

        }
    }
</style>
    <script>
        window.print();
    </script>

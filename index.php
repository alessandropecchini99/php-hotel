<!---- ARRAY ASSOCIATIVO ---->
<?php
    $hotels = [
        // 0°
        [
            'name'                  => 'Hotel Belvedere',
            'description'           => 'Hotel Belvedere Descrizione',
            'parking'               => true,
            'vote'                  => 4,
            'distance_to_center'    => 10.4
        ],
        // 1°
        [
            'name'                  => 'Hotel Futuro',
            'description'           => 'Hotel Futuro Descrizione',
            'parking'               => true,
            'vote'                  => 2,
            'distance_to_center'    => 2
        ],
        // 2°
        [
            'name'                  => 'Hotel Rivamare',
            'description'           => 'Hotel Rivamare Descrizione',
            'parking'               => false,
            'vote'                  => 1,
            'distance_to_center'    => 1
        ],
        // 3°
        [
            'name'                  => 'Hotel Bellavista',
            'description'           => 'Hotel Bellavista Descrizione',
            'parking'               => false,
            'vote'                  => 5,
            'distance_to_center'    => 5.5
        ],
        // 4°
        [
            'name'                  => 'Hotel Milano',
            'description'           => 'Hotel Milano Descrizione',
            'parking'               => true,
            'vote'                  => 2,
            'distance_to_center'    => 50
        ],

    ];
?>

<!---- FILTRO ---->
<?php
// creo una variabile dinamica in base alle scelte del select
$filter = $hotels;

// questo filtro gestisce i parcheggi
if (isset($_GET['parking']) && $_GET['parking'] !== 'all') {
    $filter = array_filter($filter, function ($hotel) {
        return $hotel['parking'] === ($_GET['parking'] === 'park');
    });
}

// questo filtro gestisce i voti
if (isset($_GET['vote']) && $_GET['vote'] !== 'all') {
    $filter = array_filter($filter, function ($hotel) {
        return $hotel['vote'] >= $_GET['vote'];
    });
}

// questo filtro gestisce il reset in caso di filtri vuoti
if ($_GET['parking'] == 'all' && $_GET['vote'] == 'all') {
    $filter = $hotels;
}
?>


<!---- INIZIO HTML ---->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
    <title>PHP Hotel</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        form {
            display: flex;
            align-items: flex-end;
        }

        .select {
            display: flex;
            flex-direction: column;
            padding-right: 1em;
        }

        .select label {
            text-align: center;
        }

        select {
            width: fit-content;
            border: 0px;
            border-radius: 10px;
            padding: 5px;
            outline: none;
        }

        button {
            height: fit-content;
            border: 0px;
            border-radius: 10px;
            background-color: grey;
            color: white;
            padding: 5px 10px;
            transition: 0.2s ease;
        }

        button:hover {
            background-color: lightgray;
            color: grey;
            transition: 0.2s ease;
        }

        table {
            cursor: default;
        }
    </style>
</head>

<!---- BODY ---->
<body class="bg-dark text-white">
    <div class="container d-flex flex-column align-items-center pt-5">
        <h1 class="pb-5">PHP Hotel</h1>
        <!-- FORM -->
        <form action="" method="GET" class="d-flex pb-5">
            <div class="select">
                <label for="parking">Parcheggi: </label>
                <select name="parking" id="parking">
                    <option value="all" selected>Tutti gli Hotel</option>
                    <option value="park">Con Parcheggio</option>
                    <option value="noPark">Senza Parcheggio</option>
                </select>
            </div>
            <div class="select">
                <label for="vote">Voto: </label>
                <select name="vote" id="vote">
                    <option value="all" selected>Seleziona</option>
                    <option value="1">1 / 5</option>
                    <option value="2">2 / 5</option>
                    <option value="3">3 / 5</option>
                    <option value="4">4 / 5</option>
                    <option value="5">5 / 5</option>
                </select>
            </div>
            <button type="">Filtra</button>
        </form>

        <!-- TABLE -->
        <table class="table table-dark table-striped">
            <thead>
                <tr> 
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($filter as $value) { ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['description']; ?></td>
                        <td><?php echo $value['parking'] ? 'Sì' : 'No'; ?></td>
                        <td><?php echo "{$value['vote']} / 5"; ?></td>
                        <td><?php echo "{$value['distance_to_center']} km"; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
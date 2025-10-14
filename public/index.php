<?php
// public/index.php

$url = $_GET['url'] ?? '';
$parts = explode('/', trim($url, '/'));

$entity = $parts[0] ?? '';
$action = $parts[1] ?? '';
$id     = $parts[2] ?? null;

$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

// 🩵 Wenn keine Entity angegeben ist → Startseite anzeigen
if ($entity === '' || $entity === null):
    ?>
    <!doctype html>
    <html lang="de">
    <head>

        <meta charset="UTF-8">
        <title>🏠 Startseite</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">


        <style>
            body {
                margin: 0;
                font-family: "Fira Code", sans-serif;
                background-color: #f8f9fa;
                color: #333;
            }

            /* --- Sidebar --- */
            .sidebar {
                width: 220px;
                height: 100vh;
                position: fixed;
                left: 0;
                top: 0;
                background-color: #a082c1;
                color: #2c0953;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding-top: 30px;
                box-shadow: 2px 0 8px rgba(0,0,0,0.2);
            }

            .sidebar h2 {
                font-size: 1.3em;
                margin-bottom: 40px;
            }

            .sidebar a {
                color: white;
                text-decoration: none;
                padding: 10px 15px;
                margin: 8px 0;

                width: 160px;
                text-align: center;
                transition: background 0.3s;
            }

            .sidebar a:hover {
                background-color: #b86dc9;
            }

            /* --- Hauptbereich --- */
            .main {
                margin-left: 220px;
                padding: 50px;
            }

            h1 {
                text-align: center;
                color: #9154c8;
            }

            p {
                text-align: center;
                font-size: 1.1em;
            }

            footer {
                text-align: center;
                margin-top: 60px;
                font-size: 0.9em;
                color: gray;
            }


            .fira-code-uni {
                            font-family: "Fira Code", monospace;
                            font-optical-sizing: auto;
                            font-weight: 300;
                            font-style: normal;
                        }

        </style>
    </head>
    <body>

    <div class="sidebar">
        <h2>🍔Menü</h2>
        <a href="<?= $base ?>/department/read">🏢 Abteilungen</a>
        <a href="<?= $base ?>/employee/read">👔 Mitarbeiter</a>
    </div>

    <div class="main">
        <h1>Willkommen👋</h1>
        <p class="fira-code-uni">Employee and Department Database</p>
        <footer>Made with ❤️ by me. Danke Bitte Ciao!</footer>
    </div>

    </body>
    </html>

    <?php
// 👇 wenn wir hier beenden, geht das Routing weiter unten nicht los
    exit;
endif;

// 🔧 Routing für Departments
if ($entity === 'department') {
    $path = __DIR__ . '/../src/department/';
    switch ($action) {
        case 'create':
            require $path . 'create.php';
            break;
        case 'read':
        case '':
            require $path . 'read.php';
            break;
        case 'view':
            $id = $parts[2] ?? null;
            require $path . 'view.php';
            break;
        case 'update':
            $id = $parts[2] ?? null;
            require $path . 'update.php';
            break;
        case 'delete':
            $id = $parts[2] ?? null;
            require $path . 'delete.php';
            break;
        default:
            http_response_code(404);
            echo '404 - Seite nicht gefunden😭';
    }
    exit;
}

// 🔧 Routing für Employees
if ($entity === 'employee') {
    $path = __DIR__ . '/../src/employee/';
    switch ($action) {
        case 'create':
            require $path . 'create.php';
            break;
        case 'read':
        case '':
            require $path . 'read.php';
            break;
        case 'view':
            require $path . 'view.php';
        case 'update':
            $id = $parts[2] ?? null;
            require $path . 'update.php';
            break;
        case 'delete':
            $id = $parts[2] ?? null;
            require $path . 'delete.php';
            break;
        default:
            http_response_code(404);
            echo '404 - Seite nicht gefunden😭';
    }
    exit;
}

// Fallback
http_response_code(404);
echo '404 - Seite nicht gefunden';

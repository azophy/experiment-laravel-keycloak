<?php
//MVP.css quickstart template: https://github.com/andybrewer/mvp/

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

use Jumbojett\OpenIDConnectClient;

$oidc = new OpenIDConnectClient(getenv('KEYCLOAK_BASE_URL'),
                                getenv('KEYCLOAK_CLIENT_ID'),
                                getenv('KEYCLOAK_CLIENT_SECRET')
                                );
$oidc->setCertPath('/path/to/my.cert');
$oidc->authenticate();
$name = $oidc->requestUserInfo('given_name');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="https://via.placeholder.com/70x70">
    <link rel="stylesheet" href="./mvp.css">

    <meta charset="utf-8">
    <meta name="description" content="My description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Experiment using Keycloak with PHP OIDC Plugin</title>
</head>

<body>
    <header>
        <nav>
            <a href="/"><img alt="Logo" src="https://via.placeholder.com/200x70?text=Logo" height="70"></a>
            <ul>
                <li>Menu Item 1</li>
                <li><a href="#">Menu Item 2</a></li>
                <li><a href="#">Dropdown Menu Item</a>
                    <ul>
                        <li><a href="#">Sublink with a long name</a></li>
                        <li><a href="#">Short sublink</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <h1>
          Experiment using Keycloak with PHP OIDC Plugin
        </h1>
        <p>Page Subheading with <mark>highlighting</mark></p>
        <br>
        <p><a href="#"><i>Italic Link Button</i></a><a href="#"><b>Bold Link Button &rarr;</b></a></p>
    </header>
    <footer>
        <hr>
        <p>
            <small>Contact info</small>
        </p>
    </footer>
</body>

</html>

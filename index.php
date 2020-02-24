<?php
    require_once './src/php/DatabaseObj.php';
    require_once './src/php/Games.php';
    require_once './src/php/Pagination.php';
    $games = new Games();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Games</title>
    <link href="src/css/style.css" rel="stylesheet" type="text/css" media="screen" title="Default" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,800|Press+Start+2P|Roboto:300,400" rel="stylesheet">
</head>
<body>
    <div id="page-wrapper">
        <div id="nav-wrapper">
            <header>
                <a href="index.php">
                    <h1>
                        <span>Games</span>
                    </h1>
                </a>
            </header>
        </div>

        <nav>
            <ul>
                <li><a href="index.php?q=1" class="query-btn">Query 1</a></li>
                <li><a href="index.php?q=2" class="query-btn">Query 2</a></li>
                <li><a href="index.php?q=3" class="query-btn">Query 3</a></li>
                <li><a href="index.php?q=4" class="query-btn">Query 4</a></li>
                <li><a href="index.php?q=5" class="query-btn">Query 5</a></li>
            </ul>
        </nav>

        <div id="inner-page-wrapper">
            <main>
                <?php echo $games->getGames() ?>
            </main>
        </div>
    </div>
</body>
</html>
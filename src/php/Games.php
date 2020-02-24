<?php
/**
 * Class Main
 */
class Games {
    // -------------------------------------------------------
    // PROTECTED PROPERTIES
    // -------------------------------------------------------
    /**
     * New instance of DatabaseObj (connection to database).
     * @var $database
     */
    protected $database;

    // -------------------------------------------------------
    // PUBLIC PROPERTIES
    // -------------------------------------------------------
    /**
     * @var String $listMarkup .
     */
    public $listMarkup;

    // -------------------------------------------------------
    // CONSTANTS (Error messages)
    // -------------------------------------------------------
    const ERRMSG_NONEWRITTEN = "<div class='errmsg'>There are no games in the Database. </div>";

    // -------------------------------------------------------
    // CONSTRUCTOR
    // -------------------------------------------------------
    /**
     * @return null
     */
    public function __construct() {
        $this->database = new DatabaseObj();
    }

    // -------------------------------------------------------
    // PUBLIC METHODS
    // -------------------------------------------------------
    /**
     * HTML-code for results.
     * @return string
     */
    public function parseMarkup() {
        return $markup = '
        %search%
        <table>
            <tr>
                <th>Title</th>
                <th>Release Year</th>
                <th>Developer</th>
                <th>Publisher</th>
                <th>Genre</th>
                <th>Mode</th>
                <th>Platform(s)</th>
            </tr>
                %list%
        </table>
            <div id="pagination">
                <ul>
                    %pagination%
                </ul>
            </div>
        ';
    }

    /**
     * Checks the url after the "q" parameter.
     * @return mixed
     */
    public function getGames(){
        if (empty($_GET['q'])) {
            return $this->getAllGamesList(0);
        } else {
            $qNr = $_GET['q'];
            return $this->getAllGamesList($qNr);
        }
    }

    /**
     * Fetches the result object (mysqli) and returns given number of (5) results and pagination.
     * @return mixed
     */
    public function getAllGamesList($queryNr) {
        $markup = '';
        $gameIxArr = $this->getIndexedArr($this->getArticlesObj($queryNr));
        $pagination = new Pagination(count($gameIxArr),$queryNr);
        $this->listMarkup = $this->parseMarkup();
        $this->listMarkup = str_replace('%pagination%', $pagination->getMarkup(), $this->listMarkup );
        $this->listMarkup = str_replace('%search%', $this->getQueryString($queryNr, count($gameIxArr)), $this->listMarkup );
        for ($i = $pagination->getStartIx(); $i < $pagination->getLen(); $i++){
            $markup .= $this->parseGame($gameIxArr[$i]);
        }
        return str_replace('%list%', $markup, $this->listMarkup);
    }

    /**
     * Returns a search phrase.
     * @param $queryNr
     * @param $nrResults
     * @return string
     */
    public function getQueryString($queryNr, $nrResults){
        $qString = '';
        $qString .= '<img src="src/img/search-icon.svg" alt="search" class="search-icon"> <h2>Showing results for:</h2><h3> ';
        $qString .= $this->queryString($queryNr);
        $qString .= ' <span>(' . $nrResults . ' results)</span></h3>';
        return $qString;
    }

    // -------------------------------------------------------
    // PRIVATE METHODS
    // -------------------------------------------------------
    /**
     * Returns markup for a game, presented as a row in a table.
     * @param $game
     * @return string
     */
    private function parseGame($game) {
        $markup  = "";
        $markup .= "<tr>";
        $markup .= "<td>" . $game->title . "</td>";
        $markup .= "<td>" . $game->release_year . "</td>";
        $markup .= "<td>" . $game->developer . "</td>";
        $markup .= "<td>" . $game->publisher . "</td>";
        $markup .= "<td>" . $game->genre . "</td>";
        $markup .= "<td>" . $game->mode . "</td>";
        $markup .= "<td>" . $game->platforms . "</td>";
        $markup .= "</tr>";
        return $markup;
    }
    /**
     * Returns indexed (numerical) array to use for pagination.
     * @param $results
     * @return array
     */
    private function getIndexedArr($results){
        $indexedArray = array();
        foreach($results as $game) {
            array_push($indexedArray, $game);
        }
        return $indexedArray;
    }

    /**
     * Fetches all games based on given query, and returns result object.
     * @return mixed
     */
    private function getArticlesObj($q){
        $results = $this->database->fetchObjects($this->query($q)
            );
        return $results;
    }

    /**
     * All search phrases.
     * @param $qNr
     * @return string
     */
    private function queryString($qNr) {
        $q = '';
        switch ($qNr) {
            case 0  : $q = 'All games'; break;
            case 1  : $q = 'All games released in 2014'; break;
            case 2  : $q = 'All games by the developer behind Far Cry 4'; break;
            case 3  : $q = 'All games available on the platforms owned by "happydog"'; break;
            case 4  : $q = 'All multiplayer games owned by users <i>happydog</i> and <i>happycat</i>'; break;
            case 5  : $q = 'All games owned by user <i>happycat</i>'; break;

        }
        return $q;
    }

    /**
     * All queries.
     * @param $qNr
     * @return string
     */
    private function query($qNr) {
        $q = '';
        switch ($qNr) {
            case 0  : $q = '
                            SELECT g.title, g.release_year, g.publisher, g.developer, g.genre, g.mode, GROUP_CONCAT( concat(p.name) ORDER BY p.name ASC SEPARATOR \', \' ) as platforms
                            FROM game g
                            LEFT OUTER JOIN gameversion gv ON g.id = gv.game_id
                            LEFT OUTER JOIN platform p ON gv.platform_id = p.id
                            GROUP BY g.title, g.release_year, g.publisher, g.developer, g.genre, g.mode; ';
                            break;
            case 1  : $q = '
                            SELECT g.title, g.release_year, g.publisher, g.developer, g.genre, g.mode, GROUP_CONCAT( concat(p.name) ORDER BY p.name ASC SEPARATOR \', \') platforms
                            FROM game g 
                            LEFT OUTER JOIN gameversion gv ON g.id = gv.game_id
                            LEFT OUTER JOIN platform p ON gv.platform_id = p.id
                            WHERE g.release_year = 2014
                            GROUP BY g.title, g.release_year, g.publisher, g.genre, g.mode, g.developer;';
                            break;
            case 2  : $q = '
                            SELECT g.title, g.release_year, g.publisher, g.developer, g.genre, g.mode, GROUP_CONCAT( concat(p.name) ORDER BY p.name ASC SEPARATOR \', \') platforms
                            FROM game g 
                            LEFT OUTER JOIN gameversion gv ON g.id = gv.game_id 
                            LEFT OUTER JOIN platform p ON gv.platform_id = p.id
                            WHERE g.developer = (SELECT g.developer FROM game g 
                            WHERE g.title = "Far Cry 4" )
                            GROUP BY g.title, g.release_year, g.publisher, g.genre, g.mode, g.developer;';
                            break;
            case 3  : $q = '
                            SELECT g.title, g.release_year, g.publisher, g.developer, g.genre, g.mode, GROUP_CONCAT( concat(p.name) ORDER BY p.name ASC SEPARATOR \', \') platforms
                            FROM game g 
                            LEFT OUTER JOIN gameversion gv ON g.id = gv.game_id 
                            LEFT OUTER JOIN platform p ON gv.platform_id = p.id
                            WHERE p.id IN 
                                (SELECT p.id platformid
                                FROM userplatform up 
                                LEFT OUTER JOIN user u ON up.user_id=u.id 
                                LEFT OUTER JOIN platform p ON up.platform_id=p.id 
                                WHERE u.id = 2)
                            GROUP BY g.title, g.release_year, g.publisher, g.genre, g.mode, g.developer;';
                            break;
            case 4  : $q = '
                            SELECT DISTINCT g.title, g.release_year, g.publisher, g.developer, g.genre, g.mode,  p.name platforms, g.mode
                            FROM usergameversion ugv
                            LEFT OUTER JOIN gameversion gv ON ugv.gameversion_id=gv.id
                            LEFT OUTER JOIN  game g ON gv.game_id=g.id
                            LEFT OUTER JOIN platform p ON gv.platform_id=p.id
                            WHERE mode LIKE "%Multiplayer" AND ugv.gameversion_id IN
                                (SELECT ugv2.gameversion_id 
                                FROM usergameversion ugv2 
                                WHERE ugv2.user_id in (1,2)
                                GROUP BY ugv2.gameversion_id
                                HAVING count(ugv2.gameversion_id) = 2);';
                            break;
            case 5  : $q = '
                            SELECT g.title, g.release_year, g.publisher, g.developer, g.genre, g.mode, GROUP_CONCAT( concat(p.name) ORDER BY p.name ASC SEPARATOR \', \') platforms
                            FROM usergameversion ugv 
                            LEFT OUTER JOIN gameversion gv ON ugv.gameversion_id=gv.id
                            LEFT OUTER JOIN game g ON gv.game_id=g.id
                            LEFT OUTER JOIN platform p ON gv.platform_id=p.id
                            WHERE ugv.user_id = 1
                            GROUP BY g.title, g.release_year, g.publisher, g.genre, g.mode, g.developer;';
                            break;
        }
        return $q;
    }
}
?>
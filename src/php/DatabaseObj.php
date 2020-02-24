<?php
/**
 * Class DatabaseObj
 */
class DatabaseObj {
    // -------------------------------------------------------
    // PROTECTED PROPERTIES
    // -------------------------------------------------------
    /**
     * @var $mysqli Reference to the database.
     */
    protected $database;

    // -------------------------------------------------------
    // CONSTANTS
    // -------------------------------------------------------
    const LOCATION = 'localhost';
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const DATABASE = 'games_db';
    const ERRMSG_CONN = "Oops! Something went wrong, try again later. (Server error)";

    // -------------------------------------------------------
    // CONSTRUCTOR
    // -------------------------------------------------------
    /**
     * Instantiates connection to mysqli database.
     * @return void
     */
    public function __construct() {
        @$this->initDatabase();
    }

    // -------------------------------------------------------
    // PUBLIC METHODS
    // -------------------------------------------------------
    /**
     * Checks if the connection has been established without errors.
     * @return bool
     */
    public function checkDatabaseConn() {
        return ($this->database->connect_errno === 0) ? TRUE : FALSE;
    }

    /**
     * Fetches the result object and returns as an assoc array.
     * @param $query
     * @return mixed
     */
    public function fetchObjects($query) {
        $output = array();
        $results = $this->database->query($query);
        while ($result = $results->fetch_object()) {
            array_push($output, $result);
        }
        return $output;
    }

    // -------------------------------------------------------
    // PRIVATE METHODS
    // -------------------------------------------------------
    /**
     * Creates new mysqli object
     * @return void
     */
    private function initDatabase() {
        $this->database = @new mysqli(
            self::LOCATION,
            self::USERNAME,
            self::PASSWORD,
            self::DATABASE
        );
        if ($this->checkDatabaseConn() == FALSE) die(htmlspecialchars_decode(self::ERRMSG_CONN));
    }
}

?>
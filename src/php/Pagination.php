<?php
/**
 * Class Pagination
 */
class Pagination {
    // -------------------------------------------------------
    // PRIVATE PROPERTIES
    // -------------------------------------------------------
    /**
     * @var String
     * Markup for pagination.
     */
    private $paginationMarkup = '';

    /**
     * @var int Total number of items.
     */
    private $nrOfItems;

    /**
     * @var int Active page number.
     */
    private $activePage = 1;

    private $queryNr = 1;

    // -------------------------------------------------------
    // CONSTRUCTOR
    // -------------------------------------------------------
    /**
     * Pagination constructor.
     * @param int $nrOfItems
     */
    public function __construct($nrOfItems, $queryNr)
    {
        $this->queryNr = $queryNr;
        $this->nrOfItems = $nrOfItems;
        $this->activePage = $this->getActivePage();
        $this->createPagination();
    }

    // -------------------------------------------------------
    // PUBLIC METHODS
    // -------------------------------------------------------

    /**
     * @return String
     */
    public function getMarkup(){
        return $this->paginationMarkup;
    }

    /**
     * Returms HTML for pagination.
     * @return string
     */
    public function createPagination() {
        $page = 1;
        $numberOfPages = ceil($this->nrOfItems / 5);

        $this->paginationMarkup =  $this->previousPageBtn();
        for ($i = 0; $i < $numberOfPages; $i++) {
            ($this->activePage == $page) ? $active = ' class=active' : $active = null;
            if($this->queryNr > 0) {
                $this->paginationMarkup .= "<li><a href='index.php?q=$this->queryNr&page=$page' $active>$page</a></li>";
            } else {
            $this->paginationMarkup .= "<li><a href='index.php?page=$page' $active>$page</a></li>";
            }
            $page++;
        }
        return $this->paginationMarkup .= $this->nextPageBtn($numberOfPages);
    }

    /**
     * Returns start index for the array on active page.
     * @return int
     */
    public function getStartIx() {
        return intval($startIx = ($this->activePage * 5) - 5);
    }

    /**
     * Returns the length for the array on active page.
     * @return int
     */
    public function getLen() {
        $len = ($this->activePage * 5);
        if ($len > $this->nrOfItems) {
            $len = $this->nrOfItems;
        }
        return intval($len);
    }

    // -------------------------------------------------------
    // PRIVATE METHODS
    // -------------------------------------------------------
    /**
     * Returns page number for active page.
     * @return int
     */
    private function getActivePage() {
        return (isset($_GET['page']) && $_GET['page'] != null) ? $activePage = $_GET['page'] : $activePage = 1;
    }

    /**
     * Parse and returns button for previous page.
     * @return string
     */
    private function previousPageBtn() {
        $prevPage = $this->activePage - 1;
        ($this->activePage <= 1) ? $disabled = ' disabled' : $disabled = null;
        if($this->queryNr > 0) {
            return "<li class='prevBtn$disabled'><a href='index.php?q=$this->queryNr&page=$prevPage'>&#10094;</a></li>";
        } else {
            return "<li class='prevBtn$disabled'><a href='index.php?page=$prevPage'>&#10094;</a></li>";
        }
    }

    /**
     * Parse and returns button for next page.
     * @param int $numberOfPages
     * @return string
     */
    private function nextPageBtn($numberOfPages) {
        $nextPage = $this->activePage + 1;
        ($this->activePage >= $numberOfPages) ? $disabled = ' disabled' : $disabled = null;
        if($this->queryNr > 0) {
            return "<li class='nextBtn$disabled'><a href='index.php?q=$this->queryNr&page=$nextPage'>&#10095;</a></li>";
        } else {
            return "<li class='nextBtn$disabled'><a href='index.php?page=$nextPage'>&#10095;</a></li>";
        }
    }
}
?>
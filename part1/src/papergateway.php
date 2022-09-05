<?php

/**
 * Communicates directly with the dis db.
 * 
 * @author Alex Hakesley w16011419
 */

class PaperGateway extends Gateway {
    private $coreStatement = "SELECT paper.paper_id as id,
                                paper.title as title,
                                paper.abstract as abstract,
                                GROUP_CONCAT(author.first_name || ' ' || author.last_name, ', ') authors,
                                award_type.name as award,
                                paper.doi as doi
                            FROM paper
                            INNER JOIN paper_author on (paper.paper_id = paper_author.paper_id)
                            INNER JOIN author on (paper_author.author_id = author.author_id)
                            LEFT JOIN award on (paper.paper_id = award.paper_id)
                            LEFT JOIN award_type on (award.award_type_id = award_type.award_type_id)";
    private $groupByPaperId = " GROUP BY paper.paper_id";

    //replaces " with blanks so ordering is truly alphabetical
    private $orderByPaperTitle = " ORDER BY LOWER(REPLACE(REPLACE(paper.title, '" . '"' . "', ''), '“', ''))";

    public function __construct(){
        $this->setDatabase(DISDB);
    }

    public function findAll() {
        $sql = $this->coreStatement . $this->groupByPaperId . $this->orderByPaperTitle;
        $result = $this->getDatabase()->executeSQL($sql);
        $this->setResult($result);
    }

    public function findRandom() {
        $sql = $this->coreStatement . " WHERE paper.paper_id IN (SELECT paper.paper_id FROM paper ORDER BY RANDOM() LIMIT 1)" . $this->groupByPaperId;
        $result = $this->getDatabase()->executeSQL($sql);
        $this->setResult($result);
    }
    
    public function findById($id) {
        $sql = $this->coreStatement . "WHERE paper.paper_id = :id" . $this->groupByPaperId . $this->orderByPaperTitle;
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function findByAuthorId($id) {
        $sql = $this->coreStatement . " WHERE paper_author.paper_id IN (SELECT paper_author.paper_id FROM paper_author WHERE paper_author.author_id = :id)" . $this->groupByPaperId . $this->orderByPaperTitle;
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function findByAwardId($id) {
        $sql = $this->coreStatement . " WHERE award_type.award_type_id = :id" . $this->groupByPaperId . $this->orderByPaperTitle;
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }


}
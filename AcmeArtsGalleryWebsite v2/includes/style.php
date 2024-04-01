<?php
include 'config.php';

class style extends config
{
    // fetch all styles
    public function styles()
    {
        // select styleId and styleName from styles
        $sql = "SELECT styleId, styleName
                FROM styles";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $results;
    }
}

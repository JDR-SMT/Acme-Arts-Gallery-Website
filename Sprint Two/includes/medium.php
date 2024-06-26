<?php
//  Team Name: MRS Tech
// 	Team Member: Jack Dylan Rendle
// 	Date: 02/04/2024

include 'config.php';

class medium extends config
{
    // fetch all mediums
    public function mediums()
    {
        // select mediumId and mediumName from mediums
        $sql = "SELECT mediumId, mediumName
                FROM mediums";

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

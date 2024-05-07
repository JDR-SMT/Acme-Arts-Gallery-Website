<?php
//  Team Name: MRS Tech
// 	Team Member: Ben Stafford
// 	Date: 19/04/2024

include 'config.php';

class lifespan extends config
{
    // fetch all lifespan
    public function lifespan()
    {
        // select lifespan from artists
        $sql = "SELECT artistLifespan
                FROM artists";

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

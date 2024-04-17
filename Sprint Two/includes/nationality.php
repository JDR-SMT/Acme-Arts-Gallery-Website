<?php
//  Team Name: MRS Tech
// 	Team Member: Jack Dylan Rendle
// 	Date: 17/04/2024

include 'config.php';

class nationality extends config
{
    // fetch all nationalities
    public function nationalities()
    {
        // select nationalityId and nationalityName from nationalities
        $sql = "SELECT nationalityId, nationalityName
                FROM nationalities";

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

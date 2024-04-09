<!--Team Name: MRS Tech
	Team Member: Jack Dylan Rendle
	Date: 02/04/2024-->

<?php
include 'config.php';

class artist extends config
{
    // fetch all artists
    public function artists()
    {
        // select artistId and artistName from artists
        $sql = "SELECT artistId, artistName
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

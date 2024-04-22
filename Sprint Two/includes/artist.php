<?php
//  Team Name: MRS Tech
// 	Team Member: Jack Dylan Rendle
// 	Date: 17/04/2024

include 'config.php';

class artist extends config
{
    // fetch all artists
    public function artists()
    {
        // select all bar artistImage from artists
        $sql = "SELECT a.artistId, a.artistThumbnail, a.artistName, a.artistLifespan, n.nationalityName
                FROM artists a
                INNER JOIN nationalities n ON a.nationalityId = n.nationalityId
                ORDER BY a.artistId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $results;
    }

    // fetch artist by artist id
    public function detailsId($id)
    {
        // select all from artists with artistId
        $sql = "SELECT a.artistId, a.artistImage, a.artistThumbnail, a.artistName, a.artistLifespan, n.nationalityId
                FROM artists a
                INNER JOIN nationalities n ON a.nationalityId = n.nationalityId
                WHERE a.artistId = :artistId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":artistId" => $id]); // bindParam
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $result;
    }

    // update an existing artist by artist id
    public function update($id, $data)
    {
        if (!empty($data)) {
            $fields = "";
            $i = 1;
            $count = count($data);

            // concat column names and column values
            foreach ($data as $field => $value) {
                $fields .= "{$field} = :{$field}";

                if ($i < $count) {
                    $fields .= ", ";
                }

                $i++;
            }
        }

        // update artists with passed column names and column values by artist id
        $sql = "UPDATE artists
                SET {$fields}
                WHERE artistId = :artistId";

        try {
            $stmt = $this->conn->prepare($sql);
            $data["artistId"] = $id; // set field in array as value
            $this->conn->beginTransaction();
            $stmt->execute($data); // bindParams
            $this->conn->commit();
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            $this->conn->rollback();
        }
    }

    // fetch all artist names
    public function artistName()
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
        // fetch artist by nationality id
        public function filterNationality($id)
        {
            // select all from artists with mediumName and styleName
            $sql = "SELECT a.artistId, a.artistThumbnail, a.artistName, a.artistLifespan, n.nationalityName
            FROM artists a
            INNER JOIN nationalities n ON a.nationalityId = n.nationalityId
            WHERE n.nationalityId = :nationalityId";
    
            try {
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([":nationalityId" => $id]); // bindParam
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "ERROR: " . $e->getMessage();
            }
    
            return $results;
        }

        // search for an existing artist by period
        public function filterPeriod($period)
        {
        // select all bar artistThumbnail from artists by period
            $sql = "SELECT a.artistId, a.artistThumbnail, a.artistName, a.artistLifespan, n.nationalityName
            FROM artists a
            INNER JOIN nationalities n ON a.nationalityId = n.nationalityId
            WHERE SUBSTRING(a.artistLifespan, 1, 2) = :artistLifespan";
            
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":artistLifespan" => $period]); // bindParam
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "ERROR: " . $e->getMessage();
            }
            
          return $results;
        }

        // insert a new artist
    public function add($data)
    {
        if (!empty($data)) {
            // create two arrays
            $fields = $placeholders = [];

            // set field array with column names, set placeholder array with column values
            foreach ($data as $field => $value) {
                $fields[] = $field;
                $placeholders[] = ":{$field}";
            }
        }

        // insert artists with passed column names and column values
        $sql = "INSERT artists (" . implode(',', $fields) . ") 
                VALUES (" . implode(',', $placeholders) . ")";

        try {
            $stmt = $this->conn->prepare($sql);
            $this->conn->beginTransaction();
            $stmt->execute($data); // bindParams
            $this->conn->commit();
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            $this->conn->rollback();
        }
    }

        // search for an existing artist by artist name
        public function search($name)
        {
            // select all bar artistThumbnail from artists
            $sql = "SELECT a.artistId
            FROM artists a
            WHERE a.artistName = :artistName";
    
            try {
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([":artistName" => $name]); // bindParam
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "ERROR: " . $e->getMessage();
            }
    
            return $result;
        }
}

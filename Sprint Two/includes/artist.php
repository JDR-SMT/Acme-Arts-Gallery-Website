<?php
//  Team Name: MRS Tech
// 	Team Member: Jack Dylan Rendle, Andrew Millett
// 	Date: 22/04/2024

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
    public function detailsName($id)
    {
        // select all from artists with nationalityName
        $sql = "SELECT a.artistId, a.artistImage, a.artistName, a.artistLifespan, n.nationalityName
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
            $lastInsertedId = $this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertedId;
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            $this->conn->rollback();
        }
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

    // Andrew Millett
    // delete an existing artist by artist id
    public function delete($id)
    {
        try {
			// Check if there are any associated records in the paintings table
			$check_sql = "SELECT COUNT(*) FROM paintings WHERE artistId = :artistId";
			$check_stmt = $this->conn->prepare($check_sql);
			$check_stmt->execute([":artistId" => $id]); // bindParam
			$painting_count = $check_stmt->fetchColumn();
			
			if ($painting_count > 0){
				// If there are associated paintings, handle it appropriately
				$painting_delete_sql = "DELETE FROM paintings WHERE artistId = :artistId";
				$painting_delete_stmt = $this->conn->prepare($painting_delete_sql);
				$painting_delete_stmt->execute([":artistId" => $id]); // bindParam
			}
			
			$artist_delete_sql = "DELETE FROM artists WHERE artistId = :artistId";
			$artist_delete_stmt = $this->conn->prepare($artist_delete_sql);
			$artist_delete_stmt->execute([":artistId" => $id]); // bindParam
			
		} catch (PDOException $e) {
			echo "ERROR: " . $e->getMessage();
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

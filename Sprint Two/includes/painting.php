<?php
//  Team Name: MRS Tech
// 	Team Member: Jack Dylan Rendle, Ben Stafford, Andrew Millett
// 	Date: 09/04/2024

// Jack Dylan Rendle

include 'config.php';

class painting extends config
{
    // fetch all paintings
    public function paintings()
    {
        // select all bar paintingImage from paintings
        $sql = "SELECT p.paintingId, p.paintingThumbnail, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName, s.styleName
                FROM paintings p
                INNER JOIN artists a ON p.artistId = a.artistId
                INNER JOIN mediums m ON p.mediumId = m.mediumId
                INNER JOIN styles s ON p.styleId = s.styleId
                ORDER BY p.paintingId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $results;
    }

    // fetch painting by painting id
    public function detailsName($id)
    {
        // select all from paintings with artistName, mediumName and styleName
        $sql = "SELECT p.paintingId, p.paintingImage, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName, s.styleName
                FROM paintings p
                INNER JOIN artists a ON p.artistId = a.artistId
                INNER JOIN mediums m ON p.mediumId = m.mediumId
                INNER JOIN styles s ON p.styleId = s.styleId
                WHERE p.paintingId = :paintingId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":paintingId" => $id]); // bindParam
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $result;
    }

    // fetch painting by painting id
    public function detailsId($id)
    {
        // select all from paintings with artistId, mediumId and styleId
        $sql = "SELECT p.paintingId, p.paintingImage, p.paintingThumbnail, p.paintingTitle, p.paintingYear, a.artistId, m.mediumId, s.styleId
                FROM paintings p
                INNER JOIN artists a ON p.artistId = a.artistId
                INNER JOIN mediums m ON p.mediumId = m.mediumId
                INNER JOIN styles s ON p.styleId = s.styleId
                WHERE p.paintingId = :paintingId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":paintingId" => $id]); // bindParam
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $result;
    }

    // Ben Stafford
    // fetch painting by style id
    public function filterStyle($id)
    {
        // select all from paintings with artistName and mediumName
        $sql = "SELECT p.paintingId, p.paintingThumbnail, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName
                FROM paintings p
                INNER JOIN artists a ON p.artistId = a.artistId
                INNER JOIN mediums m ON p.mediumId = m.mediumId
                WHERE p.styleId = :styleId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":styleId" => $id]); // bindParam
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $results;
    }

    // Ben Stafford
    // fetch painting by style id
    public function filterArtist($id)
    {
        // select all from paintings with mediumName and styleName
        $sql = "SELECT p.paintingId, p.paintingThumbnail, p.paintingTitle, p.paintingYear, m.mediumName, s.styleName
                FROM paintings p
                INNER JOIN styles s ON p.styleId = s.styleId
                INNER JOIN mediums m ON p.mediumId = m.mediumId
                WHERE p.artistId = :artistId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":artistId" => $id]); // bindParam
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $results;
    }

    // insert a new painting
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

        // insert paintings with passed column names and column values
        $sql = "INSERT paintings (" . implode(',', $fields) . ") 
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

    // update an existing painting by painting id
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

        // update paintings with passed column names and column values by painting id
        $sql = "UPDATE paintings
                SET {$fields}
                WHERE paintingId = :paintingId";

        try {
            $stmt = $this->conn->prepare($sql);
            $data["paintingId"] = $id; // set field in array as value
            $this->conn->beginTransaction();
            $stmt->execute($data); // bindParams
            $this->conn->commit();
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            $this->conn->rollback();
        }
    }

    // Jack Dylan Rendle, Andrew Millett
    // delete an existing painting by painting id
    public function delete($id)
    {
        $sql = "DELETE FROM paintings
                WHERE paintingId = :paintingId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":paintingId" => $id]); // bindParam
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    // search for an existing painting by painting title
    public function search($title)
    {
        // select all bar paintingThumbnail from paintings
        $sql = "SELECT p.paintingId
                FROM paintings p
                WHERE p.paintingTitle = :paintingTitle";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":paintingTitle" => $title]); // bindParam
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $result;
    }
}

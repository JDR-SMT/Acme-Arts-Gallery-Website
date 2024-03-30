<?php
include 'config.php';

class painting extends config
{
    // fetch all paintings
    public function gallery()
    {
        // select all from paintings and inner join artists.artistId, mediums.mediumId and styles.styleId
        $sql = "SELECT p.paintingId, p.paintingThumbnail, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName, s.styleName
                FROM paintings p
                INNER JOIN artists a ON p.artistId = a.artistId
                INNER JOIN mediums m ON p.mediumId = m.mediumId
                INNER JOIN styles s ON p.styleId = s.styleId";

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
    public function details($id)
    {
        // select all from paintings and inner join artists.artistId, mediums.mediumId and styles.styleId where $field = :field
        $sql = "SELECT p.paintingId, p.paintingImage, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName, s.styleName
                FROM paintings p
                INNER JOIN artists a ON p.artistId = a.artistId
                INNER JOIN mediums m ON p.mediumId = m.mediumId
                INNER JOIN styles s ON p.styleId = s.styleId
                WHERE p.{$id} = :{$id}";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":{$id} => {$id}"]); // bindParam
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $result;
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
        $sql = "INSERT paintings ({implode(',', $fields)}) 
                VALUES ({implode(',', $placeholders)})";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data); // bindParams
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    // update an existing painting by painting id
    public function update($id, $data)
    {
        if (!empty($data)) {
            // creates two arrays
            $fields = "";
            $i = 1;
            $count = count($data);

            // set field array with column names, set placeholder array with column values
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
                WHERE {$id} = :{$id}";

        try {
            $stmt = $this->conn->prepare($sql);
            $data['id'] = $id; // add variable id of id value to array
            $stmt->execute($data); // bindParams
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    // delete an existing painting by painting id
    public function delete($id)
    {
        $sql = "DELETE FROM paintings
                WHERE {$id} = :{$id}";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":{$id} => {$id}"]); // bindParam
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    // search for an existing painting by painting title
    public function search($title)
    {
        // select all from paintings and inner join artists.artistId, mediums.mediumId and styles.styleId where $title = :title
        $sql = "SELECT p.paintingId, p.paintingImage, p.paintingTitle, p.paintingYear, a.artistName, m.mediumName, s.styleName
                FROM paintings p
                INNER JOIN artists a ON p.artistId = a.artistId
                INNER JOIN mediums m ON p.mediumId = m.mediumId
                INNER JOIN styles s ON p.styleId = s.styleId
                WHERE p.{$title} = :{$title}";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":{$title} => {$title}"]); // bindParam
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $result;
    }
}

<?php
include 'includes/config.php';

class painting extends config
{
    protected $paintings = "paintings";
    protected $artists = "artists";
    protected $mediums = "mediums";
    protected $styles = "styles";
    protected $artistId = "artistId";
    protected $mediumId = "mediumId";
    protected $styleId = "styleId";

    // fetch all paintings
    public function gallery()
    {
        // select all from paintings and inner join artists.artistId, mediums.mediumId and styles.styleId
        $sql = "SELECT * FROM {$this->paintings}
                INNER JOIN {$this->artists} ON {$this->paintings}.{$this->artistId} = {$this->artists}.{$this->artistId}
                INNER JOIN {$this->mediums} ON {$this->paintings}.{$this->mediumId} = {$this->mediums}.{$this->mediumId}
                INNER JOIN {$this->styles} ON {$this->paintings}.{$this->styleId} = {$this->styles}.{$this->styleId}";

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
        $sql = "SELECT * FROM {$this->paintings}
                INNER JOIN {$this->artists} ON {$this->paintings}.{$this->artistId} = {$this->artists}.{$this->artistId}
                INNER JOIN {$this->mediums} ON {$this->paintings}.{$this->mediumId} = {$this->mediums}.{$this->mediumId}
                INNER JOIN {$this->styles} ON {$this->paintings}.{$this->styleId} = {$this->styles}.{$this->styleId}
                WHERE {$id} = :{$id}";

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
            // creates two arrays
            $fields = $placeholders = [];

            // sets field array with column names, sets placeholder array with column values
            foreach ($data as $field => $value) {
                $fields[] = $field;
                $placeholders[] = ":{$field}";
            }
        }

        // insert paintings with passed column names and column values
        $sql = "INSERT {$this->paintings} ({implode(',', $fields)}) 
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

            // sets field array with column names, sets placeholder array with column values
            foreach ($data as $field => $value) {
                $fields .= "{$field} = :{$field}";

                if ($i < $count) {
                    $fields .= ", ";
                }

                $i++;
            }
        }

        // update paintings with passed column names and column values by painting id
        $sql = "UPDATE {$this->paintings}
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
        $sql = "DELETE FROM {$this->paintings}
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
        $sql = "SELECT * FROM {$this->paintings}
                INNER JOIN {$this->artists} ON {$this->paintings}.{$this->artistId} = {$this->artists}.{$this->artistId}
                INNER JOIN {$this->mediums} ON {$this->paintings}.{$this->mediumId} = {$this->mediums}.{$this->mediumId}
                INNER JOIN {$this->styles} ON {$this->paintings}.{$this->styleId} = {$this->styles}.{$this->styleId}
                WHERE {$title} = :{$title}";

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

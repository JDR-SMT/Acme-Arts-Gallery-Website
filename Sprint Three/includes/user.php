<?php
//  Team Name: MRS Tech
// 	Team Member: Benjamin Stafford
// 	Date: 10/05/2024

include 'config.php';

class user extends config
{
    // fetch all users
    public function users()
    {
        $sql = "SELECT userId, userName, userEmail, 
                CASE WHEN userBreakingNews = 1 THEN 'Subscribed' ELSE 'Not subscribed' END AS breakingNews,
                CASE WHEN userMonthlyNews = 1 THEN 'Subscribed' ELSE 'Not subscribed' END AS monthlyNews
                FROM users
                ORDER BY userId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $results;
    }

    // fetch all inactive users
    public function inactiveUsers()
    {
        // select all inactive users
        $sql = "SELECT userId, userName, userEmail, 
                CASE WHEN userBreakingNews = 1 THEN 'Subscribed' ELSE 'Not subscribed' END AS breakingNews,
                CASE WHEN userMonthlyNews = 1 THEN 'Subscribed' ELSE 'Not subscribed' END AS monthlyNews
                FROM users
                WHERE userActive = 0
                ORDER BY userId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $results;
    }

    // insert a new user
    public function subscribe($data)
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

        // insert users with passed column names and column values
        $sql = "INSERT users (" . implode(',', $fields) . ") 
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

    // set userActive to 0 by userEmail
    public function remove($userEmail)
    {
        try {
            $sql = "UPDATE users SET userActive = 0 WHERE userEmail = :userEmail";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":userEmail" => $userEmail]); // bindParam
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    // delete an existing user by user id
    public function delete($userId)
    {
        try {
            $sql = "DELETE FROM users WHERE userId = :userId";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":userId" => $userId]); // bindParam
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    // search for an existing user by user name
    public function search($name)
    {
        // select all from users
        $sql = "SELECT u.userId, u.userName, u.userEmail, u.userBreakingNews, u.userActive
                FROM users u
                WHERE u.userName = :userName
                ORDER BY u.userId";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":userName" => $name]); // bindParam
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

        return $result;
    }
}

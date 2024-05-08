<?php
//  Team Name: MRS Tech
// 	Team Member: Benjamin Stafford
// 	Date: 8/05/2024

include 'config.php';

class user extends config
{
    // fetch all users
    public function users()
    {
        // select all bar artistImage from artists
        $sql = "SELECT u.userId, u.userName, u.userEmail, u.userBreakingNews, u.userActive
                FROM users u
                ORDER BY u.userId";

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

    // delete an existing user by user id
    public function delete($userId)
    {
        try {
			// Check if there are any associated records in the paintings table
			$check_sql = "SELECT COUNT(*) FROM users WHERE userId = :userId";
			$check_stmt = $this->conn->prepare($check_sql);
			$check_stmt->execute([":userId" => $userId]); // bindParam
			$user_count = $check_stmt->fetchColumn();
			
			if ($user_count > 0){
				// If there are associated users, handle it appropriately
				$user_delete_sql = "DELETE FROM users WHERE userId = :userId";
				$user_delete_stmt = $this->conn->prepare($user_delete_sql);
				$user_delete_stmt->execute([":userId" => $userId]); // bindParam
			}
			
			$user_delete_sql = "DELETE FROM users WHERE userId = :userId";
			$user_delete_stmt = $this->conn->prepare($user_delete_sql);
			$user_delete_stmt->execute([":userId" => $userId]); // bindParam
			
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
        ORDER BY u.userId
        WHERE u.userName = :userName";

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

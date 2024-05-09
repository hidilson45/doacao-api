<?php
class Comments {
    // Connection
    private $conn;
    // Table
    private $db_table = "comments";
    // Columns
    public $id;
    public $event_id;
    public $user_id;
    public $content;

    // Db connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // GET ALL
    public function getComments() {
        $sqlQuery = "SELECT id, event_id, user_id, content FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createComment() {
        $sqlQuery = "INSERT INTO
                    " . $this->db_table . "
                SET
                    event_id = :event_id,
                    user_id = :user_id,
                    content = :content";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->event_id = htmlspecialchars(strip_tags($this->event_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->content = htmlspecialchars(strip_tags($this->content));

        // bind data
        $stmt->bindParam(":event_id", $this->event_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":content", $this->content);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // READ single
    public function getSingleComment() {
        $sqlQuery = "SELECT
                    id,
                    event_id,
                    user_id,
                    content
                FROM
                    " . $this->db_table . "
                WHERE
                    id = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->event_id = $dataRow['event_id'];
        $this->user_id = $dataRow['user_id'];
        $this->content = $dataRow['content'];
    }

    // UPDATE
    public function updateComment() {
        $sqlQuery = "UPDATE
                    " . $this->db_table . "
                SET
                    event_id = :event_id,
                    user_id = :user_id,
                    content = :content
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->event_id = htmlspecialchars(strip_tags($this->event_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":event_id", $this->event_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function deleteComment() {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>

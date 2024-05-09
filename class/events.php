<?php
class Event {
    // Connection
    private $conn;
    // Table
    private $db_table = "events";
    // Columns
    public $EventID;
    public $EventName;
    public $EventDate;
    public $EventTime;
    public $Location;
    public $EventType;
    public $OrganizationName;
    public $DonationMethods;
    public $DonationGoal;
    public $DonationProgress;
    public $EventDescription;
    public $EventImageURL;
    public $EventVideoURL;
    public $Testimonials;

    // Db connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // GET ALL
    public function getEvents() {
        $sqlQuery = "SELECT EventID, EventName, EventDate, EventTime, Location, EventType, OrganizationName, DonationMethods, DonationGoal, DonationProgress, EventDescription, EventImageURL, EventVideoURL, Testimonials FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createEvent() {
        $sqlQuery = "INSERT INTO " . $this->db_table . "
            SET
                EventName = :EventName,
                EventDate = :EventDate,
                EventTime = :EventTime,
                Location = :Location,
                EventType = :EventType,
                OrganizationName = :OrganizationName,
                DonationMethods = :DonationMethods,
                DonationGoal = :DonationGoal,
                DonationProgress = :DonationProgress,
                EventDescription = :EventDescription,
                EventImageURL = :EventImageURL,
                EventVideoURL = :EventVideoURL,
                Testimonials = :Testimonials";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->EventName = htmlspecialchars(strip_tags($this->EventName));
        $this->EventDate = htmlspecialchars(strip_tags($this->EventDate));
        $this->EventTime = htmlspecialchars(strip_tags($this->EventTime));
        $this->Location = htmlspecialchars(strip_tags($this->Location));
        $this->EventType = htmlspecialchars(strip_tags($this->EventType));
        $this->OrganizationName = htmlspecialchars(strip_tags($this->OrganizationName));
        $this->DonationMethods = htmlspecialchars(strip_tags($this->DonationMethods));
        $this->DonationGoal = htmlspecialchars(strip_tags($this->DonationGoal));
        $this->DonationProgress = htmlspecialchars(strip_tags($this->DonationProgress));
        $this->EventDescription = htmlspecialchars(strip_tags($this->EventDescription));
        $this->EventImageURL = htmlspecialchars(strip_tags($this->EventImageURL));
        $this->EventVideoURL = htmlspecialchars(strip_tags($this->EventVideoURL));
        $this->Testimonials = htmlspecialchars(strip_tags($this->Testimonials));

        // bind data
        $stmt->bindParam(":EventName", $this->EventName);
        $stmt->bindParam(":EventDate", $this->EventDate);
        $stmt->bindParam(":EventTime", $this->EventTime);
        $stmt->bindParam(":Location", $this->Location);
        $stmt->bindParam(":EventType", $this->EventType);
        $stmt->bindParam(":OrganizationName", $this->OrganizationName);
        $stmt->bindParam(":DonationMethods", $this->DonationMethods);
        $stmt->bindParam(":DonationGoal", $this->DonationGoal);
        $stmt->bindParam(":DonationProgress", $this->DonationProgress);
        $stmt->bindParam(":EventDescription", $this->EventDescription);
        $stmt->bindParam(":EventImageURL", $this->EventImageURL);
        $stmt->bindParam(":EventVideoURL", $this->EventVideoURL);
        $stmt->bindParam(":Testimonials", $this->Testimonials);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // READ single
    public function getSingleEvent() {
        $sqlQuery = "SELECT
                    EventID,
                    EventName,
                    EventDate,
                    EventTime,
                    Location,
                    EventType,
                    OrganizationName,
                    DonationMethods,
                    DonationGoal,
                    DonationProgress,
                    EventDescription,
                    EventImageURL,
                    EventVideoURL,
                    Testimonials
                FROM
                    " . $this->db_table . "
                WHERE
                    EventID = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->EventID);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->EventName = $dataRow['EventName'];
        $this->EventDate = $dataRow['EventDate'];
        $this->EventTime = $dataRow['EventTime'];
        $this->Location = $dataRow['Location'];
        $this->EventType = $dataRow['EventType'];
        $this->OrganizationName = $dataRow['OrganizationName'];
        $this->DonationMethods = $dataRow['DonationMethods'];
        $this->DonationGoal = $dataRow['DonationGoal'];
        $this->DonationProgress = $dataRow['DonationProgress'];
        $this->EventDescription = $dataRow['EventDescription'];
        $this->EventImageURL = $dataRow['EventImageURL'];
        $this->EventVideoURL = $dataRow['EventVideoURL'];
        $this->Testimonials = $dataRow['Testimonials'];
    }

    // UPDATE
    public function updateEvent() {
        $sqlQuery = "UPDATE
                    " . $this->db_table . "
                SET
                    EventName = :EventName,
                    EventDate = :EventDate,
                    EventTime = :EventTime,
                    Location = :Location,
                    EventType = :EventType,
                    OrganizationName = :OrganizationName,
                    DonationMethods = :DonationMethods,
                    DonationGoal = :DonationGoal,
                    DonationProgress = :DonationProgress,
                    EventDescription = :EventDescription,
                    EventImageURL = :EventImageURL,
                    EventVideoURL = :EventVideoURL,
                    Testimonials = :Testimonials
                WHERE
                    EventID = :EventID";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->EventName = htmlspecialchars(strip_tags($this->EventName));
        $this->EventDate = htmlspecialchars(strip_tags($this->EventDate));
        $this->EventTime = htmlspecialchars(strip_tags($this->EventTime));
        $this->Location = htmlspecialchars(strip_tags($this->Location));
        $this->EventType = htmlspecialchars(strip_tags($this->EventType));
        $this->OrganizationName = htmlspecialchars(strip_tags($this->OrganizationName));
        $this->DonationMethods = htmlspecialchars(strip_tags($this->DonationMethods));
        $this->DonationGoal = htmlspecialchars(strip_tags($this->DonationGoal));
        $this->DonationProgress = htmlspecialchars(strip_tags($this->DonationProgress));
        $this->EventDescription = htmlspecialchars(strip_tags($this->EventDescription));
        $this->EventImageURL = htmlspecialchars(strip_tags($this->EventImageURL));
        $this->EventVideoURL = htmlspecialchars(strip_tags($this->EventVideoURL));
        $this->Testimonials = htmlspecialchars(strip_tags($this->Testimonials));
        $this->EventID = htmlspecialchars(strip_tags($this->EventID));

        // bind data
        $stmt->bindParam(":EventName", $this->EventName);
        $stmt->bindParam(":EventDate", $this->EventDate);
        $stmt->bindParam(":EventTime", $this->EventTime);
        $stmt->bindParam(":Location", $this->Location);
        $stmt->bindParam(":EventType", $this->EventType);
        $stmt->bindParam(":OrganizationName", $this->OrganizationName);
        $stmt->bindParam(":DonationMethods", $this->DonationMethods);
        $stmt->bindParam(":DonationGoal", $this->DonationGoal);
        $stmt->bindParam(":DonationProgress", $this->DonationProgress);
        $stmt->bindParam(":EventDescription", $this->EventDescription);
        $stmt->bindParam(":EventImageURL", $this->EventImageURL);
        $stmt->bindParam(":EventVideoURL", $this->EventVideoURL);
        $stmt->bindParam(":Testimonials", $this->Testimonials);
        $stmt->bindParam(":EventID", $this->EventID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function deleteEvent() {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE EventID = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->EventID = htmlspecialchars(strip_tags($this->EventID));

        $stmt->bindParam(1, $this->EventID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>

<?php
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserData($username) {
        $userDataQuery = "SELECT gender FROM users WHERE username = ?";
        $userDataStmt = $conn->prepare($userDataQuery);
        $userDataStmt->bind_param("s", $username);
        $userDataStmt->execute();
        $userDataResult = $userDataStmt->get_result();
        $userData = $userDataResult->fetch_assoc();
        $gender = $userData['gender'];
        $userDataStmt->close();

        return $gender;
    }

    public function getUserPoints($username) {
        $pointsQuery = "SELECT points FROM users WHERE username = ?";
        $pointsStmt = $conn->prepare($pointsQuery);
        $pointsStmt->bind_param("s", $username);
        $pointsStmt->execute();
        $pointsResult = $pointsStmt->get_result();
        $pointsRow = $pointsResult->fetch_assoc();
        $points = $pointsRow['points'];
        $pointsStmt->close();
        
        return $points;
    }

    public function getUserRank($points) {
        $rankQuery = "SELECT COUNT(*) + 1 AS rank FROM users WHERE points > ?";
        $rankStmt = $conn->prepare($rankQuery);
        $rankStmt->bind_param("i", $points);
        $rankStmt->execute();
        $rankResult = $rankStmt->get_result();
        $rankRow = $rankResult->fetch_assoc();
        $userRank = $rankRow['rank'];
        $rankStmt->close();

        return $rank;
    }

    public function getUserLevel($points) {
        $levels = array(
            0 => array('min' => 0, 'max' => 100),
            1 => array('min' => 101, 'max' => 200),
            2 => array('min' => 201, 'max' => 300),
            3 => array('min' => 301, 'max' => 400),
            4 => array('min' => 401, 'max' => 500),
            5 => array('min' => 501, 'max' => 600),
            6 => array('min' => 601, 'max' => 700),
            7 => array('min' => 701, 'max' => 800),
            8 => array('min' => 801, 'max' => 900),
            9 => array('min' => 901, 'max' => PHP_INT_MAX) 
        );

        foreach ($levels as $level => $range) {
            if ($points >= $range['min'] && $points <= $range['max']) {
                $nextLevelPoints = $range['max'];
                $remainingPoints = $nextLevelPoints - $points;
                $progress = ($points - $range['min']) / ($range['max'] - $range['min']) * 100;
                return array('level' => $level, 'progress' => $progress, 'remainingPoints' => $remainingPoints + 1);
            }
        }
    }

    
       
}
?>
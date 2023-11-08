<?php
require_once('account_model.php');

class UserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
    }

    public function getAccountData($username) {
        $gender = $this->userModel->getUserData($username);
        $points = $this->userModel->getUserPoints($username);
        $rank = $this->userModel->getUserRank($points);
        $level = $this->userModel->getUserLevel($points);
        $progress = $this->userModel->getUserLevel($points);
        $remainingPoints = $this->userModel->getUserLevel($points);

        return array('gender' => $gender, 'points' => $points, 'rank' => $rank, 'level' => $level, 'progress' => $progress, 'remainingPoints' => $remainingPoints);
    }
}
?>
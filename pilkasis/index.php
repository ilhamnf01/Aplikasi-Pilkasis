<?php
session_start();
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Kandidat.php';
require_once __DIR__ . '/models/Voting.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/VotingController.php';

$route = $_GET['route'] ?? '';

// simple routing
if ($route === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();
    $auth->login($_POST);
    exit;
}

if ($route === 'logout') {
    $auth = new AuthController();
    $auth->logout();
    exit;
}

if ($route === 'vote' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $v = new VotingController();
    $v->vote($_POST);
    exit;
}

if ($route === 'hasil') {
    $v = new VotingController();
    $v->results();
    exit;
}

// default views
if (isset($_SESSION['user'])) {
    include __DIR__ . '/views/dashboard.php';
} else {
    include __DIR__ . '/views/login.php';
}

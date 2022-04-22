<?php
    include 'functions.php';
    $db = include 'database/Start.php';

    $id = $_GET['id'];
    $db->delete('posts', $id);

    header('Location: /index.php');
?>
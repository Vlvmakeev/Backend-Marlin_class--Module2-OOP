<?php
    include 'functions.php';
    $db = include 'database/Start.php';

    $db->update('posts', [
        'title' => $_POST['title']
    ], $_GET['id']);

    header('Location: /index.php');
?>
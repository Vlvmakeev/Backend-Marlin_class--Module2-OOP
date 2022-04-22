<?php
    $db = include __DIR__ . '/../database/Start.php';

    $posts = $db->getAll('posts');

    include __DIR__ . '/../index.view.php';
?>
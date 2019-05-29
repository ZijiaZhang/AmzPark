<?php
include_once 'session.php';
initializeSession();
destroySession();
header('Location: index.php');
?>
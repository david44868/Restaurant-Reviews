<?php
    session_start();
    session_unset();
    session_destroy();
    echo 
    "<script>
    alert('Log out successful.');
    window.location.href='login.html';
    </script>";
?>
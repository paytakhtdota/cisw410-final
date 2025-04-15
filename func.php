<?php

function logout()
{
    session_start();
    session_unset();
    session_destroy();

    header("Location: index.php");
    exit();
}

function echo_msg()
{
    if (isset($_GET["msg"])) {
        $msg = htmlspecialchars(urldecode($_GET["msg"]), ENT_QUOTES, 'UTF-8');
        echo '<script>
            setTimeout(function() {
                alert("' . $msg . '");
            }, 200);
        </script>';
    }
}

function redirectToErrorPage($msg)
{
    $url = "error.php&msg=" . urlencode($msg);
    header("Location: " . $url);
}
;
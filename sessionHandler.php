<?php
session_start();
function isLoggedIn()
{
    return isset($_SESSION['id']);
}

function isAdmin()
{
  if (isLoggedIn()) {
        if ($_SESSION['role'] == 'admin') {
            return true;
        }
    }
    return false;
}

function setMessage($message = '', $type = '')
{
    if (!empty($message) && !empty($type)) {
        $_SESSION['message'] = $message;
        $_SESSION['message_type'] = $type;
    }
}

function getMessage()
{
    if (isset($_SESSION['message']) && isset($_SESSION['message_type'])) {
        switch ($_SESSION['message_type']) {
            case 'info':
                echo '<div class="alert alert-primary">' . $_SESSION['message'] . '</div>
                      <script>setTimeout(() => {
                          document.querySelector(".alert").style.display = "none";
                      }, 3000);</script>';
                break;
            case 'error':
                echo '<div class="alert alert-danger">' . $_SESSION['message'] . '</div>
                      <script>setTimeout(() => {
                          document.querySelector(".alert").style.display = "none";
                      }, 3000);</script>';
                break;
            case 'success':
                echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>
                      <script>setTimeout(() => {
                          document.querySelector(".alert").style.display = "none";
                      }, 3000);</script>';
                break;

        }
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
}


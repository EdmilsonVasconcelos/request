<?php
session_start();
unset($_SESSION['has_session_admin'] );
unset($_SESSION['has_session_admin_id']);
unset($_SESSION['has_session_admin_name']);
unset($_SESSION['has_session_admin_email']);
session_destroy();
header("location: ../");
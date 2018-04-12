<?php
/**
 * Created by PhpStorm.
 * User: LEI_Siqi
 * Date: 11/04/2018
 * Time: 22:35
 */

    session_start();

    // Cannot redirect again. Must avoid the infinite redirect loop.
    echo '<h2>You have logged in!</h2>';


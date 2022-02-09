<?php

function view($page, $params = [])
{
    foreach ($params as $key => $param) {
        $$key = $param;
    }
    return require_once 'app/Pages/' . $page . '.php';
}

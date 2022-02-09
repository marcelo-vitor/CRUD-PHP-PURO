<?php

function view($page, $params = [])
{
    foreach ($params as $key => $param) {
        $$key = $param;
    }
    return include 'app/Pages/' . $page . '.php';
}

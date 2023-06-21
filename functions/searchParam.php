<?php

function getParam($groupBy)
{
    $paramRes = mysqli_query($GLOBALS['link'], 'SELECT ' . $groupBy . ' FROM lands GROUP BY ' . $groupBy);
    $arr = array_map(function ($item) use ($groupBy) {
        return $item[$groupBy];
    }, $paramRes->fetch_all(MYSQLI_ASSOC));
    return $arr;
}
$locations = getParam('location');
$size = getParam('size');
sort($size);
$maxPrice = max(getParam('price'));



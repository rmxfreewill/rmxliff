<?php


function getDataFromRoute()
{
    $objData = new stdClass;

    $LinkCode = '';
    if (isset($_POST['LinkCode']))
        $LinkCode = $_POST['LinkCode'];
    if (isset($_GET['LinkCode']))
        $LinkCode = $_GET['LinkCode'];

    $route = '';
    if (isset($_POST['route']))
        $route = $_POST['route'];
    if (isset($_GET['route']))
        $route = $_GET['route'];

    $LineId = '';
    if (isset($_POST['LineId']))
        $LineId = $_POST['LineId'];
    if (isset($_GET['LineId']))
        $LineId = $_GET['LineId'];

    $CmdCommand = '';
    if (isset($_POST['CmdCommand']))
        $CmdCommand = $_POST['CmdCommand'];
    if (isset($_GET['CmdCommand']))
        $CmdCommand = $_GET['CmdCommand'];

    $objData->LinkCode = $LinkCode;
    $objData->route = $route;
    $objData->LineId = $LineId;
    $objData->CmdCommand = $CmdCommand;

    return $objData;
}

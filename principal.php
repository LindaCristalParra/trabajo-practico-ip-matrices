<?php

function manejarError(int $nroError){
    switch($nroError){
        case 1:
            echo "Error: Valor inválido. Por favor, ingrese un número.";
            break;
        case 2:
            echo "Error: La temperatura no fue encontrada.";
            break;
        case 3:
            echo "Error: El año ingresado no existe en la matriz.";
            break;
        case 4:
            echo "Opción inválida. Intente nuevamente.";
            break;
        case 5:
            echo "Mes inválido";
            break;
    }
}

function cargaAutomatica() {

$a_2014=[2014,30,28,26,22,18,12,10,14,17,20,25,29];
$a_2015=[2015,33,30,27,22,19,13,11,15,18,21,26,31];
$a_2016=[2016,34,32,29,21,18,14,12,16,18,21,27,32];
$a_2017=[2017,33,31,28,22,18,13,11,14,17,22,26,31];
$a_2018=[2018,32,30,28,22,17,12,9,13,16,20,24,30];
$a_2019=[2019,32,30,27,23,19,14,12,11,17,23,25,29];
$a_2020=[2020,31,29,28,21,19,13,10,12,16,22,27,29];
$a_2021=[2021,30,28,26,20,16,12,11,13,17,21,28,30];
$a_2022=[2022,31,29,27,21,17,12,11,15,18,22,26,30];
$a_2023=[2023,32,30,27,20,16,13,13,15,19,23,28,31];

$matriz= array($a_2014,$a_2015,$a_2016,$a_2017,$a_2018,$a_2019,$a_2020,$a_2021,$a_2022,$a_2023);

return $matriz;
}
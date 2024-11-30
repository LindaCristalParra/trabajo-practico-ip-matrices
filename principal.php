<?php
function obtenerNombreMes(int $indiceMes) {
    switch($indiceMes) {
            case 1:
                echo "Enero";
                break;
            case 2:
                echo "Febrero";
                break;
            case 3:
                echo "Marzo";
                break;
            case 4:
                echo "Abril";
                break;
            case 5:
                echo "Mayo";
                break;
            case 6:
                echo "Junio";
                break;
            case 7:
                echo "Julio";
                break;
            case 8:
                echo "Agosto";
                break;
            case 9:
                echo "Septiembre";
                break;
            case 10:
                echo "Octubre";
                break;
            case 11:
                echo "Noviembre";
                break;
            case 12:
                echo "Diciembre";
                break;    
            default: 
                manejarError(5);    
            }      
}

function validarAnio(int $anio) {
    if($anio >= 2014 && $anio <= 2023) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function validarMes(int $mes) {
    if($mes >= 1 && $mes <= 12) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function manejarError(int $nroError) {
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

function cargaManual() {
    // Declaración de un arreglo bidimensional para almacenar las temperaturas de cada mes, guardando en el primer índice el año
    $matrizTemp = array();
    $anio = 2014;
    $entradaTemp = 0.0;

    // Recorrer los años (filas de la matriz)
    for ($i = 0; $i < 10; $i++) {
        // Primera columna de cada fila almacena el año correspondiente
        $matrizTemp[$i][0] = $anio;

        // Recorrer los meses (columnas de la matriz)
        for ($j = 1; $j <= 12; $j++) {
            do {
                echo "Ingrese la temperatura para el año $anio y el mes " . obtenerNombreMes($j) . ": ";
                $entradaTemp = trim(fgets(STDIN));

                // Validar si el valor ingresado es numérico
                if (!is_numeric($entradaTemp)) {
                    manejarError(1); // Manejo del error según tu lógica
                }
            } while (!is_numeric($entradaTemp));

            // Almacenar la temperatura en la matriz
            $matrizTemp[$i][$j] = (float)$entradaTemp;
        }

        // Incrementar el año para la siguiente fila
        $anio++;
    }

    // Retornar la matriz con las temperaturas cargadas
    return $matrizTemp;
}

function mostrarDatosMatriz(array $matriz, int $indiceInicial): void {
    $cantAnios = count($matriz); // Obtener la cantidad de años (filas de la matriz)

    for ($i = 0; $i < $cantAnios; $i++) { // Iterar sobre los años
        echo "Año " . $matriz[$i][0] . ": <br>"; // Mostrar el año (primer elemento de la fila)
        $textoMeses = "";

        for ($j = 1; $j < count($matriz[$i]); $j++) { // Iterar sobre los meses de cada año
            $nombreMes = obtenerNombreMes($indiceInicial + $j - 1); // Obtener el nombre del mes
            $textoMeses .= $nombreMes . ": " . $matriz[$i][$j] . ", "; // Concatenar datos
        }

        // Eliminar la última coma y espacio del texto generado
        $textoMeses = substr($textoMeses, 0, -2);
        echo $textoMeses . "<br><br>"; // Mostrar los datos del año
    }
}



function tempAnioMes(array $matriz, int $anio, int $mes) {
    $fila = 0;
    $temp = 0;
    $cantAnios = count($matriz);
    $tempEncontrada = false;

    do {
        if($matriz[$fila][0] == $anio){
            $temp == $matriz[$fila][$mes];
            $tempEncontrada = true;
        }
        $fila++;
    } while($fila < $cantAnios && $tempEncontrada != true);

    if($tempEncontrada == false) {
        manejarError(2);
    }
    echo "La temperatura de ", obtenerNombreMes($mes), " del año ", $anio, " es: ", $temp,  " °C." ;
}

function mostrarTempAnio(array $matriz, int $anioSeleccionado): void {
    $indiceAnio = -1; // Inicializar el índice como no encontrado
    $i = 0; // Inicializar contador
    $cantAnios = count($matriz); // Total de filas (años) en la matriz

    // Búsqueda del índice del año usando un bucle do-while
    do {
        if ($matriz[$i][0] == $anioSeleccionado) {
            $indiceAnio = $i; // Guardar índice si el año coincide
        }
        $i++;
    } while ($indiceAnio == -1 && $i < $cantAnios);

    // Validar si se encontró el año
    if ($indiceAnio == -1) {
        manejarError(3);
        return;
    }

    // Mostrar las temperaturas del año seleccionado
    echo "Año seleccionado: " . $matriz[$indiceAnio][0] . "<br>";
    for ($j = 1; $j <= count($matriz[$indiceAnio])-1; $j++) {
        echo "Mes " . obtenerNombreMes($j) . ": " . $matriz[$indiceAnio][$j] . "<br>";
    }
}


function mostrarTempMesYpromedio(array $matriz, int $mes) {
    $fila = 0;
    $suma = 0;
    $promedio = 0;
    $anios = count($matriz);
    $matrizTempMes = [];
 
    while($fila < $anios){
        $matrizTempMes[$fila][1] = $matriz[$fila][$mes];
        $suma++;
        $fila++;
    }
    $promedio = $suma/$anios;
    echo "La temperatura promedio del mes ", obtenerNombreMes($mes), " es ", $promedio, " ." ;
    echo "Y las temperaturas segun el año son:" ;
    //mostrarDatosMatriz($matrizTempMes, 1);
}

function mostrarTempExtremas(array $matriz): void {
    // Inicializar valores máximos y mínimos con el primer valor de la matriz
    $maximo = $matriz[0][1];
    $minimo = $matriz[0][1];
	
    // Inicializar posiciones del máximo y mínimo
    $posMax = [0, 1]; // Fila y columna del valor máximo
    $posMin = [0, 1]; // Fila y columna del valor mínimo

    // Recorrer la matriz para buscar los máximos y mínimos
    for ($i = 0; $i < count($matriz); $i++) {
        for ($j = 1; $j <= count($matriz[$i]) -1 ; $j++) { // Comenzar en 1 porque la columna 0 contiene el año
            if ($matriz[$i][$j] > $maximo) {
                $maximo = $matriz[$i][$j];
                $posMax = [$i, $j];
            }
            if ($matriz[$i][$j] < $minimo) {
            	
                $minimo = $matriz[$i][$j];
                $posMin = [$i, $j];
            }
            
        }
    }

    // Mostrar resultados
    echo "Máxima temperatura: " . $maximo . "<br>" .
         " Año: " . $matriz[$posMax[0]][0] . 
         " Mes: " . obtenerNombreMes($posMax[1]) . "<br> <br>";

    echo "Mínima temperatura: " . $minimo . "<br>" . 
         " Año: " . $matriz[$posMin[0]][0] . 
         " Mes: " . obtenerNombreMes($posMin[1]) . "<br> <br>";
}

function matrizInvierno(array $matriz) {
    $fila = 0;
    $col = 1;
    $jul = 7;
    $sep = 9;
    $meses = 3;
    $anios = (count($matriz) - 5);
    $matrizTempInvierno =[];

    for($i = $anios; $i <= (count($matriz) - 1); $i++){
        $matrizTempInvierno[$fila][0] = $matriz[$i][0];
        
        for($j = $jul; $i <= $sep; $i++){
            $matrizTempInvierno[$fila][$col] = $matriz[$i][$j];
            $col++;
        }
        $col = 1;
        $fila++;
    }
    //mostrarDatosMatriz($matrizTempInvierno, $jul)
    return $matrizTempInvierno;
}

function matrizAsociativa(array $matriz) {
    $matrizPrimavera = matrizInvierno($matriz) ;
    //$matrizInvierno = matrizPrimavera($matriz) ;
    $matrizAsociativa = array('completa' => $matriz, /*'primavera' => $matrizPrimavera,*/ 'invierno' => $matrizInvierno);
    echo "Datos de la matriz completa: " ;
    //mostrarDatosMatriz($matrizAsociativa['completa'], 1)
    echo "Datos de la matriz primavera: " ;
    //mostrarDatosMatriz($matrizAsociativa['primavera'], 1)
    echo "Datos de la matriz invierno: " ;
    //mostrarDatosMatriz($matrizAsociativa['invierno'], 1)

    return $matrizAsociativa;
}

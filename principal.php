<?php
function obtenerNombreMes(int $indiceMes) {
    switch($indiceMes) {
            case 1:
                return "Enero";
                break;
            case 2:
                return "Febrero";
                break;
            case 3:
                return "Marzo";
                break;
            case 4:
                return "Abril";
                break;
            case 5:
                return "Mayo";
                break;
            case 6:
                return "Junio";
                break;
            case 7:
                return "Julio";
                break;
            case 8:
                return "Agosto";
                break;
            case 9:
                return "Septiembre";
                break;
            case 10:
                return "Octubre";
                break;
            case 11:
                return "Noviembre";
                break;
            case 12:
                return "Diciembre";
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
        echo "Año " . $matriz[$i][0] . ": \n"; // Mostrar el año (primer elemento de la fila)
        $textoMeses = "";

        for ($j = 1; $j < count($matriz[$i]); $j++) { // Iterar sobre los meses de cada año
            $nombreMes = obtenerNombreMes($indiceInicial + $j - 1); // Obtener el nombre del mes
            $textoMeses .= $nombreMes . ": " . $matriz[$i][$j] . ", "; // Concatenar datos
        }

        // Eliminar la última coma y espacio del texto generado
        $textoMeses = substr($textoMeses, 0, -2);
        echo $textoMeses . "\n\n"; // Mostrar los datos del año
    }
}



function mostrarTempAnioMes(array $matriz, int $anio, int $mes) {
    $fila = 0;
    $temp = 0;
    $cantAnios = count($matriz);
    $tempEncontrada = false;

    do {
        if($matriz[$fila][0] == $anio){
            $temp = $matriz[$fila][$mes];
            $tempEncontrada = true;
        }
        $fila++;
    } while($fila < $cantAnios && $tempEncontrada != true);

    if($tempEncontrada == false) {
        manejarError(2);
    }
    echo "La temperatura de ", obtenerNombreMes($mes), " del año ", $anio, " es: ", $temp,  " °C.\n" ;
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
    echo "Año seleccionado: " . $matriz[$indiceAnio][0] . "\n";
    for ($j = 1; $j <= count($matriz[$indiceAnio])-1; $j++) {
        echo "Mes " . obtenerNombreMes($j) . ": " . $matriz[$indiceAnio][$j] . "\n";
    }
}


function mostrarTempMesYpromedio(array $matriz, int $mes) {
    $fila = 0;
    $suma = 0;
    $promedio = 0;
    $anios = count($matriz);
    $matrizTempMes = [];
 
    while($fila < $anios){
        $matrizTempMes[$fila][0] = $matriz[$fila][0];
        $matrizTempMes[$fila][1] = $matriz[$fila][$mes];
        $suma= $suma+$matriz[$fila][$mes];
        $fila++;
    }
    $promedio = $suma/$anios;
    echo "La temperatura promedio del mes ", obtenerNombreMes($mes), " es ", $promedio, " ." ;
    echo "Y las temperaturas segun el año son: \n" ;
    mostrarDatosMatriz($matrizTempMes, $mes);
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
    echo "Máxima temperatura: " . $maximo . "\n" .
         " Año: " . $matriz[$posMax[0]][0] . 
         " Mes: " . obtenerNombreMes($posMax[1]) . "\n \n";

    echo "Mínima temperatura: " . $minimo . "\n" . 
         " Año: " . $matriz[$posMin[0]][0] . 
         " Mes: " . obtenerNombreMes($posMin[1]) . "\n \n";
}

function matrizPrimavera(array $matriz): array {
    // Inicializar la matriz de primavera
    $matrizPrimavera = [];

    // Recorrer cada fila de la matriz original
    for ($i = 0; $i < count($matriz); $i++) {
        // Crear una fila en la matriz de primavera con el año y las temperaturas de los meses seleccionados
        $filaPrimavera = [];
        $filaPrimavera[0] = $matriz[$i][0]; // Guardar el año
        for ($j = 1; $j <= 3; $j++) {
            $filaPrimavera[$j] = $matriz[$i][9 + $j]; // Guardar octubre, noviembre y diciembre
        }
        // Agregar la fila a la matriz de primavera
        $matrizPrimavera[] = $filaPrimavera;
    }

    // Mostrar los datos de la matriz de primavera
    mostrarDatosMatriz($matrizPrimavera, 10);

    // Retornar la matriz de primavera
    return $matrizPrimavera;
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
        
        for($j = $jul; $j <= $sep; $j++){
            $matrizTempInvierno[$fila][$col] = $matriz[$i][$j];
            $col++;
        }
        $col = 1;
        $fila++;
    }
    mostrarDatosMatriz($matrizTempInvierno, $jul);
    return $matrizTempInvierno;
}

function matrizAsociativa(array $matriz) {

    echo "Datos de la matriz completa: \n" ;
    mostrarDatosMatriz($matriz, 1) ;

    echo "Datos de la matriz primavera: \n" ;
    $matrizPrimavera = matrizPrimavera($matriz) ;

    echo "Datos de la matriz invierno: \n" ;
    $matrizInvierno = matrizInvierno($matriz) ;
    $matrizAsociativa = array('completa' => $matriz, 'primavera' => $matrizPrimavera, 'invierno' => $matrizInvierno);

    return $matrizAsociativa;
}

// PROGRAMA principal(): Control de temperaturas en Neuquén durante los últimos 10 años.
    // Declaración de variables
    $matrizTemperaturas = array(); // Matriz para almacenar temperaturas de 10 años y 12 meses + promedio anual
    $inicializarManual = "";       // Variable para determinar si la carga de datos es manual o automática
    $matrizPrimavera = array();    // Matriz para almacenar temperaturas de primavera (octubre-diciembre) por año
    $matrizInvierno = array();     // Matriz para almacenar temperaturas de invierno (julio-septiembre) de los últimos 5 años
    $matrizAsociativa = array();   // Matriz asociativa para consolidar todas las matrices
    $opcionMenu = -1;              // Variable para guardar la opción seleccionada del menú
    $mes = 0;                      // Variable para almacenar el mes ingresado
    $anio = 0;                     // Variable para almacenar el año ingresado

    // Inicio del programa: mensaje de bienvenida
    echo "Bienvenido al programa para llevar control de las temperaturas de la ciudad de Neuquén considerando los últimos 10 años\n";
    echo "¿Desea operar cargando manualmente las temperaturas? (s/n): ";
    $inicializarManual = trim(fgets(STDIN));

    // Determina el modo de carga de datos (manual o automática)
    if ($inicializarManual === "s") {
        $matrizTemperaturas = cargaManual(); // Llama a la función para cargar datos manualmente
    } else {
        echo "Se cargarán datos automáticos para iniciar el programa\n";
        $matrizTemperaturas = cargaAutomatica(); // Llama a la función para cargar datos automáticamente
    }

    // Menú principal del programa
    do {
        echo "Menú de opciones:\n";
        echo "1. Cargar matriz de temperaturas automáticamente.\n";
        echo "2. Cargar matriz de temperaturas manualmente.\n";
        echo "3. Mostrar contenido de la matriz.\n";
        echo "4. Mostrar temperatura de un año y mes específicos.\n";
        echo "5. Mostrar temperaturas de todos los meses de un año.\n";
        echo "6. Mostrar temperaturas de un mes en todos los años y su promedio.\n";
        echo "7. Mostrar temperaturas máximas y mínimas con año y mes.\n";
        echo "8. Crear y mostrar matriz de primavera (oct-nov-dic).\n";
        echo "9. Crear y mostrar matriz de invierno (jul-ago-sep) de últimos 5 años.\n";
        echo "10. Crear arreglo asociativo con todas las matrices.\n";
        echo "0. Salir.\n";
        echo "Seleccione una opción, ingresando el número: ";
        $opcionMenu = (int) trim(fgets(STDIN));

        // Ejecución de opciones del menú
        switch ($opcionMenu) {
            case 1:
                $matrizTemperaturas = cargaAutomatica();
                break;
            case 2:
                $matrizTemperaturas = cargaManual();
                break;
            case 3:
                mostrarDatosMatriz($matrizTemperaturas, 1);
                break;
            case 4:
                echo "Ingrese año: ";
                $anio = (int) trim(fgets(STDIN));
                echo "Ingrese mes: ";
                $mes = (int) trim(fgets(STDIN));
                if (validarAnio($anio) && validarMes($mes)) {
                    mostrarTempAnioMes($matrizTemperaturas, $anio, $mes);
                } else {
                    echo "Datos inválidos, por favor ingresar un año entre 2014 y 2023 y un mes entre 1 y 12.\n";
                }
                break;
            case 5:
                echo "Ingrese año: ";
                $anio = (int) trim(fgets(STDIN));
                if (validarAnio($anio)) {
                    mostrarTempAnio($matrizTemperaturas, $anio);
                } else {
                    echo "Datos inválidos, por favor ingresar un año entre 2014 y 2023.\n";
                }
                break;
            case 6:
                echo "Ingrese mes: ";
                $mes = (int) trim(fgets(STDIN));
                if (validarMes($mes)) {
                    mostrarTempMesYpromedio($matrizTemperaturas, $mes);
                } else {
                    echo "Datos inválidos, por favor ingresar un mes entre 1 y 12.\n";
                }
                break;
            case 7:
                mostrarTempExtremas($matrizTemperaturas);
                break;
            case 8:
                $matrizPrimavera = matrizPrimavera($matrizTemperaturas);
                break;
            case 9:
                $matrizInvierno = matrizInvierno($matrizTemperaturas);
                break;
            case 10:
                $matrizAsociativa = matrizAsociativa($matrizTemperaturas);
                break;
            case 0:
                echo "Saliendo del programa.\n";
                break;
            default:
                manejarError(4);
                echo "Opción inválida. Intente nuevamente.\n";
                break;
        }
    } while ($opcionMenu !== 0);


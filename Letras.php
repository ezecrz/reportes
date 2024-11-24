<?php 
/*
// Numeros
// =======
// 
// Conversiones de numeros PHP
// 
// Clase original de Felix de Jesus Carrillo Celerino (dcreate)
//  https://github.com/dcreate/Numeros/blob/master/letras.php
// 
// 
// Modificada por Miquel Botanch
// 
// Cambios:
// 
//    * He adaptado el código para que muestre dos decimales.
// 
//    * Permite especificar nombres de moneda y de su centésima parte en singular y plural.
// 
//    * Permite de manera opcional substituir un_mil por mil (como en el castellano de España)
// 
//    * Adaptado para que sea directamente compatible con la versión original, por si se actualiza la clase,
//      NO SEA NECESARIO corregir las llamadas a lHa función ValorEnLetras().  (ya que ahora tiene 5 parámetros en vez de 2)
// 
//    * Añadida variable $anadir_MN_al_final para añadir M.N. al final de la cadena (en España no se usa este acrónimo)
//
*/
class EnLetras 
{ 
  var $Void = ""; 
  var $SP = " "; 
  var $Dot = "."; 
  var $Zero = "0"; 
  var $Neg = "Menos"; 
  var $substituir_un_mil_por_mil = true;
  var $anadir_MN_al_final = true;
  var $tratar_decimales = true;
function ValorEnLetras($number, $currencySingular, $currencyPlural, $decimalSingular, $decimalPlural) {
    // ... other variables and initializations

    // Extract integer and decimal parts
    $integerPart = intval($number);
    $decimalPart = number_format($number, 2, '.', '') - $integerPart;

    // Convert integer part to words
    $words = convertNumberToWords($integerPart);

    // Handle decimals based on a flag
    if ($this->tratar_decimales) {
        $decimalWords = convertNumberToWords($decimalPart * 100);
        $words .= " con " . $decimalWords . " " . $decimalPlural;
    } else {
        // ... handle decimals as fractions
    }

    // Handle currency
    $currency = $integerPart == 1 ? $currencySingular : $currencyPlural;
    $words .= " " . $currency;

    return $words;
}

function convertNumberToWords($number) {
    // ... implementation for converting numbers to words
}
//    $letrass=$Signo . $s;
    return ($Signo . $s ).($this->tratar_decimales?"":""); 
    
} 
function SubValLetra($numero)
{ 
    $Ptr=""; 
    $n=0; 
    $i=0; 
    $x =""; 
    $Rtn =""; 
    $Tem =""; 
    $x = trim("$numero"); 
    $n = strlen($x); 
    $Tem = $this->Void; 
    $i = $n; 
     
    while( $i > 0) 
    { 
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1).  
                           str_repeat($this->Zero, $i - 1 ))); 
       If( $Tem != "Cero" ) 
          $Rtn .= $Tem . $this->SP; 
       $i = $i - 1; 
    } 
     
    //--------------------- GoSub FiltroMil ------------------------------ 
    $Rtn=str_replace(" Mil Mil", " Un Mil", $Rtn ); 
    while(1) 
    { 
       $Ptr = strpos($Rtn, "Mil ");        
       If(!($Ptr===false)) 
       { 
          If(! (strpos($Rtn, "Mil ",$Ptr + 1) === false )) 
            $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr); 
          Else 
           break; 
       } 
       else break; 
    } 
    //--------------------- GoSub FiltroCiento ------------------------------ 
    $Ptr = -1; 
    do{ 
       $Ptr = strpos($Rtn, "Cien ", $Ptr+1); 
       if(!($Ptr===false)) 
       { 
          $Tem = substr($Rtn, $Ptr + 5 ,1); 
          if( $Tem == "M" || $Tem == $this->Void) 
             ; 
          else
             $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr); 
       } 
    }while(!($Ptr === false)); 
    //--------------------- FiltroEspeciales ------------------------------ 
    $Rtn=str_replace("Diez Un", "Once", $Rtn ); 
    $Rtn=str_replace("Diez Dos", "Doce", $Rtn ); 
    $Rtn=str_replace("Diez Tres", "Trece", $Rtn ); 
    $Rtn=str_replace("Diez Cuatro", "Catorce", $Rtn ); 
    $Rtn=str_replace("Diez Cinco", "Quince", $Rtn ); 
    $Rtn=str_replace("Diez Seis", "Dieciseis", $Rtn ); 
    $Rtn=str_replace("Diez Siete", "Diecisiete", $Rtn ); 
    $Rtn=str_replace("Diez Ocho", "Dieciocho", $Rtn ); 
    $Rtn=str_replace("Diez Nueve", "Diecinueve", $Rtn ); 
    $Rtn=str_replace("Veinte Un", "Veintiun", $Rtn ); 
    $Rtn=str_replace("Veinte Dos", "Veintidos", $Rtn ); 
    $Rtn=str_replace("Veinte Tres", "Veintitres", $Rtn ); 
    $Rtn=str_replace("Veinte Cuatro", "Veinticuatro", $Rtn ); 
    $Rtn=str_replace("Veinte Cinco", "Veinticinco", $Rtn ); 
    $Rtn=str_replace("Veinte Seis", "Veintiseís", $Rtn ); 
    $Rtn=str_replace("Veinte Siete", "Veintisiete", $Rtn ); 
    $Rtn=str_replace("Veinte Ocho", "Veintiocho", $Rtn ); 
    $Rtn=str_replace("Veinte Nueve", "Veintinueve", $Rtn ); 
    //--------------------- FiltroUn ------------------------------ 
    If(substr($Rtn,0,1) == "M") $Rtn = "Un " . $Rtn; 
    //--------------------- Adicionar Y ------------------------------ 
    for($i=65; $i<=88; $i++) 
    { 
      If($i != 77) 
         $Rtn=str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn); 
    } 
    $Rtn=str_replace("*", "a" , $Rtn); 
    return($Rtn); 
} 
function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr); 
} 
function Parte($x)
{ 
    $Rtn=''; 
    $t=''; 
    $i=''; 
    Do 
    { 
      switch($x) 
      { 
         Case 0:  $t = "Cero";break; 
         Case 1:  $t = "Un";break; 
         Case 2:  $t = "Dos";break; 
         Case 3:  $t = "Tres";break; 
         Case 4:  $t = "Cuatro";break; 
         Case 5:  $t = "Cinco";break; 
         Case 6:  $t = "Seis";break; 
         Case 7:  $t = "Siete";break; 
         Case 8:  $t = "Ocho";break; 
         Case 9:  $t = "Nueve";break; 
         Case 10: $t = "Diez";break; 
         Case 20: $t = "Veinte";break; 
         Case 30: $t = "Treinta";break; 
         Case 40: $t = "Cuarenta";break; 
         Case 50: $t = "Cincuenta";break; 
         Case 60: $t = "Sesenta";break; 
         Case 70: $t = "Setenta";break; 
         Case 80: $t = "Ochenta";break; 
         Case 90: $t = "Noventa";break; 
         Case 100: $t = "Cien";break; 
         Case 200: $t = "Doscientos";break; 
         Case 300: $t = "Trescientos";break; 
         Case 400: $t = "Cuatrocientos";break; 
         Case 500: $t = "Quinientos";break; 
         Case 600: $t = "Seiscientos";break; 
         Case 700: $t = "Setecientos";break; 
         Case 800: $t = "Ochocientos";break; 
         Case 900: $t = "Novecientos";break; 
         Case 1000: $t = "Mil";break; 
         Case 2000: $t = "Dos Mil";break;
         Case 3000: $t = "Tres Mil";break;
         Case 4000: $t = "Cuatro Mil";break;
         Case 5000: $t = "Cinco Mil";break;
         Case 6000: $t = "Seis Mil";break;
         Case 7000: $t = "Siete Mil";break;
         Case 8000: $t = "Ocho Mil";break;
         Case 9000: $t = "Nueve Mil";break;
         Case 10000: $t = "Diez Mil";break;
         Case 11000: $t = "Once Mil";break;
         Case 1000000: $t = "Millón";break; 
      } 
      If($t == $this->Void) 
      { 
        $i = $i + 1; 
        $x = $x / 1000; 
        If($x== 0) $i = 0; 
      } 
      else 
         break; 
            
    }while($i != 0); 
    
    $Rtn = $t; 
    Switch($i) 
    { 
       Case 0: $t = $this->Void;break; 
       Case 1: $t = " Mil";break; 
       Case 2: $t = " Millones";break; 
       Case 3: $t = " Billones";break; 
    } 
    return($Rtn . $t); 
} 
} 
//-------------- Programa principal ------------------------ 




?>

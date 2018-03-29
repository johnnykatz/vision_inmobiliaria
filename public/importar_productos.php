<?php

$categorias = array(
    'ALIMENTOS' => 1,
    'ASEOHOGAR' => 2,
    'ASEOPERSONAL' => 3,
    'CALDOS' => 4,
    'CEREALES' => 5,
    'COLADAS' => 6,
    'HARINA' => 7,
    'SALSAS' => 13,
    'DETERGENTE' => 11,
    'CREMACARA' => 9,
    'DESODORANTE' => 10,
    'JABON' => 12,
    'ACONDICIONADOR' => 8,
    'SHAMPOO' => 14,
    'TALCO' => 15,
);

$marcas = array(
    'KNORR' => 2,
    'MAIZENA' => 3,
    'FRUCO' => 4,
    'FAB' => 8,
    'SEDAL' => 13,
    'AXE' => 5,
    'PURO' => 11,
    'VELROSITA' => 15,
    'DOVE' => 7,
    'TRESEMME' => 14,
    'POND´S' => 10,
    'REXONA' => 12,
    'LUX' => 9,
    'CLEAR' => 6
);

//$con = mysqli_connect('localhost', 'tiendapp_dev', 'vnefn345inuevfin'); //server test
//mysqli_select_db($con, 'tiendapp_dev');


$con = mysqli_connect('localhost', 'root', 'root'); //local
mysqli_select_db($con, 'tiendapp');


if (($fichero = fopen("productos.csv", "r")) !== FALSE) {

    $i = 0;
    while (($datos = fgetcsv($fichero, 1000, ";")) !== FALSE) {

        $marca = $marcas[str_replace(' ', '', $datos[6])];
        $sql = "INSERT INTO productos(nombre, cod_sap, descripcion, visible, valor, variante, presentacion, tamanio, ean, pedido_minimo, pedido_maximo, marca_id, created_at, updated_at, valor_sugerido, valor_unidad_venta, embalaje_unidad_venta) 
  VALUES (
  '$datos[7]',
  '$datos[4]',
   '',
    true,
     '$datos[12]',
      '$datos[8]',
       '$datos[9]',
        '$datos[10]',
         '$datos[5]',
          '1',
           '$datos[15]',
            $marca,'" .
            date('Y-m-d H:i:s') . "','" .
            date('Y-m-d H:i:s') . "',
             '$datos[17]',
             '$datos[14]',
             '$datos[13]'
  )";

        $result = mysqli_query($con, $sql);
        $producto_id = null;
        $producto_id = mysqli_insert_id($con);

        $string = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
        $extension = 'jpg';
        $nombreImagen = $string . '.' . $extension;

        $sql = "INSERT INTO medias (url,descripcion,tipo_media_id,producto_id)VALUES(
 '" . $nombreImagen . "','principal',1," . $producto_id . "
)";
        $result = mysqli_query($con, $sql);

        rename("imagenes/productos/" . $datos[0] . '.' . $extension, "imagenes/productos/" . $nombreImagen);
//echo $sql;
//        exit;

        $categoria = $categorias[str_replace(' ', '', $datos[2])];
        $subcategoria = $categorias[str_replace(' ', '', $datos[3])];

        $sql = "INSERT INTO categoria_producto (categoria_id,producto_id)VALUES($categoria,$producto_id)";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO categoria_producto (categoria_id,producto_id)VALUES($subcategoria,$producto_id)";
        $result = mysqli_query($con, $sql);


        //consulto si es oferta
        if ($datos[16] != '') {

            $sql = "INSERT INTO ofertas (valor_producto,ahorro_oferta,descripcion,fecha_inicio,fecha_fin,producto_id)VALUES(
 '" . $datos[12] . "',10,'" . $datos[11] . "','" . date('Y-m-d H:i:s') . "','2016-12-12 00:00:00'," . $producto_id . "
)";
//            echo $sql;
//            exit();
            $result = mysqli_query($con, $sql);

        }

    }
}


function obtenerExtension($string)
{
    $stringArray = explode(".", $string);
    return $stringArray[count($stringArray) - 1];
}

?>
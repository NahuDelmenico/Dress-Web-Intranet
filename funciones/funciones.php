<?php 

function getCatalogoFiltrado($productos, $categoria){

    $arrayFiltrado = [];
    
    if($categoria == null){


        return $productos;
    }else{
    
        foreach ($productos as $p) {
            if($p['categoria'] == $categoria){
                $arrayFiltrado[] = $p;
            }
        }
    
        return $arrayFiltrado;
    }
    
}
function getUsuariosFiltrado($productos, $categoria){

    $arrayFiltrado = [];
    
    if($categoria == null){


        return $productos;
    }else{
    
        foreach ($productos as $p) {
            if($p['rol'] == $categoria){
                $arrayFiltrado[] = $p;
            }
        }
    
        return $arrayFiltrado;
    }
    
}

?>
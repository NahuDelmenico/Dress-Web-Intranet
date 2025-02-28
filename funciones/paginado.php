<?php
function paginador_lista($producto, $pagina_actual, $cuantos_por_pagina)
{
    if (is_array($producto) && count($producto) > 0 && is_numeric($pagina_actual) && $pagina_actual > 0 && is_numeric($cuantos_por_pagina) && $cuantos_por_pagina > 0) {
        $desde = ($pagina_actual - 1) * $cuantos_por_pagina;
        return array_splice($producto, $desde, $cuantos_por_pagina);
    } else {
        return []; 
    }
}

function paginador_enlaces($cantidad, $pagina_actual, $cuantos_por_pagina)
{
    if (is_numeric($cantidad) && $cantidad > 0 && is_numeric($cuantos_por_pagina) && $cuantos_por_pagina > 0) {
        $cantidad_paginas = ceil($cantidad / $cuantos_por_pagina);

        return array(
            'cantidad' => $cantidad_paginas,
            'actual' => $pagina_actual,
            'anterior' => ($pagina_actual > 1) ? ($pagina_actual - 1) : null,
            'siguiente' => ($pagina_actual < $cantidad_paginas) ? ($pagina_actual + 1) : null,
            'primero' => ($pagina_actual > 1) ? 1 : null,
            'ultimo' => ($pagina_actual < $cantidad_paginas) ? $cantidad_paginas : null
        );
    }
    return []; 
}

function paginador_usuario($usuarios, $pagina_actual, $cuantos_por_pagina)
{
    if (is_array($usuarios) && count($usuarios) > 0 && is_numeric($pagina_actual) && $pagina_actual > 0 && is_numeric($cuantos_por_pagina) && $cuantos_por_pagina > 0) {
        $desde = ($pagina_actual - 1) * $cuantos_por_pagina;
        return array_slice($usuarios, $desde, $cuantos_por_pagina);
    } else {
        return [];
    }
}
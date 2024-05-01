<?php 

/**
 * Безопасно возвращает параметр из get запроса
 *
 * @param string $param
 * @return void
 */
function getValueByKey(string $key, $default = null) 
{
    return $_GET[$key] ?? $default;
}
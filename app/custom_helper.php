<?php

if(!function_exists('get_formatted_date')){

    function get_formatted_date($date,$format){

        $formatedDate = date($format,strtotime($date));
        return $formatedDate;
    }
}
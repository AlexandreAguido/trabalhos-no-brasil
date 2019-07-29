<?php

if(!function_exists('pretty_creation_date')){
    function pretty_creation_date($date_created_str){
        /*
        *Calculate time diff between creation date and now
        * return 'Hoje' if diff is less than 24 hours
        * return 'Ontem' if diff is less than 48 hours
        * return dd/mm/ otherwise
        */
        $date_created = new Datetime($date_created_str);
        $interval = $date_created->diff(new Datetime());
        $days_diff = $interval->format('%a');
        if($days_diff == 0){return 'Hoje';}
        if($days_diff == 1){return 'Ontem';}
        return $date_created->format('d/m');
    }
}

if(!function_exists('is_mobile_request')){
    function is_mobile_request($request){
        $user_agent = $request->server('HTTP_USER_AGENT');
        if(strpos($user_agent, "Windows Phone")  || strpos($user_agent, "iPhone") ||  
        strpos($user_agent, "Android")){
            return true;
        }
        return false;

    }
}

if(!function_exists('pagination_url_pretty')){
    function pagination_url_pretty($url, $page){
        // change url page number
        if(strpos($url, "page=")){
            $patt = '/page=\d+/';
            $repl = 'page=' . $page;
            $url = preg_replace($patt, $repl, $url);
        }
        else{
            $url = $url . "?&page=" . $page;
        }

        return $url;    
    }
}

if(!function_exists('get_date_diff')){
    function get_date_diff($arg){
        $date = ['dia' => 0, 'tres_dias' => 3, 'w' => 7, 'm' => 30];
        return array_key_exists($arg, $date) ? $date[$arg] : null;
    }
}
 <?
 class POST_PHP {
        static function posting($target,$objects_to_send){
         $postdata = http_build_query($objects_to_send);
            $opts= array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                    )
                );
            $context = stream_context_create($opts);
            $json=file_get_contents(API_DOMAIN.$target,false,$context);
            $data=json_decode($json);
            return $data;
        }
    }
?>
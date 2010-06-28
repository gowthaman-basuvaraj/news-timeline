<?php
class Contentfetcher {
    public function get_htmlpage($url){
        //todo use curl and handle errors
        return file_get_contents($url);
    }
    function GetMainBaseFromURL($url) {
        $chars = preg_split('//', $url, -1, PREG_SPLIT_NO_EMPTY);

        $slash = 3; // 3rd slash

        $i = 0;

        foreach ($chars as $key => $char) {
            if ($char == '/') {
                $j = $i++;
            }

            if ($i == 3) {
                $pos = $key;
                break;
            }
        }

        $main_base = substr($url, 0, $pos);

        return $main_base . '/';
    }
}
?>

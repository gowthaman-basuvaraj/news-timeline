<?php
class Contentfetcher {
    public function get_htmlpage($url){
        //todo use curl and handle errors
        return file_get_contents($url);
    }
}
?>

<?php

abstract class basemodel extends Mango {

    public function create() {
        
       
        
        return parent::create();
    }
    public function  check(array $data = NULL, $subject = 0) {
         $user = Session::instance()->get("user", false);
        if ($user && isset($this->_relations['user'])) {
            $data["user_id"] = $user->_id."";
        }
        return parent::check($data, $subject);
    }

}
?>

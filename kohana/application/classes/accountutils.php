<?php
class accountutils {
    public function create_user(Mango &$user, Array $values){
        try {
            $values = $user->check($values);
            $user->values($values);
            $user->create();
        }catch(Validate_Exception $validate){            
            return $validate->array->errors();
        }
        return array();
    }
}
?>

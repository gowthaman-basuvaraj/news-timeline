<?php
class accountutils {
    public function create_user(Mango &$user, Array $values){
        try {
            $values = $user->check($values);
            $values['password'] = md5($values['password']);
            $user->values($values);
            if($values['password']!=$values['repassword']) {
                return array("password"=>"passwords did not match", "repassword"=>"passwords did not match");
            }
            if(isset($_POST['_id'])) {
                $user->update();
            }else {
                $user->create();
            }
        }catch(Validate_Exception $validate){            
            return $validate->array->errors();
        }
        return array();
    }
}
?>

<?php
class accountutils {
    public function create_user(Mango &$user, Array $values){
        try {
            $values = $user->check($values);
            
            if($values['password']!=$values['repassword']) {
                return array("password"=>"passwords did not match", "repassword"=>"passwords did not match");
            }
            $values['password'] = md5($values['password']);
            $user->values($values);
            if(isset($_POST['_id'])) {
                $user->update();
            }else {
                $user->create();
            }
            return array(array(), $user);
        }catch(Validate_Exception $validate){            
            return array($validate->array->errors(), null);
        }
        return array(array(), array());
    }
}
?>

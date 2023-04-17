<?php

// helper class just for validate
class PenggunaHelper
{
    public $bol;
    /**
     * @param string $oldPassword
     * @return boolean
     */
    public function isEnterCorrectPassword($password)
    {
        $user = getLoginAccount();
        $user_data = Pengguna::find($user['pengguna_id']);
        $this->bol = (password_verify($password, $user_data['password']));
        return $this->bol;
    }

    /**
     * @param string $password
     * @param string $password_confirmation
     * 
     * @return boolean
     */
    public function isPasswordMatch($password, $password_confirmation) {
        return $password == $password_confirmation;
    }
}
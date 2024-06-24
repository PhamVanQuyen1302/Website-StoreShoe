<?php

namespace App\StoreShoe\Controllers\Client;
use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\Users;

class UserInforController extends Controller {
    private Users $users;
    const PATH_UPLOAD = '/uploads/users/';

    public function __construct() {
        $this->users = new Users();
    }
    public function index($id) {
       
        $user_data = $this->users->getByID($id);

        if($_POST) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];

            $avatar = $_FILES['avatar'] ?? '';
            $avatarPath = null;

            $move = false;

            if(!empty($avatar)) {
                $avatarPath = self::PATH_UPLOAD . time() . $avatar['name'];
                if(!move_uploaded_file($avatar['tmp_name'], PATH_ROOT. $avatarPath)) {
                    $avatarPath = $user_data['avatar'];
                }
            }

            $this->users->updateUser($id, $name, $address, $email, $tel, $avatarPath);

            if($move && $user_data['avatar'] && file_exists((PATH_ROOT . $user_data['avatar'])) ) {
                unlink(PATH_ROOT. $user_data['avatar']);
            }
            header('Location: /users-infor/'.$user_data['id'].'');
            exit();
        }

        return $this->renderViewsClient('User-infor', [
            'user_data' => $user_data,
        ]);
    }
}
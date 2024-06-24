<?php

namespace App\StoreShoe\Controllers\Client;

use App\StoreShoe\Commons\Controller;
use App\StoreShoe\Models\Users;
use Firebase\JWT\JWT;
use PHPMailer\PHPMailer\PHPMailer;

class   ClientAuthController extends Controller
{

    private Users $users;
    private string $folder = "auth.";

    public function __construct()
    {
        $this->users = new Users();
    }

    public function login()
    {
        if (!empty($_POST)) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $check = true;
            $errors = [];

            if (empty($username)) {
                $errors['username'] = "Tên đăng nhập không được để trống";
                $check = false;
            }

            if (empty($password)) {
                $errors['password'] = "Mật khẩu không được để trống";
                $check = false;
            }

            if ($check) {
                $user = $this->users->checkLoginByUserPass($username, $password);
                if (empty($user) || !password_verify($password, $user['password'])) {
                    $errors['login'] = "Tài khoản hoặc mật khẩu không hợp lệ";
                } else {
                    $time = time() + 60; 
                    $payload = [
                        'user_id' => $user['id'],
                        'exp' => $time
                    ];

                    $jwt = JWT::encode($payload, 'quyen', 'HS256'); // Mã hóa JWT

                    // Lấy lại thông tin người dùng từ cơ sở dữ liệu
                    $user_data = $this->users->getUserByID($user['id']);

                    if ($user_data['role'] == 1) {
                        // Người dùng là admin
                        setcookie('jwt_admin', $jwt, $time, '/admin'); // Đặt JWT cho admin
                        $_SESSION['user_data_admin'] = $user_data;
                        header('Location: /admin/'); // Chuyển hướng đến trang admin
                    } else if ($user_data['role'] == 0) {
                        // Người dùng là client
                        setcookie('jwt_client', $jwt, $time, '/'); // Đặt JWT cho client
                        $_SESSION['user_data_client'] = $user_data;
                        header('Location: /'); // Chuyển hướng đến trang chủ
                    } else {
                        $errors['role'] = "Quyền truy cập không hợp lệ";
                    }
                    exit();
                }
            }
            return $this->renderViewsClient($this->folder . __FUNCTION__, [
                'errors' => $errors,
            ]);
        } else {
            // Return the view if the form is not submitted
            return $this->renderViewsClient($this->folder . __FUNCTION__);
        }
    }



    public function register()
    {

        if (!empty($_POST)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $tel = $_POST['tel'];

            $errors = [];
            $checkEmail = $this->users->checkEmailExist($email);
            // Kiểm tra tên
            if (empty($name)) {
                $errors['name'] = "* Tên là bắt buộc.";
            }

            // Kiểm tra email
            if (empty($email)) {
                $errors['email'] = "* Email là bắt buộc.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "* Email không hợp lệ.";
            } elseif ($checkEmail) {
                $errors['email'] = "* Email đã tồn tại.";
            }

            // Kiểm tra tên người dùng
            if (empty($username)) {
                $errors['username'] = "* Tên người dùng là bắt buộc.";
            } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $errors['username'] = "* Tên người dùng chỉ được chứa chữ cái và số.";
            }

            // Kiểm tra mật khẩu
            if (empty($password)) {
                $errors['password'] = "* Mật khẩu là bắt buộc.";
            } elseif (strlen($password) < 8) {
                $errors['password'] = "* Mật khẩu phải có ít nhất 8 ký tự.";
            }

            // Kiểm tra số điện thoại
            if (empty($tel)) {
                $errors['tel'] = "* Số điện thoại là bắt buộc.";
            } elseif (!preg_match('/^[0-9]{10,15}$/', $tel)) {
                $errors['tel'] = "* Số điện thoại không hợp lệ.";
            }

            // Nếu không có lỗi, tiếp tục tạo người dùng
            if (empty($errors)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->users->createUser($name, '', $email, $tel, $username, $hashedPassword, '');

                header('location: /auth/login');
                exit();
            }
            return $this->renderViewsClient($this->folder . __FUNCTION__, [
                'errors' => $errors
            ]);
        }
        return $this->renderViewsClient($this->folder . __FUNCTION__);
    }


    public function forgotpassword()
    {
        if (!empty($_POST)) {
            $check = true;
            $errors = [];
            $email = $_POST['email'];

            // Kiểm tra email có trống không
            if (empty($email)) {
                $errors['email'] = "Email không được bỏ trống";
                $check = false;
            } else if (!$this->users->checkEmailExist($email)) {
                $errors['email'] = "Email không tồn tại";
                $check = false;
            }

            if ($check) {
                $resetExpiration = time() + 3600; // Đặt thời gian hết hạn là 1 giờ (60 phút)
                $_SESSION['reset_Expiration'] = $resetExpiration;

                $mail = new PHPMailer(true);
                $mail->CharSet = 'UTF-8';
                try {
                    $user = $this->users->checkEmailExist($email);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'quyenpvph42365@fpt.edu.vn';
                    $mail->Password = 'dtbr wifm tsre eigt';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587; // Sử dụng cổng 587 hoặc 465 cho Gmail

                    $mail->setFrom('quyenpvph42365@fpt.edu.vn', 'StoreShoe.vn');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Đặt lại mật khẩu';

                    $resetLink = 'http://storeshoe.test/user/newpassword/' . $user['id']; // Bạn cần tạo một link hợp lệ để đặt lại mật khẩu
                    $mail->Body = 'Xin chào ' . $user['name'] . ',<br>Vui lòng click vào đây để tạo mật khẩu mới: <button class="btn btn-infor"><a href="' . $resetLink . '">Tạo mật khẩu mới</a></button>';

                    $mail->send();
                    $success = "Thành công! Vui lòng kiểm tra email để cập nhật mật khẩu.";
                    // header("refresh:5; url=http://storeshoe.test/");
                    // exit();
                } catch (\Exception $e) {
                    $faile = "Lỗi không thể gửi mail: " . $mail->ErrorInfo;
                }
            }
            return $this->renderViewsClient(
                $this->folder . __FUNCTION__,
                [
                    'errors' => $errors,
                    'success' => $success ?? '',
                    'faile' => $faile ?? ''
                ]
            );
        }

        return $this->renderViewsClient($this->folder . __FUNCTION__);
    }

    public function newpassword($id)
    {
        $check = true;
        $errors = [];

        $currentTime = time();
        if (isset($_SESSION['reset_Expiration'])) {
            $expirationTime = $_SESSION['reset_Expiration'];

            if ($currentTime > $expirationTime) {
                echo "<script>alert('Link đã hết hạn'); window.location.href='/';</script>";
                return;
            }
        } else {
            echo "<script>alert('Link không hợp lệ'); window.location.href='/';</script>";
            return;
        }

        if (!empty($_POST)) {
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            if (empty($password)) {
                $errors['password'] = "Mật khẩu không được để trống";
                $check = false;
            }

            if (empty($confirmPassword)) {
                $errors['confirmPassword'] = "Mật khẩu nhập lại không được để trống";
                $check = false;
            }

            if ($password !== $confirmPassword) {
                $errors['confirmPassword'] = "Mật khẩu nhập lại không hợp lệ";
                $check = false;
            }

            if ($check) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->users->updatePassUser($hashedPassword, $id);
                $success = 'Cập nhật thành công';
                echo "<script>alert('$success'); window.location.href='/auth/login';</script>";
                return;
            }
        }

        // Render view với các thông báo lỗi nếu có
        return $this->renderViewsClient(
            $this->folder . __FUNCTION__,
            [
                'errors' => $errors,
            ]
        );
    }



    public function logout()
    {
        session_destroy();

        header('Location: /');
        exit();
    }
}

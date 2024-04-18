public function login() {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $response = $this->api->post('/login', [
        'email' => $email,
        'password' => $password,
    ]);

    if ($response['success']) {
        setcookie('user', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
        header('Location: /');
    } else {
        // handle error
    }
}
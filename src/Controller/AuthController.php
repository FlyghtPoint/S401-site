<?php
namespace App\Controller;

use App\Model\ApiClient;

class AuthController {
    private $apiClient;
    private $twig;

    public function __construct(ApiClient $apiClient, \Twig\Environment $twig) {
        $this->apiClient = $apiClient;
        $this->twig = $twig;
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $this->apiClient->login($email, $password);

        if ($login) {
            $role = $login['employeeRole'];
            $id = $login['employeeId'];
            setcookie('status', $role, time() + (86400 * 30), "/");
            setcookie('id', $id, time() + (86400 * 30), "/");
        
            // Check the value of the status cookie
            switch ($role) {
                case 'employee':
                    echo $this->twig->render('employee/home.twig', [
                        'employee' => $login,
                    ]);
                    break;
                case 'chief':
                    echo $this->twig->render('chief/home.twig', [
                        'employee' => $login,
                    ]);
                    break;
                case 'it':
                    echo $this->twig->render('it/home.twig', [
                        'employee' => $login,
                    ]);
                    break;
                default:
                    echo $this->twig->render('customer/home.twig');
                    break;
            }
        }
    }

    public function logout() {
        setcookie('status', 'customer', time() - 3600, "/");
        setcookie('id', '', time() - 3600, "/");
        echo $this->twig->render('customer/home.twig');
    }

    public function redirectBasedOnStatus() {
        if (isset($_COOKIE['status'])) {
            $status = $_COOKIE['status'];

            // Call API to get the employee data
            if ($status !== 'customer') {
                $employee = $this->apiClient->getEmployeeById($_COOKIE['id']);
            }

            switch ($status) {
                case 'employee':
                    echo $this->twig->render('employee/home.twig', [
                        'employee' => $employee,
                    ]);
                    break;
                case 'chief':
                    echo $this->twig->render('chief/home.twig', [
                        'employee' => $employee,
                    ]);
                    break;
                case 'it':
                    echo $this->twig->render('it/home.twig', [
                        'employee' => $employee,
                    ]);
                    break;
                default:
                    echo $this->twig->render('customer/home.twig');
                    break;
            }
        }
    }
}
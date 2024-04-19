<?php
namespace App\Model;

class ApiClient {
    private $baseUrl;

    public function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
    }

    public function getProducts() {
        return json_decode(file_get_contents($this->baseUrl . '/products'), true);
    }

    public function getEmployeeById($id) {
        return json_decode(file_get_contents($this->baseUrl . '/employees/' . $id), true);
    }

    public function login($email, $password) {
        $data = array('email' => $email, 'password' => $password);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        // var_dump($this->baseUrl . '/login');
        $result = file_get_contents($this->baseUrl . '/login', false, $context);
        $response = json_decode($result, true);

        $employee = $response['employee'];
        return $employee;
        // echo $employee['employeeRole'];
    }
}
<?php
namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\ContainerInterface;
use Illuminate\Database\Query\Builder;

class LoginController {

	private $ci;
    private $view;
    private $logger;
    protected $db;
    private $session;

    public function __construct(\Slim\Container $c)
    {
        $this->ci = $c;
        $this->view = $c->get("view");
        $this->logger = $c->get("logger");
        $this->db = $c->get("db");
        $this->session = $c->get("session");
    }

    public function render(Request $request, Response $response) {

    	$username = $this->session->exists('login') ? $this->session->login : "";

		$data = array('name' => $username);

    	return $this->view->render($response, 'index.phtml', $data);

    }

	public function login(Request $request, Response $response) {

		$postvars = $request->getParsedBody();

		$username = $postvars['username'];
		$password = md5($postvars['password']);

		$q = $this->db->table('users')->where('username', $username)->where('password', $password)->get();

		if (isset($q[0])) {
			$login = $q[0]->username;
			$this->session->loginid = $q[0]->id;
			$this->session->login = $login;
		} else {
			$login = "invalid";
			$this->session->delete('login'); 
		}


		$data = array('name' => $login);

		return $this->view->render($response, 'index.phtml', $data);

	}

	public function logout(Request $request, Response $response) {

		$this->session::destroy();

		$data = array('name' => "");

		return $this->view->render($response, 'index.phtml', $data);

	}

	public function question(Request $request, Response $response) {

		$data = array('name' => $this->session->login);

		return $this->view->render($response, 'question.phtml', $data);

	}
}
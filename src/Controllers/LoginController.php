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

    public function __construct(\Slim\Container $c)
    {
        $this->ci = $c;
        $this->view = $c->get("view");
        $this->logger = $c->get("logger");
        $this->db = $c->get("db");
    }

	public function login(Request $request, Response $response, $args) {

		$q = $this->db->table('questions')->find(207);
		$data = array('name' => $q->question);

		return $this->view->render($response, 'index.phtml', $data);

	}
}
<?php
namespace App\Controllers;

use Illuminate\Database\Capsule\Manager as DB;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\ContainerInterface;
use Illuminate\Database\Query\Builder;

class QuestionController {

	private $ci;
    private $view;
    private $logger;
    protected $db;
    private $session;
    private $q;
    private $interests;

    public function __construct(\Slim\Container $c)
    {
        $this->ci = $c;
        $this->view = $c->get("view");
        $this->logger = $c->get("logger");
        $this->db = $c->get("db");
        $this->session = $c->get("session");

        $this->LoadQuestions();

    }

    private function LoadQuestions() {

        if (count($this->session->q) > 0) return true;

        $this->q = array();
        $this->session->a = array();

    	$questions = $this->db->table('questions')->get();

        $i = 1;
        foreach ($questions as $question) {
            $this->q[$i] = $question;
            $i++;
        }

        $this->session->q = $this->q;
        $this->session->total = count($this->q);

        $interests = $this->db->table('interests')->get();

        $this->interests = array();
        foreach($interests as $interest) {
            $this->interests[$interest->id] = $interest->name;
        }

        $this->session->interests = $this->interests;

    }

    public function answer(Request $request, Response $response, $args) {

        $getvars = $request->getQueryParams();

        $qnum = $getvars['number'];
        $ans = $getvars['answer'];

        if ($qnum > 0) {
            $tmpa = $this->session->a;
            $tmpa[$qnum] = $ans;
            $this->session->a = $tmpa;
        }

        if ($qnum >= $this->session->total) {
            $this->SaveAssessment($request, $response);
        }

        $qnum++;

        $data = array('id' => $qnum, 'name' => $this->session->login, 'question' => $this->session->q[$qnum]->question, 'results' => $this->session->a, 'total' => $this->session->total);

        return $this->view->render($response, 'question.phtml', $data);

    }

    public function score(Request $request, Response $response) {

        $this->SaveAssessment($request, $response);

    }

    public function SaveAssessment(Request $request, Response $response) {

        $tmpq = $this->session->q;
        $tmpa = $this->session->a;
        $tmpi = $this->session->interests;
        $score;

        foreach ($tmpa as $key => $value) {
            $tmpinterest = $tmpq[$key]->interest;
            if (empty($score[$tmpinterest])) $score[$tmpinterest] = 0;
            $score[$tmpinterest] += $value;
        }

        $results = array();
        foreach($score as $key => $value) {
            $intname = $tmpi[$key];
            $intscore = $value;
            $results[] = array('id' => $key, 'name' => $intname, 'score' => $intscore);
        }

        $userid = $this->session->loginid;
        $deleted = DB::delete("DELETE FROM results WHERE userid = '" . $userid ."'");

        for ($i = 0; $i < count($results); $i++) {
            $int = $results[$i]['id'];
            $scr = $results[$i]['score'];
            DB::insert("INSERT INTO `results` (`userid`, `interest`, `score`) VALUES ('" . $userid . "', '" . $int . "', '" . $scr . "')");
        }


        $data = array('score' => $results);

        return $this->view->render($response, 'score.phtml', $data);

    }
}
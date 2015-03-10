<?php
/**
 * Created by PhpStorm.
 * User: thomasmunoz
 * Date: 27/01/15
 * Time: 22:48
 */

namespace app\controllers;

use app\helpers\AJAXAnswer;
use app\helpers\Cleaner;
use app\helpers\Planning;
use app\models\GroupsModel;
use app\models\PlanningModel;
use SFramework\Exceptions\MissingParamsException;
use SFramework\mvc\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try
        {
            $params = $this->getParams();
            if(count($params) > 3 || count($params) < 3){
                throw new MissingParamsException();
            }

            $newParams = Cleaner::clean($params);
            if($params != $newParams)
                $this->getView()->redirect('/view/p/' . $newParams[0] . '/' . $newParams[1] . '/' . $newParams[2]);

            $params = $newParams;
            $img = Planning::getPlanning($params[0], $params[1], $params[2]);

            $groupsModel = new GroupsModel();
            $groups = $groupsModel->getGroups();
            $years = ['week' => date('W') + 17, 'years' => []];

            $i = 0;
            $j = 0;

            foreach($groups as $group){
              if($group['ANNEE'] != $i){
                  $years['years'][] = ['year' => $group['ANNEE'], 'groups' => []];
                  ++$i;
                  $j = 0;
              } else {
                  $years['years'][$i - 1]['groups'][$j] = ['group' => $group['GROUPE']];
                  ++$j;
              }
            }
            $planningModel = new PlanningModel();
            $weeks = $planningModel->getWeeks();
            $viewParams = ['year' => $params[0],
                           'group' => $params[1],
                           'week' => $params[2],
                           'img' => $img,
                           'years' => $years,
                           'weeks' => $weeks];

            $this->getView()->render('home/index', $viewParams);
        }
        catch(MissingParamsException $e)
        {
            $default = Cleaner::defaultValues();
            $this->getView()->redirect('/view/p/' . $default[0] . '/' . $default[1] . '/' . $default[2]);
        }
    }

    public function getPlanning()
    {
        try
        {
            $params = $this->getParams();
            if(count($params) > 3 || count($params) < 3){
                throw new MissingParamsException();
            }

            if($params != Cleaner::clean($params))
                throw new MissingParamsException();

            $response = new AJAXAnswer(true);
            $response->setMessage(Planning::getPlanning($params[0], $params[1], $params[2]));
            $response->answer();

        }
        catch(MissingParamsException $e)
        {
            $error = new AJAXAnswer(false, 'Missing Parameters for this query');
            $error->answer();
        }
    }
}
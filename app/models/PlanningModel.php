<?php
/**
 * Created by PhpStorm.
 * User: thomasmunoz
 * Date: 10/03/15
 * Time: 12:55
 */

namespace app\models;
use SFramework\Database\DatabaseProvider;
use SFramework\mvc\Model;

class PlanningModel extends Model
{
   public function getWeeks()
    {
        $query = 'SELECT ID, TITRE FROM SEMAINE';
        return DatabaseProvider::connection()->query($query);
    }
}

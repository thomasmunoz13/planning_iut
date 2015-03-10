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
    public function getLastSave($id, $numsem)
    {
        $query = 'SELECT LASTSAVE
                   FROM PLANNING
                   WHERE ID = :id AND NUMSEM = :numsem';
        return DatabaseProvider::connection()->query($query, ['id' => $id, 'numsem' => $numsem]);
    }

    public function getWeeks()
    {
        $query = 'SELECT ID, TITRE FROM SEMAINE';
        return DatabaseProvider::connection()->query($query);
    }
}
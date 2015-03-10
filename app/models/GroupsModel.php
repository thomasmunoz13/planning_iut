<?php
/**
 * Created by PhpStorm.
 * User: thomasmunoz
 * Date: 10/03/15
 * Time: 12:46
 */

namespace app\models;
use SFramework\Database\DatabaseProvider;
use SFramework\mvc\Model;

class GroupsModel extends Model
{
    public function getIDs($year, $group)
    {
        $query = 'SELECT ID, IDTREE
                   FROM GROUPE
                   WHERE ANNEE = :year
                   AND GROUPE = :group ';

        return DatabaseProvider::connection()->query($query, ['year' => $year, 'group' => $group]);
    }

    public function getGroups()
    {
        $query = 'SELECT ANNEE, GROUPE
                   FROM GROUPE ORDER BY ANNEE, GROUPE ';
        return DatabaseProvider::connection()->query($query);
    }
}
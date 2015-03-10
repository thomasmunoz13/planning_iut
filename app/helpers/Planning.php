<?php
/**
 * Created by PhpStorm.
 * User: thomasmunoz
 * Date: 10/03/15
 * Time: 15:36
 */

namespace app\helpers;


use app\models\GroupsModel;
use Composer\Config;
use SFramework\Config\ConfigFileParser;

class Planning
{

    public static function getPlanning($year, $group, $week, $h = false)
    {
        $groupModel = new GroupsModel();
        $ids = $groupModel->getIDs($year, $group);
        $ids = $ids[0];

        $identFile = new ConfigFileParser('app/config/ident.json');
        $ident = $identFile->getEntry('ident');
        $fileName = 'public/img/img_planning/' . $ids['ID'] . '_' . $week . (($h) ? '_h' : '') . '.png';

        try
        {
            $file = new \SplFileObject($fileName, 'rw');
            if($file->getMTime() < time() - 900)
                throw new \RuntimeException();
        }
        catch(\RuntimeException $e)
        {
            $fp = fopen ($fileName, 'w+');

            $url = 'http://planning.univ-amu.fr/ade/imageEt?identifier=' . $ident . '&projectId=8&idPianoWeek='
                . $week . '&idPianoDay=0,1,2,3,4,5&idTree='
                .$ids['IDTREE']
                . '&width=1000&height=700&lunchName=REPAS&displayMode=1057855&showLoad=false&ttl=1405063872880000&displayConfId='
                . (($h) ? '60' : '59');

            $ch = curl_init(str_replace(" ","%20",$url));
            curl_setopt($ch, CURLOPT_TIMEOUT, 50);

            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_exec($ch);
            curl_close($ch);
        }
        return '/' . $fileName;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 30/12/14
 * Time: 17:53
 */

namespace SFramework\Database;

use SFramework\Config\DatabaseConfig;

class Database extends \PDO
{
    /**
     * @var  database config
     */
    private $config;

    /**
     * default constructor
     * @param DatabaseConfig|DatabaseConfig $config
     */
    public function __construct(DatabaseConfig $config)
    {
        $this->config = $config;

        parent::__construct(
            $this->config->dsn(),
            $this->config->getUser(),
            $this->config->getPassword(),
            array(
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_AUTOCOMMIT => 1
            )
        );
        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * execute query
     * @param $query
     * @param $params array
     * @return array Rows
     */
    public function query($query, array $params = [])
    {
        $stmt = $this->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * update query
     * @param $query
     * @param $params array
     * @return bool whether it succeeded
     */
    public function execute($query, array $params = [])
    {
        $stmt = $this->prepare($query);
        return $stmt->execute($params);
    }

    /**
     * select first from query
     * @param $query string query
     * @param $params array
     * @return mixed
     */
    public function selectFirst($query, array $params = [])
    {
        $stmt = $this->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch();
    }
}
<?php
//namespace libs;
//include '/libs/dbconfig.php';

/**
 * Description of core
 *
 * @author Ayafa
 */
class Database
{
    public $_connection;
    //Store the single instance
    private static $_instance;
    private $_reconciled;

    /*
     * Get an instance of the database
     * @return Database
     */

    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
    }

    /*
     * Constructor
     */

    public function __construct()
    {
        try {
            define('DB_NAME', 'lawrevee_lawrevee');
            define('DB_DSN', 'mysql:host=localhost;port=3306;dbname='.DB_NAME);
            define('DB_USERNAME', 'lawrevee_sync');
            define('DB_PASSWORD', 'L@wrevee123$');

            $this->_connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);

            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //$this->_reconciled=$this->checkReconcile();
            //$this->alaerttags();
            //$this->mobileno();

        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }

    }

    /*
     * Empty clone magic method to prevent duplication
     */

    private function __clone()
    {

    }

    /*
     * Get the mysqli connection
     */

    public function getConnection(){
        return $this->_connection;
    }

    function select_group($tablename, $condition = [], $group = [])
    {
        $this->getInstance();
        $mysqli = $this->getConnection();
        $sql = "SELECT * FROM " . $tablename;
        if (!empty($condition)) {
            $sqlCondition = '';
            foreach ($condition as $key => $sSql) {
                $sqlCondition .= $key . $sSql;
            }
            $sql .= " WHERE " . $sqlCondition;
        }

        if (!empty($group)) {
            $sql .= " GROUP BY " . $group;
        }
        $statment = $mysqli->prepare($sql);
        $statment->execute();
        $data = $statment->fetchAll();
        return $data;
    }

    function selects($tablename, $condition = [])
    {
        try {
            $this->getInstance();
            $mysqli = $this->getConnection();
            $sql = "SELECT * FROM " . $tablename;
            if (!empty($condition)) {
                $sqlCondition = '';
                foreach ($condition as $key => $sSql) {
                    $sqlCondition .= $key . $sSql;
                }
                $sql .= " WHERE " . $sqlCondition;
            }
            $statment = $mysqli->prepare($sql);
            $statment->execute();

            $data = $statment->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    function updates($tablename, $arraydata = [], $condition = [])
    {
        $this->getInstance();
        $mysqli = $this->getConnection();
        $setfields = '';
        foreach ($arraydata as $key => $val) {
			if(trim(strtolower($val)) == 'now()'){
			$setfields .= $key . "=" . $val . ",";
			
			}
			else{
            $setfields .= $key . "='" . $val . "',";
			
			}
        }
        $setfields = rtrim($setfields, ',');
        $sql = "Update " . $tablename . ' SET ' . $setfields;
        if (!empty($condition)) {
            $sqlCondition = '';
            foreach ($condition as $key => $sSql) {
                $sqlCondition .= $key . $sSql;
            }
            $sql .= " WHERE " . $sqlCondition;
        }
		//echo $sql;
        $statment = $mysqli->prepare($sql);
        try {
            if ($statment->execute()) {
                return true;
            }
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    function deletes($tablename, $condition = [])
    {
        $this->getInstance();
        $mysqli = $this->getConnection();
        $sql = "DELETE  FROM " . $tablename;
        if (!empty($condition)) {
            $sqlCondition = '';
            foreach ($condition as $key => $sSql) {
                $sqlCondition .= $key . $sSql;
            }
            $sql .= " WHERE " . $sqlCondition;
        }
        // $statment = $mysqli->prepare($sql);
        try {
            $mysqli->exec($sql);
            // $statment->execute();
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    function inserts($tablename, $arraydata = array())
    {
        $this->getInstance();
        $mysqli = $this->getConnection();
        $dataKey = '';
        $dataVal = '';
        foreach ($arraydata as $key => $val) {
            $dataKey .= $key . ',';
            if($val === "now()"){
                $dataVal .=  'NOW(),';
            }else{
                $dataVal .= $val === null ? 'NULL,' : "'" . $val . "',";
                //$dataVal .= strtoupper($val)=='NULL'? $val.',': "'" . $val . "',";
            }

        }

        $dataKey = rtrim($dataKey, ',');
        $dataVal = rtrim($dataVal, ',');
        $sql = "INSERT INTO " . $tablename . "(" . $dataKey . ") VALUES(" . $dataVal . ")";
        error_log($sql);
        $statment = $mysqli->prepare($sql);
        try {
            $statment->execute();
            return $mysqli->lastInsertId();
        } catch (PDOException $ex) {
            error_log($ex->getMessage());
        }
    }

    function dbquery($sqlparam)
    {
        $this->getInstance();
        $mysqli = $this->getConnection();
        $statment = $mysqli->prepare($sqlparam);
        try {
            $statment->execute();
            $results = $statment->fetchAll();
            return $results;
        } catch (PDOException $ex) {
            die($ex->getMessage());

        }
    }

    function plainquery($sql)
    {
        $this->getInstance();
        $mysqli = $this->getConnection();
        // $statment = $mysqli->prepare($sql);
        try {
            $mysqli->exec($sql);
            // $statment->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function getsystemsetup()
    {
        $result = $this->selects(TBL_SYSTEM_SETUP);
        return $result;
    }

    public function alerts($code, $flag)
    {
        $errormsg = $this->dbquery("SELECT AMDescription FROM " . TBL_ALERT . " WHERE AMCode ='$code' AND AMFlagType='$flag'");
        return $this->alaerttags() . '-' . $code . ': ' . $errormsg[0]['AMDescription'];
    }

    protected function alaerttags()
    {
        $alerttag = $this->dbquery("SELECT SSAlertTag FROM " . TBL_SYSTEM_SETUP);
        return $alerttag[0]['SSAlertTag'];
    }

    public function getMinistry($ID=false){
        $sql=" SELECT * FROM ".TBL_MINISTRY;
        if($ID !== false){
            $sql .=" WHERE SMinId=".$ID;
        }
        $result= $this->dbquery($sql);
        return $result;
    }

    public function getDepartment($ID=false){
        $sql=" SELECT * FROM ".TBL_DEPARTMENT;
        if($ID !== false){
            $sql .=" WHERE SDSId=".$ID;
        }
        $result= $this->dbquery($sql);
        return $result;
    }

    public function getSection($ID=false){
        $sql=" SELECT * FROM ".TBL_SECTIONS;
        if($ID !== false){
            $sql .=" WHERE SSId=".$ID;
        }
        $result= $this->dbquery($sql);
        return $result;
    }

    public function getUnit($ID=false){
        $sql=" SELECT * FROM ".TBL_UNITS;
        if($ID !== false){
            $sql .=" WHERE SUnId=".$ID;
        }
        $result= $this->dbquery($sql);
        return $result;
    }
}

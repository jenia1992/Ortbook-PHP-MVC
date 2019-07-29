<?PHP

include_once "globals.php";

class DB{

    private static $_instance = null;
    private $_query;
    private $_pdo;
    public $result;
    public $countRows; //will return the row numbers


    private function __construct(){
        try{
            $this->_pdo = new PDO('mysql:host='.$GLOBALS['mysql']['host'].';dbname='.$GLOBALS['mysql']['db'].';', $GLOBALS['mysql']['username'],$GLOBALS['mysql']['password']);
        }catch(PDOException $e){//execption
            die($e->getMessage());

        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance)){//self instead of '$this->'
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function paramsQuery($sql,$params){
        if($this->_query = $this->_pdo->prepare($sql)){
            if($this->_query->execute($params)){
                if($this->countRows=$this->_query->rowCount()){//num of rows
                    $this->result=$this->_query->fetchAll(PDO::FETCH_ASSOC);//contain the data after query execute
                }
                else{
                    $this->countRows = 0;
                    //die('no data found');
                }
            }
            else{
                die('unable to execute');
            }
        }
        return $this->result;
    }

    public function query($sql){
        if($this->_query = $this->_pdo->prepare($sql)){
            if($this->_query->execute()){
                if($this->countRows=$this->_query->rowCount()){//num of rows
                    $this->result=$this->_query->fetchAll(PDO::FETCH_ASSOC);//contain the data after query execute
                }
                else{
                    die('no data found');
                }
            }
            else{
                die('unable to execute');
            }
        }
        return $this->result;
    }

}

?>
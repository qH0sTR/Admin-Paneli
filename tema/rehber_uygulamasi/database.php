<?php
namespace projem\db;
use \PDO;
use PDOException;

class Database
{
    private $MYSQL_HOST='localhost';
    private $MYSQL_USER='root';
    private $MYSQL_PASS='';
    private $MYSQL_DB='selfprof_usecase';
    private $CHARSET='UTF8';
    private $COLLATION='utf8_general_ci';
    private $pdo=null;
    private $stmt=null;
    public $a = 0;
    private function ConnectDB(){
                // database connection
         $SQL = "mysql:host=".$this->MYSQL_HOST.";dbname=".$this->MYSQL_DB;
        //  $SQL = "mysql:host=".$this->MYSQL_HOST;
         try {
             $this->pdo = new    \PDO($SQL,$this->MYSQL_USER,$this->MYSQL_PASS);
             $this->pdo->exec("SET NAMES '".$this->CHARSET."' COLLATE '".$this->COLLATION."'");
             $this->pdo->exec("SET CHARACTER SET '".$this->CHARSET."'");
             $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
             $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
             $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES,false); // ?,? kullanımlarına izin verir.
             //$this->pdo->beginTransaction();  // update-detelei,insert işlemlerini commit'siz yapmaz.
            // echo "<div class='alert alert-success'>Veri Tabanı Bağlantısı Sağlandı.</div>";
         } catch (PDOException $e) {
             die("<div class='alert alert-danger'>PDO ile veritabanına ulasılamadı".$e->getMessage()."</div>");
         }             
     }
     public function MyCommit(){
         $this->pdo->commit();
     }
     public function MyRollBack(){
        $this->pdo->rollBack();
    }
     public function __construct()
     {
         // bağlantıyı aç
         $this->ConnectDB();
     }
     private function myQuery($query,$params=null){
         // diğer metodlardaki tekrarlı verileri bitirmek için kullanılan metod
        if(is_null($params)){
            $this->stmt=$this->pdo->query($query);
        }else{
            $this->stmt=$this->pdo->prepare($query);
            $this->stmt->execute($params);
        }
        return $this->stmt;
    }
    public function Limit($query,$p1=1,$p2=null){
        $this->stmt=$this->pdo->prepare($query);
        $this->stmt->bindParam(1,$p1,\PDO::PARAM_INT);
        if(!is_null($p2)){
        $this->stmt->bindParam(2,$p2,\PDO::PARAM_INT);
        }
        $this->stmt->execute();
        return $this->stmt->fetchAll();
    }
     public function getRows($query,$params=null){
         // coklu veri kullanımı için ( tüm satırlar)
         try {
             return $this->myQuery($query,$params)->fetchAll();
         } catch (PDOException $e) {
             die($e->getMessage());
         }
     }
     public function getRow ($query,$params=null){
         // tek satır için 
         try {
            return $this->myQuery($query,$params)->fetch();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
     }
     public function getColumn ($query,$params=null){
        // tek satırın tek sütunu için
        try {
            return $this->myQuery($query,$params)->fetchColumn();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function Insert($query,$params=null){
        // kayıt eklemek için
        try {
            $this->myQuery($query,$params);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function Update($query,$params=null){
        // kayıt güncellemek için
        try {
            return $this->myQuery($query,$params)->rowCount();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function Delete($query,$params=null){
        // kayıt silmek için
        return $this->Update($query,$params);
    }

    public function CreateDB($query){
        // veri tabanı olusturmak için
        $myDB = $this->pdo->query($query.' CHARACTER SET '.$this->CHARSET.' COLLATE '.$this->COLLATION);
        return $myDB;
    }
    public function TableOperations($query){
        // tablo operasyonları için
        $myTable = $this->pdo->query($query);
        return $myTable;
    }
    public function Maintenance(){
        // tabloların bakımı için
        $myTable = $this->pdo->query("SHOW TABLES");
        $myTable->setFetchMode(\PDO::FETCH_NUM);
        if($myTable){
                foreach($myTable as $items){
                $check = $this->pdo->query("CHECK TABLE ".$items[0]);
                $analyze = $this->pdo->query("ANALYZE TABLE ".$items[0]);
                $repair = $this->pdo->query("REPAIR TABLE ".$items[0]);
                $optimize = $this->pdo->query("OPTIMIZE TABLE ".$items[0]);
                if($check == true && $analyze == true && $repair == true && $optimize){
                    echo $items[0]." adlı tablonuzun bakımı yapıldı<br>";
                }else{
                    echo "Bir hata olustu";
                }
            }
        }
    }
    public function __destruct(){  
        $this->pdo = null;
    }
}   
?>
<?php
    define('HOST_DB', '127.0.0.1');
    define('NAME_DB', 'cfb_veiculos');
    define('USER_DB', 'root');
    define('PASS_DB', '');
    //
    $conexao = mysqli_connect(HOST_DB, USER_DB, PASS_DB, NAME_DB) or die ('Não foi possível conectar');
    //
    mysqli_set_charset($conexao, "UTF8MB4");
    
    // NOVA CONEXÃO DO BANCO DE DADOS
    $pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB, array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8MB4"));


    // PDO - MONTAGEM DE UMA INSTRUÇÃO SQL
    // $id = 1;
    // $query = "SELECT * FROM tb_colaboradores WHERE id_colaborador = :id";
    // $stmt = $pdo->prepare($query);
    // $stmt = $pdo->prepare("SELECT * FROM tb_colaboradores WHERE id >= :id");
    // $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    // $stmt->bindValue(":id", 1);
    // $stmt->execute(array(":id" => $id));
    // $stmt->execute();
    // $result = $stmt->fetchAll(PDO::FETCH_BOTH);

    // echo('<pre>');
    // print_r($result);
    // echo('</pre>');


    // $stmt->execute();
    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // DE ACORDO COM O STACKOVERFLOW O MAIS CORRETO E USAR O COUNT() DOQUE SIZEOF() VISTO ELES FAZERM EXATAMENTE A MESMA COISA
    // MAIS O COUNT() E MAIS USADO QUE SIZEOF() E MAIS RAPIDO.
    // BASICAMENTE RETORNAM A CONTAGEM DE UM ARRAY O SEU TAMANHO, RETORNO EM INTEIRO
    // $total = sizeof($result);
    // $total = count($result);

    // echo($total);


    
    // $pdo = new PDO("mysql:host=".HOST.";dbname=".NAME_DB, USUARIO, SENHA);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8MB4"));

    
// try {
//     $conn = new PDO('mysql:host=localhost;dbname=meuBancoDeDados', $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//    echo 'ERROR: ' . $e->getMessage();
// }

//
// 
// <?php
// /*
//  * Criado em Jul 09, 2009
//  *
//  * @author Ronaldo Passos <ronaldo@maximize.art.br>
//  * @author Caio Gondim <caio@maximize.art.br>
//  */
// 
//  class Db
//  {
//      public static $pdo;
//  
//      public static function conectar()
//      {
//          if (!isset(self::$pdo))
//          {
//              try
//              {
//                  self::$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
//              }
//              catch (Exception $e)
//              {
//                  echo 'Não foi possível conectar ao banco de dados';
//                  exit;
//              }
//          }
//      }
//  
//      /**
//       * @desc SELECT
//       * Query completa através da variável $sql, ou somente campos e tabela ($campos e $from)
//       * @param string $sql
//       * @param string $campos
//       * @param string $from
//       * @param string $complemento
//       * @return mixed $array
//       */
//      public static function select($sql='')
//      {
//          //echo $sql.'<br>';
//          try
//          {
//              $stmt = self::$pdo->prepare($sql);
//              $stmt->execute();
//              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//              $total = sizeof($result);
//          }
//          catch (PDOException $e)
//          {
//              print $e->getMessage();
//          }
//          if($total)
//          {
//              return $result;
//          }
//          else
//          {
//              return false;
//          }
//      }
//  
//      /**
//       * @desc INSERT
//       * @param string $tabela
//       * @param array $dados
//       * @return int $id
//       */
//  
//      public static function insert($tabela, $dados)
//      {
//          $sql  =   "INSERT INTO {$tabela} (";
//  
//          // Nome dos Campos
//          foreach ($dados as $key => $valor)
//          {
//              $sql .= $key . ",";
//          }
//          // Campos de Data
//              $sql .= " insercao, edicao, uuid) VALUES (";
//  
//          // Valores dos campos
//          foreach ($dados as $key => $value)
//          {
//              if (empty($value) && is_int($value))
//              {
//                  if($value == 0)
//                  {
//                      $sql .= "0,";
//                  }
//                  else
//                  {
//                      $sql .= "NULL,";
//                  }
//              }
//              else
//              {
//                  $sql .= "'" . addslashes($value) . "',";
//              }
//          }
//          // Campo de Data
//          $sql .= " now(), now(), uuid()) ";
//          // echo htmlentities($sql);
//          // exit;
//  
//          try
//          {
//              $stmt = self::$pdo->prepare($sql);
//              $stmt->execute();
//              $retorno = self::$pdo->lastInsertId();
//          }
//          catch (PDOException $e)
//          {
//              print $e->getMessage();
//              $retorno = false;
//          }
//          
//          return $retorno;
//      }
//      
//      /**
//       * @desc UPDATE
//       * @param string $tabela
//       * @param array $dados
//       * @param array $where
//       * @param string $data
//       * @return int true or false
//       */
//      public static function update($tabela, $dados, $where)
//      {
//          $sql  =   "UPDATE {$tabela} SET ";
//  
//          foreach ($dados as $key => $value)
//          {
//              $sql .= " {$key} = '". addslashes($value) ."', ";
//          }
//  
//          $sql .= " edicao=now()";
//          $sql .= " WHERE {$where} ";
//          
//          try
//          {
//              $stmt = self::$pdo->prepare($sql);
//              $stmt->execute();
//              return true;
//          }
//          catch (PDOException $e)
//          {
//              print $e->getMessage();
//              return false;
//          }
//      }
//  
//      /**
//       * @desc DELETE
//       * @param string $tabela
//       * @param string $where
//       */
//      public static function delete($tabela, $where)
//      {
//          $sql = "DELETE FROM {$tabela} WHERE {$where}";
//          
//          try
//          {
//              $stmt = self::$pdo->prepare($sql);
//              $stmt->execute();
//              return true;
//          }
//          catch (PDOException $e)
//          {
//              print $e->getMessage();
//              return false;
//          }
//      }
//  
//      public static function truncate($tabela)
//      {
//          $sql = "TRUNCATE TABLE {$tabela}";
//          
//          try
//          {
//              $stmt = self::$pdo->prepare($sql);
//              $stmt->execute();
//              return true;
//          }
//          catch (PDOException $e)
//          {
//              print $e->getMessage();
//              return false;
//          }
//      }
//      
//      public static function query($sql)
//      {
//          return self::$pdo->query($sql);
//      }
//  }
//      
// 
//
?>


<?php

namespace PrefecturesApp;

class VisitRecordInput {
    private $pdo;
    
    public function __construct($pdo){
        $this->pdo = $pdo;
        Token::create();
    }
    
    /**
     * CSRF対策 トークンの検証
     */

    public function processPost(){
        // サーバー変数を調べてリクエストメソッドが、POSTだったらデータを追加
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            Token::validate(); //tokenの値も調べる
            // クエリ文字列の取得
            // $action = filter_input(INPUT_GET, 'action');
            
        //     switch($action) {
        //         case 'add':
        //             $id = $this->add();
        //             // json形式の宣言、出力(キー付きの配列をjson形式に変換)
        //             //header('Content-Type: application/json');
        //             //echo json_encode(['id' => $id]);
        //             break;
        //         case 'toggle':
        //             //todoのチェック状態の整合性を保つ処理で使用
        //             $isDone = $this->toggle();
        //             header('Content-Type: application/json');
        //             echo json_encode(['is_done' => $isDone]);
        //             break;
        //         case 'delete':
        //             $this->delete();
        //             break;
        //         case 'purge':
        //             $this->purge();
        //             break;
        //         default:
        //             exit;
        //     }
        //     exit;
        }
    }

$name = $_POST['name'];
$visit_date = $_POST['visit_date'];
$purpose = $_POST['purpose'];
$stayLevel = $_POST['stayLevel'];

    /**
    * 追加
    */ 
    private function input() {
        $title = trim(filter_input(INPUT_POST, 'title'));
        // 空文字だったら追加する必要はない
        if($title === '') {
            return;
        }
        // プレースホルダーを使って、入力されたtodoを追加
        $stmt = $this->pdo->prepare("INSERT INTO prefectures (name) VALUES (:name)");
        $stmt1 = $this->pdo->prepare("INSERT INTO visitrecords  (visit_date,purpose) VALUES (:visit_date,:purpose)");
        // 値を紐づける。titleをプレースホルダ―に文字列として割り当て
        $params = array(':name' => $name, ':visit_date' => $visit_date, ':purpose' => $purpose);
        $stmt->bindValue('name', $title, \PDO::PARAM_STR);
        $stmt->bindValue('', $title, \PDO::PARAM_STR);
        $stmt->execute();

        //bindbalueの復習　steylevelに対応したidを検索して入れる必要がある！
    }

    /**
    * 編集
    */ 
    private function editRecord() {
    
    }

    /**
    * 削除
    */ 
    private function deleteRecord() {
    
    }

    /**
    * 取得
    */ 
    private function getRecords() {
        
    }

}
    /**
    *   //データの追加
    *    private function add() {
    *        $title = trim(filter_input(INPUT_POST, 'title'));
    *        // 空文字だったら追加する必要はない
    *       if($title === '') {
    *           return;
    *       }
    *       // プレースホルダーを使って、入力されたtodoを追加
    *       $stmt = $this->pdo->prepare("INSERT INTO todos (title) VALUES (:title)");
    *       // 値を紐づける。titleをプレースホルダ―に文字列として割り当て
    *       $stmt->bindValue('title', $title, \PDO::PARAM_STR);
    *       $stmt->execute();
    *       //直前に挿入されたレコードのidを取得
    *       return (int)$this->pdo->lastInsertId();
    *   }
    *   
    *   // true false(チェック未チェック)の判定 
    *   private function toggle() {
    *       $id = filter_input(INPUT_POST, 'id');
    *       if(empty($id)) {
    *           return;
    *       }
    *       
    *       // データの整合性チェック 別ウィンド等で既にtodoが削除されていた場合アラートを出す
    *       $stmt = $this->pdo->prepare("SELECT * FROM todos WHERE id = :id");
    *       $stmt->bindValue('id', $id, \PDO::PARAM_INT);
    *       $stmt->execute();
    *       $todo = $stmt->fetch();
    *       if (empty($todo)) {
    *           header('HTTP', true , 404);
    *           exit;
    *       }

    *       //is_doneの否定を代入し、true falseを切り替える
    *       $stmt = $this->pdo->prepare("UPDATE todos SET is_done = NOT is_done WHERE id = :id");
    *       $stmt->bindValue('id', $id, \PDO::PARAM_INT);
    *       $stmt->execute();

    *       //todoのチェック状態の整合性を保つ処理
    *       //最新のis_done状態を取得。=todoのis_doneの逆の状態
    *       //JSはboolean値はtrue,falseで管理されるので、キャストする。DBは01で管理
    *       return (boolean)!$todo->is_done;
    *   }
    *   
    *   // delete
    *   private function delete() {
    *       $id = filter_input(INPUT_POST, 'id');
    *       if(empty($id)) {
    *           return;
    *       }
    *       // ×を押されたら削除する
    *       $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = :id");  
    *       $stmt->bindValue('id', $id, \PDO::PARAM_INT);
    *       $stmt->execute();
    *   }
    *   
    *   //チェック済みtodoの全消し
    *   private function purge() {
    *       // is_done=1 チェック済みのtodoのみ削除する
    *       $this->pdo->query("DELETE FROM todos WHERE is_done = 1");
    *   }

    *   
    *   // データベースからデータの取得　$todoを表示するために配列を取得する
    *   public function getAll() {
    *       $stmt = $this->pdo->query("SELECT * FROM todos ORDER BY id DESC");
    *       $todos = $stmt->fetchAll();
    *       return $todos;
    *   }
    **/
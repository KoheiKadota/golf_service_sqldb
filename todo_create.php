<?php
// var_dump($_POST);
// exit();
// POSTデータ確認

// NGだった時の条件
if (
  !isset($_POST['date']) || $_POST['date'] === '' ||
  !isset($_POST['course']) || $_POST['course'] === '' ||
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['nameKana']) || $_POST['nameKana'] === '' ||
  !isset($_POST['gender']) || $_POST['gender'] === '' ||
  !isset($_POST['age']) || $_POST['age'] === '' ||
  !isset($_POST['email']) || $_POST['email'] === '' ||
  !isset($_POST['aveScore']) || $_POST['aveScore'] === '' ||
  !isset($_POST['bestScore']) || $_POST['bestScore'] === '' ||
  !isset($_POST['career']) || $_POST['career'] === '' || 
  !isset($_POST['residence']) || $_POST['residence'] === '' || 
  !isset($_POST['freeFormat']) || $_POST['freeFormat'] === '' ||     

) {
  exit('データが足りません。。');
}

$date = $_POST['date'];
$course = $_POST['course'];
$name = $_POST['name'];
$nameKana = $_POST['nameKana'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$email = $_POST['email'];
$aveScore = $_POST['aveScore'];
$bestScore = $_POST['bestScore'];
$career = $_POST['career'];
$residence = $_POST['residence'];
$freeFormat = $_POST['freeFormat'];


// 各種項目設定
$dbn ='mysql:dbname=golf_service;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// SQL作成&実行

$sql = 'INSERT INTO todo_table (id, date, course, name, nameKana, gender, age, email, aveScore, bestScore, career, residence, freeFormat, created_at, updated_at) VALUES (NULL, :date, :course, :name, :nameKana, :gender, :age, :email, :aveScore, :bestScore, :career, :residence, :freeFormat, now(), now())';
 
$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':course', $course, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':nameKana', $nameKana, PDO::PARAM_STR);
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':aveScore', $aveScore, PDO::PARAM_STR);
$stmt->bindValue(':bestScore', $bestScore, PDO::PARAM_STR);
$stmt->bindValue(':career', $career, PDO::PARAM_STR);
$stmt->bindValue(':residence', $residence, PDO::PARAM_STR);
$stmt->bindValue(':freeFormat', $freeFormat, PDO::PARAM_STR);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}


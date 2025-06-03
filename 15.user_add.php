<?php
error_reporting(0);
session_start();

if (!$_SESSION["id"]) {
    echo "請登入帳號";
    echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
} else {
    $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

    if (!$conn) {
        die("資料庫連線失敗：" . mysqli_connect_error());
    }

    // 接收表單輸入資料
    $id = $_POST['id'];
    $pwd = $_POST['pwd'];

    // 密碼加密
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // 使用預處理語句避免 SQL 注入
    $stmt = mysqli_prepare($conn, "INSERT INTO user(id, pwd) VALUES (?, ?)");

    // 綁定參數與執行
    mysqli_stmt_bind_param($stmt, "ss", $id, $hashedPwd);

    if (mysqli_stmt_execute($stmt)) {
        echo "新增使用者成功，三秒鐘後回到網頁";
        echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
    } else {
        echo "新增命令錯誤：" . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

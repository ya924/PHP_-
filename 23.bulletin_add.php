<?php
    error_reporting(0); // 關閉錯誤訊息（開發階段建議開啟）
    session_start(); // 啟用 session 功能

    // 檢查是否登入，否則導向登入頁
    if (!$_SESSION["id"]) {
        echo "請先登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else {
        // 已登入，開始執行新增佈告動作

        // 建立資料庫連線
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 建立 SQL 指令，將表單內容插入 bulletin 表格
        $sql = "INSERT INTO bulletin(title, content, type, time) 
                VALUES('{$_POST['title']}', '{$_POST['content']}', {$_POST['type']}, '{$_POST['time']}')";

        // 執行 SQL 指令
        if (!mysqli_query($conn, $sql)) {
            echo "新增命令錯誤";
        } else {
            echo "新增佈告成功，三秒鐘後回到網頁";
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
        }
    }
?>

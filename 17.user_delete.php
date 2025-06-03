<?php
    error_reporting(0); // 關閉錯誤訊息（開發階段建議打開）

    session_start(); // 啟動 session

    // 檢查是否已登入，若未登入則導回登入頁面
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else {   
        // 已登入，準備進行刪除使用者的動作

        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust"); // 建立資料庫連線

        // 建立刪除指令，根據 GET 傳入的 id 來刪除 user 資料表中的資料
        $sql = "DELETE FROM user WHERE id='{$_GET["id"]}'";
        // echo $sql; // 除錯用，可顯示 SQL 語法

        // 執行 SQL 指令，顯示成功或失敗訊息
        if (!mysqli_query($conn, $sql)) {
            echo "使用者刪除錯誤";
        } else {
            echo "使用者刪除成功";
        }

        // 3 秒後返回使用者清單頁面
        echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
    }
?>

<?php
    error_reporting(0); // 關閉錯誤訊息（開發階段建議打開）
    session_start(); // 啟用 session 功能

    // 檢查是否登入，若未登入則導回登入頁面
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else {   
        // 已登入，進行密碼修改動作

        // 建立資料庫連線
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 執行更新密碼的 SQL 指令
        if (!mysqli_query($conn, "UPDATE user SET pwd='{$_POST['pwd']}' WHERE id='{$_POST['id']}'")) {
            echo "修改錯誤";
            echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
        } else {
            echo "修改成功，三秒鐘後回到網頁";
            echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
        }
    }
?>

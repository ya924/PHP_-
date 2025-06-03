<html>
    <head>
        <title>新增使用者</title> <!-- 網頁標題 -->
    </head>
    <body>

<?php        
    error_reporting(0); // 關閉所有 PHP 錯誤訊息

    session_start(); // 啟動 Session 功能，才能使用 $_SESSION 儲存或取得資料

    // 檢查是否已登入（也就是檢查 $_SESSION["id"] 是否有值）
    if (!$_SESSION["id"]) {
        // 如果尚未登入，顯示提示訊息
        echo "請登入帳號";
        // 3 秒後自動導向登入頁面（2.login.html）
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else {
        // 如果已登入，顯示新增使用者的表單
        echo "
            <form action=15.user_add.php method=post> <!-- 提交表單資料到 15.user_add.php -->
                帳號：<input type=text name=id required><br> <!-- 輸入帳號欄位，加入 required 強制填寫 -->
                密碼：<input type=password name=pwd required><p></p> <!-- 輸入密碼欄位，使用密碼型態隱藏內容 -->
                <input type=submit value=新增> <!-- 送出表單按鈕 -->
                <input type=reset value=清除> <!-- 清除表單內容按鈕 -->
            </form>
        ";
    }
?>

    </body>
</html>

<html>
    <head>
        <title>使用者管理</title> <!-- 網頁標題 -->
    </head>
    <body>
    <?php
        error_reporting(0); // 關閉 PHP 錯誤訊息（開發階段不建議關閉）

        session_start(); // 啟動 session 功能，用來判斷登入狀態

        // 如果尚未登入，顯示提示並自動跳轉至登入頁面
        if (!$_SESSION["id"]) {
            echo "請登入帳號";
            echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
        }
        else {   
            // 如果已登入，顯示使用者管理介面
            echo "<h1>使用者管理</h1>
                [<a href=14.user_add_form.php>新增使用者</a>] 
                [<a href=11.bulletin.php>回佈告欄列表</a>]<br>
                
                <table border=1>
                    <tr><td></td><td>帳號</td><td>密碼</td></tr>";

            // 建立與資料庫的連線
            $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

            // 查詢所有使用者資料
            $result =

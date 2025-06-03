<html>
    <head>
        <meta charset="UTF-8">
        <title>修改使用者</title> <!-- 頁面標題 -->
    </head>
    <body>
    <?php
    error_reporting(0); // 關閉錯誤訊息（開發中建議打開）

    session_start(); // 啟用 session

    // 檢查是否登入
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else {   
        // 已登入，開始取得資料

        // 建立資料庫連線
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 從 GET 傳入的 id 查詢使用者資料
        $result = mysqli_query($conn, "SELECT * FROM user WHERE id='{$_GET['id']}'");
        $row = mysqli_fetch_array($result); // 取得一筆資料

        // 顯示修改表單（帳號不能修改，只能改密碼）
        echo "
        <form method=post action=20.user_edit.php>
            <input type=hidden name=id value='{$row['id']}'> <!-- 用隱藏欄位保留 ID -->
            帳號：{$row['id']}<br> 
            密碼：<input type=text name=pwd value='{$row['pwd']}'><p></p>
            <i


<?php

    // 關閉所有 PHP 錯誤報告。
    // 在正式環境中，這是一個常見的做法，可以避免將敏感的錯誤資訊（例如資料庫憑證、程式碼路徑等）暴露給使用者，
    // 增加網站的安全性。開發階段通常會開啟錯誤報告以便調試。
    error_reporting(0);
    
    // 啟動或恢復當前的 PHP session。
    // Session 是一種在多個頁面請求之間儲存使用者資料的方式。
    // 在這裡，它用於檢查使用者是否已登入。
    session_start();

    // 檢查使用者是否已登入。
    // 如果 $_SESSION["id"] 這個 session 變數不存在或為空，表示使用者尚未登入。
    if (!$_SESSION["id"]) {
        echo "請登入帳號"; // 向使用者顯示提示訊息，告知他們需要登入。
        // 使用 HTML 的 meta 標籤來實現頁面重新導向。
        // content='3' 表示在 3 秒後執行重新導向。
        // url='2.login.html' 指定了重新導向的目標頁面，引導使用者進行登入。
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    // 如果使用者已經登入（即 $_SESSION["id"] 存在）。
    else{   
        // 連接到 MySQL 資料庫。
        // mysqli_connect() 函數用於建立一個到 MySQL 伺服器的連接。
        // 參數依序是：資料庫主機名稱 ("db4free.net"), 資料庫使用者名稱 ("immust"), 資料庫密碼 ("immustimmust"), 資料庫名稱 ("immust")。
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");
        
        // 構建 SQL INSERT 查詢語句。
        // 這個語句的目的是向 `user` 資料表中插入一條新的記錄。
        // `id` 和 `pwd` 欄位的值分別來自於透過 POST 方法提交的表單資料 `$_POST['id']` 和 `$_POST['pwd']`。
        // !! 嚴重安全警示 !!
        // 直接將來自使用者輸入的 `$_POST['id']` 和 `$_POST['pwd']` 變數拼接到 SQL 查詢字串中，
        // 存在嚴重的 **SQL Injection (SQL 隱碼攻擊)** 漏洞。
        // 惡意使用者可以修改表單輸入，插入惡意的 SQL 代碼，
        // 從而執行非預期的操作，例如繞過驗證、修改其他資料，甚至刪除整個資料庫。
        // 在實際應用中，**務必**使用預處理語句 (Prepared Statements) 和參數綁定來防止此類攻擊。
        // 此外，密碼（`$_POST['pwd']`）在儲存到資料庫之前應該進行雜湊（hashing）處理，例如使用 `password_hash()` 函數，
        // 以避免明文儲存密碼帶來的安全風險。
        $sql = "insert into user(id,pwd) values('{$_POST['id']}', '{$_POST['pwd']}')";
        
        // 以下這行是被註解掉的，用於開發者調試時查看實際執行的 SQL 語句。
        #echo $sql;
        
        // 執行 SQL 插入查詢。
        // mysqli_query() 函數用於執行 SQL 查詢。如果查詢執行失敗（例如 SQL 語法錯誤或資料庫連線問題），它會返回 false。
        if (!mysqli_query($conn, $sql)) {
            // 如果查詢執行失敗，顯示錯誤訊息。
            echo "新增命令錯誤";
        } else {
            // 如果查詢執行成功，顯示成功訊息。
            echo "新增使用者成功，三秒鐘後回到網頁";
            // 3 秒後將頁面重新導向到 '18.user.php'。
            // '18.user.php' 可能是顯示使用者列表或管理頁面的 URL。
            echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
        }
    }

?>

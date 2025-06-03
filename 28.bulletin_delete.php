<?php
    // 關閉所有 PHP 錯誤報告。
    // 在正式環境中，這是一個常見的做法，可以避免將敏感的錯誤資訊（例如資料庫憑證、檔案路徑等）暴露給使用者，
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
        // url='2.login.html' 指定了重新導向的目標頁面，通常是登入頁面。
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    // 如果使用者已經登入（即 $_SESSION["id"] 存在）。
    else{   
        // 連接到 MySQL 資料庫。
        // mysqli_connect() 函數用於建立一個到 MySQL 伺服器的連接。
        // 參數依序是：資料庫主機名稱 ("db4free.net"), 資料庫使用者名稱 ("immust"), 資料庫密碼 ("immustimmust"), 資料庫名稱 ("immust")。
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");
        
        // 構建 SQL DELETE 查詢語句。
        // 這個語句的目的是從 `bulletin` 資料表中刪除一條記錄。
        // 刪除的條件是 `bid` (佈告編號) 等於透過 GET 方法從 URL 傳入的 `bid` 值（`$_GET["bid"]`）。
        // !! 嚴重安全警示 !!
        // 直接將來自使用者輸入的 `$_GET["bid"]` 變數拼接到 SQL 查詢字串中，
        // 存在嚴重的 **SQL Injection (SQL 隱碼攻擊)** 漏洞。
        // 惡意使用者可以修改 URL 中的 `bid` 參數，插入惡意的 SQL 代碼，
        // 從而執行非預期的操作，例如刪除整個資料表，或竊取資料。
        // 在實際應用中，**務必**使用預處理語句 (Prepared Statements) 和參數綁定來防止此類攻擊。
        $sql = "delete from bulletin where bid='{$_GET["bid"]}'";
        
        // 以下這行是被註解掉的，用於開發者調試時查看實際執行的 SQL 語句。
        #echo $sql;
        
        // 執行 SQL 刪除查詢。
        // mysqli_query() 函數用於執行 SQL 查詢。如果查詢執行失敗（例如 SQL 語法錯誤或資料庫連線問題），它會返回 false。
        if (!mysqli_query($conn, $sql)){
            // 如果查詢執行失敗，顯示錯誤訊息。
            echo "佈告刪除錯誤";
        }else{
            // 如果查詢執行成功，顯示成功訊息。
            echo "佈告刪除成功";
        }
        
        // 無論刪除成功或失敗，都在 3 秒後將頁面重新導向到 '11.bulletin.php'。
        // '11.bulletin.php' 可能是顯示佈告列表的頁面，讓使用者回到佈告列表查看結果。
        echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
    }
?>

<?php

    // 關閉所有錯誤報告。在正式環境中，這可以避免將敏感的錯誤資訊顯示給使用者。
    error_reporting(0);
    // 啟動或恢復 PHP session。Session 用於在使用者瀏覽網站的不同頁面時，儲存和追蹤使用者的狀態資訊，例如登入狀態。
    session_start();

    // 檢查使用者是否已登入。如果 $_SESSION["id"] 這個 session 變數不存在，表示使用者尚未登入。
    if (!$_SESSION["id"]) {
        echo "請登入帳號"; // 顯示提示訊息，告知使用者需要登入。
        // 使用 HTML 的 meta 標籤進行頁面重新導向。在 3 秒（content='3'）後，將頁面導向到 '2.login.html'，引導使用者進行登入。
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    // 如果使用者已經登入（即 $_SESSION["id"] 存在）。
    else{   
        // 連接到 MySQL 資料庫。
        // mysqli_connect() 函數用於建立一個到 MySQL 伺服器的連接。
        // 參數依序為：主機名稱 ("db4free.net"), 資料庫使用者名稱 ("immust"), 資料庫密碼 ("immustimmust"), 資料庫名稱 ("immust")。
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");
        
        // 執行 SQL UPDATE 查詢來更新佈告資料。
        // 注意：這裡直接將 $_POST 變數的值拼接到 SQL 查詢字串中。
        // 這種做法存在嚴重的 SQL Injection 漏洞！惡意使用者可以透過表單輸入，構造惡意的 SQL 語句，
        // 從而繞過預期邏輯、讀取或修改未經授權的資料，甚至刪除整個資料庫。
        // 在實際應用中，**務必**使用預處理語句（prepared statements）來防止 SQL Injection。
        $sql = "update bulletin set title='{$_POST['title']}',content='{$_POST['content']}',time='{$_POST['time']}',type={$_POST['type']} where bid='{$_POST['bid']}'";
        
        // 執行 SQL 查詢。
        // 如果 mysqli_query() 返回 false，表示查詢執行失敗（例如 SQL 語法錯誤或資料庫問題）。
        if (!mysqli_query($conn, $sql)){
            echo "修改錯誤"; // 顯示錯誤訊息。
            // 3 秒後重新導向到 '11.bulletin.php'（假設是佈告列表頁面）。
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
        } else {
            echo "修改成功，三秒鐘後回到佈告欄列表"; // 顯示成功訊息。
            // 3 秒後重新導向到 '11.bulletin.php'。
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
        }
    }

?>

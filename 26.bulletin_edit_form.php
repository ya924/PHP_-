<?php
    // 關閉所有錯誤報告，避免將敏感的錯誤資訊顯示給使用者
    error_reporting(0);
    // 啟動 PHP session，用於在不同頁面間保持使用者狀態（例如登入資訊）
    session_start();

    // 檢查使用者是否已登入
    // 如果 $_SESSION["id"] 不存在（表示使用者尚未登入）
    if (!$_SESSION["id"]) {
        echo "please login first"; // 顯示提示訊息
        // 頁面在 3 秒後重新導向到 2.login.html，引導使用者登入
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    // 如果使用者已登入
    else{
        // 連接到資料庫
        // 使用 mysqli_connect() 函數，參數依序為：主機名稱, 使用者名稱, 密碼, 資料庫名稱
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");
        
        // 執行 SQL 查詢，從 bulletin 資料表中選取所有資料
        // 條件是 bid (佈告編號) 等於透過 GET 方法從 URL 傳入的 bid 值
        // 這裡存在 SQL Injection 漏洞，因為 $_GET["bid"] 沒有經過任何過濾或驗證就直接拼接到 SQL 語句中
        $result = mysqli_query($conn, "select * from bulletin where bid={$_GET["bid"]}");
        
        // 從查詢結果中取得一行資料，並將其作為關聯陣列（associative array）儲存到 $row 變數中
        $row = mysqli_fetch_array($result);

        // 初始化用於 radio button 的 checked 狀態變數
        $checked1 = "";
        $checked2 = "";
        $checked3 = "";

        // 根據從資料庫取出的佈告類型 (type) 設定對應 radio button 的 checked 屬性
        if ($row['type'] == 1) {
            $checked1 = "checked"; // 如果類型是 1，則系上公告被選中
        }
        if ($row['type'] == 2) {
            $checked2 = "checked"; // 如果類型是 2，則獲獎資訊被選中
        }
        if ($row['type'] == 3) {
            $checked3 = "checked"; // 如果類型是 3，則徵才資訊被選中
        }

        // 輸出 HTML 表單，用於編輯佈告內容
        echo "
        <html>
            <head>
                <title>新增佈告</title>
            </head>
            <body>
                <form method=post action=27.bulletin_edit.php>
                    佈告編號：{$row['bid']} // 顯示佈告編號，不可編輯
                    <input type=hidden name=bid value={$row['bid']}><br> // 隱藏欄位，將佈告編號傳遞給後端處理頁面
                    標　　題：<input type=text name=title value=\"{$row['title']}\"><br> // 標題輸入框，預填資料庫中的標題
                    內　　容：<br>
                    <textarea name=content rows=20 cols=20>{$row['content']}</textarea><br> // 內容文字區域，預填資料庫中的內容
                    佈告類型：
                    <input type=radio name=type value=1 {$checked1}>系上公告　 // 類型選擇：系上公告，根據 $checked1 判斷是否選中
                    <input type=radio name=type value=2 {$checked2}>獲獎資訊 // 類型選擇：獲獎資訊，根據 $checked2 判斷是否選中
                    <input type=radio name=type value=3 {$checked3}>徵才資訊<br> // 類型選擇：徵才資訊，根據 $checked3 判斷是否選中
                    發布時間：<input type=date name=time value={$row['time']}><p></p> // 發布時間選擇器，預填資料庫中的時間
                    <input type=submit value=修改佈告> // 提交按鈕，用於修改佈告
                    <input type=reset value=清除> // 重置按鈕，用於清除表單內容
                </form>
            </body>
        </html>
        ";
    }
?>

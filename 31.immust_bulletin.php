<!DOCTYPE html>
<html>
    <head>
        <title>明新科技大學資訊管理系</title>
        <meta charset="utf-8"> <link href="https://cdn.bootcss.com/flexslider/2.6.3/flexslider.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/jquery/2.2.2/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/flexslider/2.6.3/jquery.flexslider-min.js"></script>         
        <script>
            // 當網頁所有內容（包括圖片）都載入完成後執行此函數
            $(window).load(function() {
                // 選取所有 class 為 'flexslider' 的元素，並初始化為 FlexSlider 輪播
                $('.flexslider').flexslider({
                    animation: "slide", // 設定輪播動畫為「滑動」效果
                    rtl: true // 設定輪播方向為從右到左 (Right-to-Left)
                });
            });
        </script>
        <style>
            /* 通用樣式設定，應用於所有 HTML 元素 */
            *{
                margin:0; /* 移除所有元素的外邊距 */
                color:gray; /* 設定所有文字顏色為灰色 */
                text-align:center; /* 設定所有文字水平居中 */
            }
            /* 頂部區域樣式 */
            .top{
                 background-color: white; /* 背景顏色為白色 */
            }
            /* 頂部容器樣式，使用 Flexbox 佈局 */
            .top .container{
                display: flex; /* 啟用 Flexbox */
                align-items: center; /* 垂直居中對齊子項目 */
                justify-content: space-between; /*

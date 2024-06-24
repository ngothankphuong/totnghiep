
<script type="text/javascript">
        // Kết nối đến WebSocket server
        var ws = new WebSocket('ws://localhost:8080');

        // Khi kết nối được mở
        ws.onopen = function() {
            console.log('Connected to WebSocket server');
        };


        // Khi nhận được tin nhắn từ server
        ws.onmessage = function(event) {
            var msg = JSON.parse(event.data);

            console.log('Tin được chuyển tiếp server:', msg);

        };

        // close connect websocket
        ws.onclose = function() {
            console.log('Disconnected from WebSocket server');
        };

        // Khi có lỗi xảy ra
        ws.onerror = function(error) {
            console.error('WebSocket error:', error);
        };



</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHUYỂN TIẾP</title>
</head>
<body>
    <h1>TRANG NHẬN DỮ LIỆU CHUYỂN TIẾP TỪ SERVER</h1>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Hệ thống quản lý cảm nghĩ sinh viên</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Roboto', sans-serif;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
	color: #fff;
	background: #4b5366;		
	padding: 16px 25px;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}

.table-title h2 {
    margin: 8px 0 0;
    font-size: 22px;
}

.show-entries select.form-control {        
	width: 60px;
	margin: 0 5px;
}
.table-filter .filter-group {
	float: right;
	margin-left: 15px;
}
.table-filter input, .table-filter select {
	height: 34px;
	border-radius: 3px;
	border-color: #ddd;
	box-shadow: none;
}
.table-filter {
	padding: 5px 0 15px;
	border-bottom: 1px solid #e9e9e9;
	margin-bottom: 5px;
}
.table-filter .btn {
	height: 34px;
}
.table-filter label {
	font-weight: normal;
	margin-left: 10px;
}
.table-filter select, .table-filter input {
	display: inline-block;
	margin-left: 5px;
}
.table-filter input {
	width: 120px;
	display: inline-block;
}
.filter-group select.form-control {
	width: 110px;
}
.filter-icon {
	float: right;
	margin-top: 7px;
}
.filter-icon i {
	font-size: 18px;
	opacity: 0.7;
}	

table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table td:last-child {
    width: 130px;
}
table.table td a {
    color: #a0a5b1;
    display: inline-block;
    margin: 0 5px;
}
table.table td a.view {
    color: #03A9F4;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
}    
.pagination {
    float: right;
    margin: 0 0 5px;
}
.pagination li a {
    border: none;
    font-size: 95%;
    width: 30px;
    height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 30px !important;
    text-align: center;
    padding: 0;
}
.pagination li a:hover {
    color: #666;
}	
.pagination li.active a {
    background: #03A9F4;
}
.pagination li.active a:hover {        
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
}
.hint-text {
    float: left;
    margin-top: 6px;
    font-size: 95%;
}    
</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	$('#myTable').dataTable({
		"bFilter" : true,
		"stateSave": true,
		"oLanguage": {
			"sSearch" : "Lọc: ",
			"sLengthMenu": "Hiện _MENU_ cảm nghĩ",
			"sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ cảm nghĩ",
			"oPaginate" : {
				"sFirst" : "Đầu",
				"sLast" : "Cuối",
				"sNext" : "Sau",
				"sPrevious" : "Trước"
			}
		}
	});
});
</script>
<?php
// PHUONG
	include('session.php');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>




</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Quản Lý Cảm Nghĩ</h2>
                    </div>
					<div class="col-sm-8" style="text-align:right;">						
                        <span>Xin Chào! <?php echo $login_name; ?></span>	
                        <a href="logout.php" class="btn btn-secondary"><span>Thoát</span></a>
                    </div>
                </div>
            </div>
            <table class=" table table-striped table-hover table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
						<th>Ảnh</th>
                        <th>Họ Tên</th>
                        <th>Lớp</th>
						<th>MSSV</th>
                        <th>Cảm Nghĩ</th>
                        <th>Năm</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					date_default_timezone_set('Asia/Ho_Chi_Minh');
					$sql = "SELECT * FROM camnghi WHERE DELETED = 0 ORDER BY MSSV";
					$result = $conn->query($sql);
					
					while($row = $result->fetch_assoc()) { 
				?>
                    <tr>
                        <td><?php echo $row["ID"]; ?></td>
                        <td><img src="uploads/<?php echo $row["MSSV"]; ?>.jpg" width="150px" height="170px" alt="Không có ảnh"></td>
                        <td><?php echo $row["HOTEN"]; ?></td>
                        <td><?php echo $row["LOP"]; ?></td>
						<td><?php echo $row["MSSV"]; ?></td>
                        <td><?php echo $row["CAMNGHI"]; ?></td>
                        <td><?php echo $row["NAM"]; ?></td>
                        <td><?php if ($row["SHOWED"]) {
							echo '<a href="inactive.php?id='. $row["ID"] .'" class="view" title="Ẩn" data-toggle="tooltip"><i class="material-icons">&#xe8f5;</i></a>';
						} else {
							echo '<a href="active.php?id='. $row["ID"] .'" class="view" title="Hiện" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>';
						} ?>							
                            <a href="delete.php?id=<?php echo $row["ID"]; ?>" class="delete" title="Xoá" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            <a class="forward" data-id="<?php echo $row["ID"] ?>" data-toggle="tooltip" title="Chuyển tiếp" style="color:#000" >=></a>
                        </td>
                    </tr>
				<?php
					}
				?>                          
                </tbody>
            </table>
        </div>
    </div>  
</div>


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

            console.log('Tin nhắn từ server:', msg);
            
            var table = $('#myTable').DataTable();  

            table.row.add([
                msg.id,
                `<img src="uploads/${msg.mssv}.jpg" width="150px" height="170px" alt="Không có ảnh">`,
                msg.name,
                msg.class,
                msg.mssv,
                msg.message,
                '2024',
                `<a href="inactive.php?id=${msg.id}" class="view" title="Ẩn" data-toggle="tooltip"><i class="material-icons">&#xe8f5;</i></a>
                <a href="delete.php?id=${msg.id}" class="delete" title="Xoá" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                <a class="forward" data-toggle="tooltip" data-id="${msg.id}" title="Chuyển tiếp" style="color:#000" href="chuyentiep.php?id=${msg.id}">=></a>
                
                `
            ]).draw(false);  
            
            $('[data-toggle="tooltip"]').tooltip();
        };

        //chuyển tiếp gửi tin nhắn đến server
        $(document).on('click', '.forward', function(event) {
            event.preventDefault();

            // Lấy ID
            var id = $(this).data('id');

            // Gửi ID chuyển tiếp
            ws.send(JSON.stringify({ id_forward: id }));

            console.log('Đã gửi ID:', id);
        });

        
        // close connect
        ws.onclose = function() {
            console.log('Disconnected from WebSocket server');
        };

        // Khi có lỗi 
        ws.onerror = function(error) {
            console.error('WebSocket error:', error);
        };
</script>

</body>
</html>
<?php
	include 'connection.php';

	date_default_timezone_set('Asia/Ho_Chi_Minh');

	$sql = "SELECT * FROM camnghi WHERE SHOWED = 1 ORDER BY ID Desc";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) { 
		
			echo '<div class="u-align-left u-container-style u-list-item u-palette-4-base u-repeater-item u-shape-rectangle u-list-item-1">'.
              '<div class="u-container-layout u-similar-container u-container-layout-1">'.
                '<div alt="" class="u-border-7 u-border-white u-image u-image-circle u-image-1" data-image-width="1500" data-image-height="1000" style="width: 183px; height: 183px; background-image: url(uploads/'. $row["MSSV"] .'.jpg); background-position: 100% 50%; margin: -78px auto 0 -26px;"></div>'.
                '<h5 class="u-text u-text-3">'. $row["HOTEN"] .' - '. $row["LOP"] .' - '. $row["MSSV"] .'</h5>'.
                '<p class="u-text u-text-body-alt-color u-text-4">'. $row["CAMNGHI"] .'</p>'.
				'<p class="u-text u-text-body-alt-color u-text-4">'. '<img src="images/'.  $row["MSSV"] .'.png" width="100%">' .'</p>'.
              '</div>'.
            '</div>';
		
	  }
	} else {
	  echo "0 results";
	}
	$conn->close();
	?>
<?php 
include_once('../mangaku/conn.php');
include_once('../mangaku/templates/templatesmanga.php');
$sql = "SELECT * FROM `category` WHERE title = '$manga' LIMIT 1";
$query = mysqli_query($conn, $sql);
include('../mangaku/templates/header.php');
?>
<body>
<div class="super_container">
	<!-- Page Content -->
        <div class="page_content">
            <div class="container">
                <div class="row row-lg-eq-height">
					<div class="col-lg-9">
                        <div class="post_content">
	<?php 
	while ($row = mysqli_fetch_array($query)){
		echo '<div class="post_body">';
		$rawtime = $row['last_updated'];
		$time = strtotime($rawtime);
		echo '<hr>';
        echo '<img src="'.$row['cover'].'"class="float-left mr-1">';
		echo '<h4 class="section_title">'.$row['title'].'</h4>';
		$sql4 = "SELECT komikus FROM `komikus` WHERE title = '$manga' LIMIT 1";
		$query4 = mysqli_query($conn, $sql4);
		while ($row2 = mysqli_fetch_array($query4)){
			$genre = $row2['komikus'];
		}
		echo '<table class="table-bordered">
				<tbody>
                <tr>
					<th class="bg-dark text-white p-1">Komikus
                    </th>
                    <td>'.$genre.'</td>
                </tr>
                <tr>
                    <th class="bg-dark text-white p-1">Type
                    </th>
                    <td><a class="p-2" href="">'.$row['type'].'</a></td>
                </tr>
                <tr>
                    <th class="bg-dark text-white p-1">Views
                    </th>
                    <td>'.$row['view'].'</td>
                </tr>
                </tbody>
			  </table>';
		echo '<h4>Synopsis : </h4>';
		echo '<h6>'.$row['synopsis'].'</h6>';
		echo '<h4>'.$row['vote'].' vote</h4>';
		$sql2 = "SELECT genre FROM `genre` WHERE title = '$manga'";
		$query2 = mysqli_query($conn, $sql2);
		while ($row = mysqli_fetch_array($query2)){
			echo '<h4>'.$row['genre'].'</h4>';
		}
	}
	?>
							</div>
							<table class="table table-hover">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th scope="col">No</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Rilis</th>
                                        <th scope="col">Download</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									$sql2 = "SELECT * FROM `chapter` WHERE title = '$manga' AND completed = 1";
									$query2 = mysqli_query($conn, $sql2);
									while ($row2 = mysqli_fetch_array($query2)){
										echo '<h4>'.$row2['view'].' view</h4>';
										$rawtime = $row2['time_uploaded'];
										$time = strtotime($rawtime);
										echo '
										<tr>
											<th scope="row">1</th>
											<td><a href="'.$row2['folder_name'].'">'.$row2['chapter'].'</a></td>
											<td>'.humanTiming($time).' ago</td>
											<td><a href=""><i class="fa fa-download"></i></a></td>
										</tr>';
									}
								?>
                                </tbody>
                            </table>
						</div>
					</div>
                    <!-- Sidebar -->

                    <div class="col-lg-3">
                        <div class="sidebar">
                            <div class="sidebar_background"></div>

                            <!-- Iklan -->
                            <div class="sidebar_section">
                                <div class="advertising">
                                    <div class="advertising_background"
                                        style="background-image:url(../mangaku/images/post_17.jpg)">
                                    </div>
                                    <div
                                        class="advertising_content d-flex flex-column align-items-start justify-content-end">
                                        <div class="advertising_perc">-15%</div>
                                        <div class="advertising_link"><a href="#">How Did van Gogh’s Turbulent
                                                Mind</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Iklan 2 -->
                            <div class="sidebar_section">
                                <div class="advertising">
                                    <div class="advertising_background"
                                        style="background-image:url(../mangaku/images/post_17.jpg)">
                                    </div>
                                    <div
                                        class="advertising_content d-flex flex-column align-items-start justify-content-end">
                                        <div class="advertising_perc">-15%</div>
                                        <div class="advertising_link"><a href="#">How Did van Gogh’s Turbulent
                                                Mind</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
</body>
<?php 
include('../mangaku/templates/footer.php');
function humanTiming ($timed)
{
	$cur = date('Y/m/d H:i:s');
	$current = strtotime($cur);
    $time = $current-$timed; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}
?>
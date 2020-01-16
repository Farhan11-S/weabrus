<?php 
include_once('mangaku/conn.php');
include_once('mangaku/templates/templatesindex.php');
?>
<body>
<div class="super_container">
	<?php 
	include('mangaku/templates/header.php');
	$sql = "SELECT * FROM `category` ORDER BY `category`.`view` DESC LIMIT 6";
	$query = mysqli_query($conn, $sql);
	$sql3 = "SELECT * FROM category ORDER BY `category`.`last_updated` DESC LIMIT 6";
	$query3 = mysqli_query($conn, $sql3);
	$sql4 = "SELECT * FROM `category` ORDER BY RAND() DESC LIMIT 4";
	$query4 = mysqli_query($conn, $sql4);
	$sql5 = "SELECT * FROM `category` ORDER BY RAND() DESC LIMIT 4";
	$query5 = mysqli_query($conn, $sql5);
	$sql6 = "SELECT * FROM `category` ORDER BY RAND() DESC LIMIT 4";
	$query6 = mysqli_query($conn, $sql6);
	$sql7 = "SELECT * FROM category ORDER BY `category`.`last_updated` DESC LIMIT 6";
	$query7 = mysqli_query($conn, $sql7);
	?>
	<!-- Page Content -->
	<div class="page_content">
		<div class="container">
			<div class="row row-lg-eq-height">

				<!-- Main Content -->

				<div class="col-lg-9">
					<div class="main_content">
						<!-- Popular -->
						<div class="blog_section">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Popular</div>
								<div class="section_panel_more">
									<a class="text-dark" href="">More <i class="fa fa-angle-right"></i></a>
								</div>
							</div>

							<div class="container">
								<div class="scrolling-wrapper">
									<?php 
										while ($row = mysqli_fetch_array($query)){
											$title = $row['title'];
											$sql2 = "SELECT chapter FROM chapter WHERE title = '$title'";
												$query2 = mysqli_query($conn, $sql2);
												while ($row2 = mysqli_fetch_array($query2)){
													$chapter = $row2['chapter'];
												}
											$sql2 = "SELECT folder_name FROM list WHERE title = '$title'";
												$query2 = mysqli_query($conn, $sql2);
												while ($row2 = mysqli_fetch_array($query2)){
													$link = $row2['folder_name'];
												}
											echo '<div class="card m-2" style="width: 10rem;">
											<a href="'.$link.'"> <img src="scraper/'.$row['cover'].'" class="card-img-top">
												<div class="card-body">
													<h5 class="card-title card-title-small text-dark">'.$title.'</h5>
													<small class="post_meta">'.$chapter.'<span>'.$row['last_updated'].'</span></small>
												</div>
											</a>
										</div>';
										}
									?>
								</div>
							</div>
						</div>

						<!-- Latest Updates -->
						<div class="blog_section">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Latest Updates</div>
								<div class="section_panel_more">
									<a class="text-dark" href="">More <i class="fa fa-angle-right"></i></a>
								</div>
							</div>

							<div class="container">
								<div class="scrolling-wrapper">
									<?php 
										while ($row = mysqli_fetch_array($query3)){
											$title = $row['title'];
											$sql2 = "SELECT chapter FROM chapter WHERE title = '$title'";
												$query2 = mysqli_query($conn, $sql2);
												while ($row2 = mysqli_fetch_array($query2)){
													$chapter = $row2['chapter'];
												}
											$sql2 = "SELECT folder_name FROM list WHERE title = '$title'";
												$query2 = mysqli_query($conn, $sql2);
												while ($row2 = mysqli_fetch_array($query2)){
													$link = $row2['folder_name'];
												}
											echo '<div class="card m-2" style="width: 10rem;">
											<a href="'.$link.'"> <img src="scraper/'.$row['cover'].'" class="card-img-top">
												<div class="card-body">
													<h5 class="card-title card-title-small text-dark">'.$title.'</h5>
													<small class="post_meta">'.$chapter.'<span>'.$row['last_updated'].'</span></small>
												</div>
											</a>
										</div>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Sidebar -->
				<div class="col-lg-3">
					<div class="sidebar">
						<div class="sidebar_background"></div>

						<!-- Recommended -->
						<div class="sidebar_section">
							<div class="sidebar_title_container">
								<div class="sidebar_title">Recommended</div>
								<div class="sidebar_slider_nav">
									<div class="custom_nav_container sidebar_slider_nav_container">
										<div class="custom_prev custom_prev_top">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
												<polyline fill="#bebebe" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
											</svg>
										</div>
								        <ul id="custom_dots" class="custom_dots custom_dots_top">
											<li class="custom_dot custom_dot_top active"><span></span></li>
											<li class="custom_dot custom_dot_top"><span></span></li>
											<li class="custom_dot custom_dot_top"><span></span></li>
										</ul>
										<div class="custom_next custom_next_top">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
												<polyline fill="#bebebe" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
											</svg>
										</div>
									</div>
								</div>
							</div>
							<div class="sidebar_section_content">
								<!-- Top Stories Slider -->
								<div class="sidebar_slider_container">
									<div class="owl-carousel owl-theme sidebar_slider_top">

										<!-- Top Stories Slider Item -->
										<div class="owl-item">
											<!-- Sidebar Post -->
											<?php 
											while ($row = mysqli_fetch_array($query4)){
												$title = $row['title'];
												$sql2 = "SELECT chapter FROM chapter WHERE title = '$title'";
												$query2 = mysqli_query($conn, $sql2);
												while ($row2 = mysqli_fetch_array($query2)){
													$chapter = $row2['chapter'];
												}
												echo '<div class="side_post">
													<a href="post.html">
														<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
															<div class="side_post_image"><div><img src="scraper/'.$row['cover'].'" alt=""></div></div>
															<div class="side_post_content">
																<div class="side_post_title">'.$title.'</div>
																<small class="post_meta">'.$chapter.'<span>'.$row['last_updated'].'</span></small>
															</div>
														</div>
													</a>
												</div>';
											}
											?>
										</div>

										<!-- Top Stories Slider Item -->
										<div class="owl-item">
											<!-- Sidebar Post -->
											<?php 
											while ($row = mysqli_fetch_array($query5)){
												$title = $row['title'];
												$sql2 = "SELECT chapter FROM chapter WHERE title = '$title'";
												$query2 = mysqli_query($conn, $sql2);
												while ($row2 = mysqli_fetch_array($query2)){
													$chapter = $row2['chapter'];
												}
												echo '<div class="side_post">
													<a href="post.html">
														<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
															<div class="side_post_image"><div><img src="scraper/'.$row['cover'].'" alt=""></div></div>
															<div class="side_post_content">
																<div class="side_post_title">'.$title.'</div>
																<small class="post_meta">'.$chapter.'<span>'.$row['last_updated'].'</span></small>
															</div>
														</div>
													</a>
												</div>';
											}
											?>
										</div>

										<!-- Top Stories Slider Item -->
										<div class="owl-item">
											<!-- Sidebar Post -->
											<?php 
											while ($row = mysqli_fetch_array($query6)){
												$title = $row['title'];
												$sql2 = "SELECT chapter FROM chapter WHERE title = '$title'";
												$query2 = mysqli_query($conn, $sql2);
												while ($row2 = mysqli_fetch_array($query2)){
													$chapter = $row2['chapter'];
												}
												echo '<div class="side_post">
													<a href="post.html">
														<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
															<div class="side_post_image"><div><img src="scraper/'.$row['cover'].'" alt=""></div></div>
															<div class="side_post_content">
																<div class="side_post_title">'.$title.'</div>
																<small class="post_meta">'.$chapter.'<span>'.$row['last_updated'].'</span></small>
															</div>
														</div>
													</a>
												</div>';
											}
											?>
										</div>

									</div>
								</div>
							</div>
						</div>

						<!-- Iklan -->
						<div class="sidebar_section">
							<div class="advertising">
								<div class="advertising_background" style="background-image:url(mangaku/images/post_17.jpg)"></div>
								<div class="advertising_content d-flex flex-column align-items-start justify-content-end">
									<div class="advertising_perc">-15%</div>
									<div class="advertising_link"><a href="#">How Did van Gogh’s Turbulent Mind</a></div>
								</div>
							</div>
						</div>

						<!-- Latest Updates -->
						<div class="sidebar_section newest_videos">
							<div class="sidebar_title_container">
								<div class="sidebar_title">Latest Updates</div>
							</div>
							<div class="sidebar_section_content">

								<!-- Sidebar Slider -->
								<div>
									<div>

										<!-- Newest Videos Slider Item -->
										<div class="owl-item">

											<?php 
											while ($row = mysqli_fetch_array($query7)){
												$title = $row['title'];
												$sql2 = "SELECT chapter FROM chapter WHERE title = '$title'";
												$query2 = mysqli_query($conn, $sql2);
												while ($row2 = mysqli_fetch_array($query2)){
													$chapter = $row2['chapter'];
												}
												echo '<div class="side_post">
													<a href="post.html">
														<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
															<div class="side_post_image"><div><img src="scraper/'.$row['cover'].'" alt=""></div></div>
															<div class="side_post_content">
																<div class="side_post_title">'.$title.'</div>
																<small class="post_meta">'.$chapter.'<span>'.$row['last_updated'].'</span></small>
															</div>
														</div>
													</a>
												</div>';
											}
											?>

										</div>

									</div>
								</div>
							</div>
						</div>

						<!-- Iklan 2 -->
						<div class="sidebar_section">
							<div class="advertising_2">
								<div class="advertising_background" style="background-image:url(mangaku/images/post_18.jpg)"></div>
								<div class="advertising_2_content d-flex flex-column align-items-center justify-content-center">
									<div class="advertising_2_link"><a href="#">Turbulent <span>Mind</span></a></div>
								</div>
							</div>
						</div>`

					</div>
				</div>

			</div>
		</div>
	</div>
	<?php 
	include('mangaku/templates/footer.php');
	?>
</div>
</body>
</html>
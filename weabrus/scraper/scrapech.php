<?php 
include_once('htmldom/simple_html_dom.php');
include_once('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=0.9" name="viewport">
<style> 
.form-button {
background-color: #ffb52f;
color: white;
padding: 12px 20px;
border: none;
border-radius: 4px;
cursor: pointer;
}               
.form-button:hover {
background-color: #00428a;
}
</style>
<?php
	$sql = "SELECT * FROM list";
	$query = mysqli_query($conn, $sql);
	$css = "section#chapter div.news table.chapter tbody._3Rsjq tr td.judulseries a";
	$css2 = "div.konten img.g";
	$include = '<?php include_once("../../templateschapter/index.php"); ?>';
	while ($row = mysqli_fetch_array($query)){
		if(is_dir("../".$row['folder_name'])){
			$link = $row['link'];
			$title = $row['title'];
			$number = 1;
			if($html = file_get_html($link)){
				foreach($html->find($css) as $element){
					$item['manga_title'] = $element->title;
					$item['manga_link'] = $element->href;
					$stripslash = str_replace('/','(slash)',$item['manga_title']);
					$clear = str_replace(':','(colon)',$stripslash);
					$clear2 = str_replace('-','(dash)',$clear);
					$clear3 = str_replace('?','(ask)',$clear2);
					$clear4 = str_replace('~','(tilde)',$clear3);
					$clear5 = str_replace(' ','-',$clear4);
					if(!is_dir("../".$row['folder_name']."/".$number)){
						mkdir("../".$row['folder_name']."/".$number);
						$myfile = fopen("../".$row['folder_name']."/".$number."/index.php", "w") or die("Unable to open file!");
						$escape = mysqli_real_escape_string($conn, $item['manga_title']);
						$write = '<?php $title = "'.$escape.'"; ?>';
						$write2 = '<?php $folder = "'.$number.'"; ?>';
						$write3 = '<?php $manga = "'.$title.'"; ?>';
						fwrite($myfile, $write3);
						fwrite($myfile, $write2);
						fwrite($myfile, $write);
						fwrite($myfile, $include);
						fclose($myfile);
						$manga[] = $item;
						$sql = "INSERT INTO chapter(title,chapter,folder_name,link,time_uploaded) VALUES ('$title','$escape', '$number','$element->href',now())";
						mysqli_query($conn,$sql);
						$sql2 = "UPDATE category SET last_updated=now() WHERE title='$title'";
						mysqli_query($conn,$sql2);
						if($html2 = file_get_html($element->href)){
							$q = 1;
							foreach($html2->find($css2) as $element2){
								$sourceimg = $element2->src;
								$imgName = "../".$row['folder_name']."/".$number."/".$q.".jpg";
								file_put_contents($imgName, file_get_contents_curl($sourceimg));
								$file = $q.'.jpg';
								$sql3 = "INSERT INTO image(chapter,image) VALUES ('$escape','$file')";
								mysqli_query($conn,$sql3);
								$q++;
							}
							$sql67 = "UPDATE chapter SET completed=1 WHERE chapter='$escape'";
							mysqli_query($conn,$sql67);
						}
						else{
							$eror2[] = $item;
						}
						$number++;
					}
				}
			}
			else{
				$eror[] = $row['title'];
			}
		}
	}
	if(isset($manga)){
		$count = count($manga);
	}
?>
<body>
    <div class="main_content">
      <div class="info">
        <div id="toggleText">
          <form method="post" enctype="multipart/form-data">
            <input class="form-button" type="submit" value="SUBMIT" name="submit" >
          </form>
        </div>
      </div>
	  <h2> Ditemukan <?php if(isset($count)){echo $count;} else{echo '0';}?> Chapter </h2>
    </div>
</body>
<?php
if(isset($manga)){
	foreach($manga as $item){
		echo $item['manga_title'] . '<br>';
		echo $item['manga_link'] . '<br>';
		echo '<br>';
	}
}
if(isset($eror)){
	foreach($eror as $item){
		echo $item['title'] . '<br>';
		echo '<br>';
	}
}
else{
	echo "No Broken Link";
}
if(isset($eror2)){
	foreach($eror2 as $item){
		echo $item['title'] . '<br>';
		echo '<br>';
	}
}
else{
	echo "No Broken Chapter";
}
function file_get_contents_curl($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
?>
</html>

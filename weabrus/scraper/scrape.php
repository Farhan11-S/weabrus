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
	$link = "https://komiku.co/daftar-komik/";
	$css = "div div div div div a[title]";
	$css2 = "section#komik";
	$css3 = "section#informasi ul.baru li b";
	$include = "<?php include_once('../templatesmanga/index.php'); ?>";
	if(isset($_POST['submit'])){
		if(isset($_POST['select2'])){
			$select2 = $_POST['select2'];
			if($link != null){
				$i = 1;
				// Create DOM from URL or file
				$html = file_get_html($link);
				// Find all links
				foreach($html->find($css) as $element){
					//if($i>6){break;}
					if($element->title == $select2){
						$href = $element->href."?cat=1#chapter";
						$item['manga_title'] = $element->title;
						$item['manga_link'] = $href;
						$escape = mysqli_real_escape_string($conn, $item['manga_title']);
						$escape2 = str_replace('Komik ','',$escape);
						$escape3 = str_replace('Komik ','',$item['manga_title']);
						$stripslash = str_replace('/','(slash)',$item['manga_title']);
						$clear = str_replace(':','(colon)',$stripslash);
						$clear2 = str_replace('-','(dash)',$clear);
						$clear3 = str_replace('?','(ask)',$clear2);
						$clear4 = str_replace('~','(tilde)',$clear3);
						$clear5 = str_replace('Komik ','',$clear4);
						$clear6 = mysqli_real_escape_string($conn, $clear5);
						$clear7 = str_replace(' ','-',$clear6);
						if (!is_dir("../".$clear7)) {
							mkdir("../".$clear7, 0777, true);
							$myfile = fopen("../".$clear7."/index.php", "w") or die("Unable to open file!");
							$write = '<?php $title = "'.$escape2.'"; ?>';
							fwrite($myfile, $write);
							fwrite($myfile, $include);
							fclose($myfile);
							$sql = "INSERT INTO list(title,folder_name,link) VALUES ('$escape2','$clear7','$href')";
							mysqli_query($conn,$sql);
							$html2 = file_get_html($element->href);
							// Find all links
							foreach($html2->find($css2) as $element){
								$tipe;
								$sinopsis;
								foreach($element->find("div.imgseries img") as $element3){
									mkdir("../".$clear7."/cover", 0777, true);
									$sourceimg = $element3->src;
									$imgName = "../".$clear7."/cover/".$clear7.".jpg";
								}
								foreach($element->find("div.info1") as $element2){
									foreach($element2->find("a.tipe_n") as $element3){
										$tipe = $element3->plaintext;
									}
									foreach($element2->find("div.sinopsis p") as $element3){
										$sinopsis2 = str_replace($tipe,'',$element3->plaintext);
										$sinopsis3 = str_replace($escape3,'',$sinopsis2);
										$sinopsis = str_replace("bercerita tentang",'',$sinopsis3);
									}
								}
								foreach($element->find("ul.genre li a") as $element2){
									$sql3 = "INSERT INTO genre(title,genre) VALUES ('$escape2','$element2->plaintext')";
									mysqli_query($conn,$sql3);
								}
								file_put_contents($imgName, file_get_contents_curl($sourceimg));
								$sql2 = "INSERT INTO category(title,cover,type,synopsis) VALUES ('$escape2','$imgName','$tipe','$sinopsis')";
								mysqli_query($conn,$sql2);
							}
							$z = 1;
							foreach($html2->find($css3) as $element4){
								$komikus = $element4->plaintext;
								if($z==2){
									$sql4 = "INSERT INTO komikus(title,komikus) VALUES ('$escape2','$komikus')";
									mysqli_query($conn,$sql4);
								}
								$z++;
							}
							$manga[] = $item;
						}
					}
					$i++;
				}
				if(isset($manga)){
				$count = count($manga);}
			}
			else{
				  echo "<script>alert('Isi Link!');</script>";
			}
		}
		else{
			if($link != null){
				$html = file_get_html($link);
					// Find all links
					foreach($html->find($css) as $element){
						//if($i>6){break;}
						$item['manga_title'] = $element->title;
						$item['manga_link'] = $element->href;
						$manga[] = $item;
					}
			}
			else{
				  echo "<script>alert('Isi Link!');</script>";
			}
		}
    }
?>
<body>
    <div class="main_content">
      <div class="info">
        <div id="toggleText">
          <form method="post" enctype="multipart/form-data">
				<?php if(!empty($_POST['select2'])){
					if(isset($manga)){
						foreach($manga as $item){
							echo $item['manga_title'] . '<br>';
							echo $item['manga_link'] . '<br>';
							echo '<br>';
						}
					}
				}
				else{
					if(isset($manga)){
						echo '<select name="select2">';
						foreach($manga as $item){
							echo '<option name="'.$item['manga_title'].'" value="'.$item['manga_title'].'">'.$item['manga_title'].'</option>';
							$n++;
						}
						echo'</select>';
					}
				}?>
            <input class="form-button" type="submit" value="SUBMIT" name="submit" >
          </form>
        </div>
      </div>
	  <h2> Ditemukan <?php if(isset($count)){echo $count;} else{echo '0';}?> Judul </h2>
    </div>
</body>
<?php
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

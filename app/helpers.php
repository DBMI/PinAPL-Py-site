<?php 
set_include_path(getcwd());
// include '/vendor/laravel/framework/src/Illuminate/Foundation/helpers.php';
restore_include_path();

function csvToMysql ($file, $table, $columns, $seperator=',', $skipLines=0, $extraData=[]){
	if ($file==null) {
		\Log::error("The data files does not exist: $file");
		return false;
	}
	$query = 
		"LOAD DATA LOCAL INFILE '$file'
		INTO TABLE $table
		FIELDS TERMINATED BY '$seperator'
		LINES TERMINATED BY '\n' ";
	if ($skipLines) {
		$query .= " IGNORE $skipLines LINES ";
	}
	$query .= ' ('.implode($columns,',').')';
	if ($extraData) {
		$query .= ' SET';
		foreach ($extraData as $key => $value) {
			$query .= " $key='$value',";
		}
		$query = rtrim($query,',');
	}
	return \DB::connection()->getpdo()->exec($query);
}

function csvToArray($filename = '', $delimiter = ',')
{
	if (!file_exists($filename) || !is_readable($filename))
		return false;

	$header = null;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== false)
	{
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
		{
			if (!$header)
				$header = $row;
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}

	return $data;
}

function download($file, $name = null, array $headers = array(), $disposition = 'attachment')
{
	$response = response()->download($file, $name, $headers, $disposition);
	ob_end_clean();
	return $response;
}

function return_bytes($val)
{
  $val = trim($val);
  $last = strtolower($val[strlen($val) - 1]);
  switch ($last) {
  // The 'G' modifier is available since PHP 5.1.0  
  case 'g':
    $val*= 1024;
  case 'm':
    $val*= 1024;
  case 'k':
    $val*= 1024;
  }
  return $val;
}

function makeDir($path, $mode = 0755, $recursive = false, $force = false)
{
	$umask_old = umask(0);
	$result;
	if ($force){
		$result = @mkdir($path, $mode, $recursive);
	}
	else{
		$result = mkdir($path, $mode, $recursive);
	}
	umask($umask_old);
	return $result;
}

function drawRecipe($recipe, $buttons = false, $clickToFollow = true){
	if ($clickToFollow) { ?>
	<a href="<?php echo "/recipes/show/$recipe->id" ?>">
	<?php }
	?>
		<div class="row fullWidth recipe">
			<div class="columns medium-3">
				<div class="row">
					<span><b> <?php echo $recipe->name ?></b></span>
				</div>
				<div class="row">
					<span>Author(s): <?php echo  $recipe->author ?></span>
				</div>
				<div class="row">
					<span>Created On: <?php echo  date("Y-m-d",strtotime($recipe->created_at)) ?></span>
				</div>
				<div class="row">
					<span>Platform(s): <?php echo  $recipe->platform ?></span>
				</div>
			</div>
			<?php if ($buttons) { ?>
				<div class="columns medium-4"> <?php
			} else{ ?>
				<div class="columns medium-4 end"> <?php
			} ?>
				<div class="row">
					<span><b>Description</b></span>
				</div>
				<div class="row">
					<p><?php echo  substr($recipe->description, 0, 100) ?></p>
				</div>
			</div>
			<?php if ($buttons) {
				echo $buttons;
			} ?>
		</div>
	<?php if ($clickToFollow) { ?>
	</a> <?php
	}
}

function generateFileName($model, $path, $fileName = null){
	if (empty($fileName)) {
		$fileName = $model->filePrefix();
	}
	$fileName.= '_'.date('Y-M-d');
	$fileName = sanitizeFileName($fileName);
	$fileName = checkFileNameAvailibility($path, $fileName);
	return $fileName;
}

function checkFileNameAvailibility($path, $name)
{
	$index = 0;
	$newName = $name;
	while (File::exists("$path/$newName")) {
		$index++;
		$newName = "$name.$index";
	}
	return $newName;
}


/**
 * Stole some parts from
 * https://codex.wordpress.org/Function_Reference/sanitize_file_name
 * 
 * Sanitizes a filename, replacing whitespace with dashes.
 *
 * Removes special characters that are illegal in filenames on certain
 * operating systems and special characters requiring special escaping
 * to manipulate at the command line. Replaces spaces and consecutive
 * dashes with a single dash. Trims period from beginning and end of filename.
 *
 * @since 2.1.0
 *
 * @param string $fileName The filename to be sanitized
 * @return string The sanitized filename
 */
function sanitizeFileName( $fileName ) {
	$fileName_raw = $fileName;
	$special_chars = array('?', '[', ']', '/', "\\", '=', '<', '>', ':', ';', ',', "'", '"', '&', '$', '#', '*', '(', ')', '|', '~', '`', '!', '{', '}', '%', '+', chr(0));

	$fileName = preg_replace( "#\x{00a0}#siu", ' ', $fileName );
	$fileName = preg_replace( '/[\s]+/', '_', $fileName );
	$fileName = str_replace( $special_chars, '', $fileName );
	$fileName = trim( $fileName, '.' );

	return $fileName;
}

function cleanImageName($name)
{
	return preg_replace('/([^a-z0-9_])/', '_', strtolower($name));
}


// Design based on http://stackoverflow.com/a/15017711
// Retrieve the last complete line from the given position. 
function readPreviousLine($fp, $pos)
{
	$line = '';
	while (-1 !== fseek($fp, $pos, SEEK_END)) {
		$char = fgetc($fp);
		if ( PHP_EOL == $char || $char == "\r") {
			break;
		}
		$line = $char.$line;
		$pos--;
	}
	return $line;
}


function calculateFileSize($size) {
	if($size < 1024) {
		return $size . ' B';
	} else if($size < 1048576) {
		return number_format(round($size / 1024, 2), 2) . ' kB';
	} else if($size < 1073741824) {
		return number_format(round($size / 1048576, 2), 2) . ' MB';
	} else if($size < 1099511627776) {
		return number_format(round($size / 1073741824, 2), 2) . ' GB';
	} else {
		return number_format(round($size / 1099511627776, 2), 2) . ' TB';
	}
}

function urlGen($url,$options=[]){
	if (isset($_ENV['HTTPS']) && $_ENV['HTTPS']=="true") {
		return secure_url($url,$options);
	}
	else {
		return url($url,$options);
	}
}

function assetGen ($url){
	if (isset($_ENV['HTTPS']) && $_ENV['HTTPS']=="true") {
		return secure_asset($url);
	}
	else {
		return asset($url);
	}
}
function drawTable($id,$columns, $hiddenWheres=[], $attributes="", $rows=null){
	$html = "<table id=$id $attributes>";
	$html.= "<thead><tr>";
	foreach ($columns as $key => $value) {
		$html.="<th id=$key data-sort=string>$value</th>";
	}
	$html.= "</tr></thead>";
	$html.="<tbody id=$id-tbody >";
	if (!empty($rows)) {
		// if (is_array($rows)) {
			foreach ($rows as $row) {
				$html.="<tr>";
					foreach ($columns as $key => $value) {
						$html.="<td>".$row->$key."</td>";
					}
				$html.="</tr>";
			}
		// }
	}
	$html.="</tbody>";
	$html .= "</table>";
	return $html;
}
function svToHTML($csv, $seperator = ',', $attributes = "")
{
	$html = "<table $attributes>";
	
	$file = fopen($csv,"r");

	// Generate first row
	$row = fgetcsv($file, 0, $seperator);
	$html.= "<tr>";
		foreach ($row as $value) {
			$html.="<th>$value</th>";
		}
	$html.= "</tr>";

	// Generate the rest
	// while(! feof($file))
	for ($i=0; $i < 15; $i++) {
		$row = fgetcsv($file, 0, $seperator);
		$html.= "<tr>";
			foreach ($row as $value) {
				$html.="<td>".htmlspecialchars($value)."</td>";
				// $html.="<td>".print_r($row,true)."</td>";
			}
		$html.= "</tr>";
	}

	fclose($file);

	$html .= "</table>";
	return $html;
}

function sortCSV($file, $seperator, $index)
{
	if (File::exists("$file.sortBy_$index")) {
		return true;
	}
	else {
		// TODO 
	}
}
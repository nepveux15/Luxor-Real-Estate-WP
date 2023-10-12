<?php 
	// Set this to 0 to ignore file size restrictions.
	define('MAX_FILE_SIZE', 1024*2000); //2mb
	
	define('DEFAULT_DIRECTORY', './uploads');
	
	define('ERROR_MISSING_NAME', 	1);
	define('ERROR_INVALID_EXT', 	2);
	define('ERROR_SIZE_LIMIT', 		3);
	define('ERROR_MOVE_ERROR', 		4);

	class Uploader {

		// Singleton Design Pattern
		public static $instance;
		
		public static function getInstance() {
			if (!isset(self::$instance))
				self::$instance = new Uploader();
			
			return self::$instance;
		}

		public $upload_dir;
		public $ext_filter;
		public $filesize_filter;

		public function __construct() {
			$upload_dir = DEFAULT_DIRECTORY;
			$ext_filter = false;
		}
		
		public function setExtensionFilter($array) {
			$this->ext_filter = $array;
		}
		
		public function setFileSize($num) {
			$this->filesize_filter = $num;
		}
		
		public function setUploadDirectory($dir) {
			
			$dir_cleaned = str_replace(' ', '_', $dir);
			
			$this->upload_dir = $dir_cleaned;
			
			if (!file_exists($dir_cleaned)) { 
				mkdir($dir_cleaned, 0777); 
				//echo "The directory {$dir_cleaned} was successfully created."; 
			}
			
		}

		public function getUploadPath($base, $ext) {
			$new_file = $base . '.' . $ext;
			$count = 1;

			do {
				$path = $this->upload_dir . '/' . $new_file;
				$new_file = $base . '_' . $count++ . '.' . $ext;
			} 
			while (file_exists($path));
			
			return $path;
		}
		
		public function upload($which_file = false)
		{

			// If no specific file was provided, iterate through all uploaded
			// files and perform the upload function on each.
			if (!$which_file) {
				$results = array();
				foreach($_FILES as $name => $file) {
					$results[$name] = $this->upload($file);
				}
				return $results;
			}

			// Get the particular file upload.
			$file = $which_file;
			
			// Ensure this file has an actual name.
			if (empty($file['name']))
				return ERROR_MISSING_NAME;
			
			// Extract filename parts
			$path_info = pathinfo($file['name']);
			$base = $path_info['filename'];
			$ext = $path_info['extension'];
			$upload_path = $this->getUploadPath($base, $ext);
			
			// If an extension filter was provided, check this file's extension
			// against the filter.
			if (is_array($this->ext_filter) && !in_array($ext, $this->ext_filter))
				return ERROR_INVALID_EXT;
				
			// Check that the file size does not exceed our restriction.
			if(isset($this->filesize_filter)){
				
				if ($this->filesize_filter && $file['size'] > $this->filesize_filter)
				return ERROR_SIZE_LIMIT;
				
			} else {
			
				if (MAX_FILE_SIZE && $file['size'] > MAX_FILE_SIZE)
				return ERROR_SIZE_LIMIT;
				
			}
			

			// Move the temp uploaded file to the upload path.
			if (!move_uploaded_file($file['tmp_name'], $upload_path))
				return ERROR_MOVE_ERROR;
			
			return $upload_path;
		}
	}
	
?>


<?php

class Photo extends Db_object {

	protected static $db_table = "photos";
	protected static $db_table_fields = array('id', 'title', 'description', 'filename', 'type', 'size');

	public $id;
	public $tmp_path;
	public $title;
	public $description;
	public $filename;
	public $type;
	public $size;

	public $upload_directory = "images";

	public $errors = array(); //Errors polje za upis pogrešaka

	public $upload_errors_array = array(
		UPLOAD_ERR_OK  => "There is no errror",
		UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive",
		UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE in form",
		UPLOAD_ERR_PARTIAL => "The uploaded file was only partial uploaded",
		UPLOAD_ERR_NO_FILE => "No file was uploaded.",
		UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
		UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
		UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
	);

	//Prima argument $_FILES['uploaded_file']
	public function set_file($file) {

		if(empty($file) || !$file || !is_array($file)) {

			$this->errors[] = "There was no uploaded file here!";
			return false;

		} elseif ($file['error'] != 0) {

			$this->errors[] = $this->upload_errors_array[$file['error']];
			return false;

		} else {

			//$file = $_FILES['uploaded_file']
			//basename vraca samo ime od fajla a ne cijeli path
			$this->filename = basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
			$this->type = $file['type'];
			$this->size = $file['size'];
			$this->title = $_POST['title'];
			$this->description = $_POST['description'];
		}



	}

	public function picture_path() {

		return $this->upload_directory."/".$this->filename;
	}

	public function save() {

		if($this->id) {

			 return $this->update();

		} else {

			if(!empty($this->errors)) {

				return false;
			}

			if(empty($this->filename) || empty($this->tmp_path)) {

				$this->errors[] = "The file was not available";
				return false;
			}

			$target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->filename;

			//Provjera da li vec postoji takav file
			if(file_exists($target_path)) {

				$this->errors[] = "The file already exists!";
				return false;
			}

			if(move_uploaded_file($this->tmp_path, $target_path)) {

				if($this->create()) {

					unset($this->tmp_path);
					return true;
				}

			} else {

				$this->errors[] = "The file directory probably does not have write permissions";
				return false;
			} //else end

		} //if end
	} //End of save function


	public function delete_photo() {

	if(unlink($this->upload_directory.DS.$this->filename)) {
	
		$this->delete();
		return redirect('../photos.php');

		} else {

			return redirect('../photos.php');
		}
	}

} // End photo class


?>
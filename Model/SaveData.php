<?php
/*
* Utility class.
* Used to persist data in file.
*
*/
class SaveData {
   /*
	* Save given data.
	*
	* @return void
	* @access public
	*/
	public function save($object){
		$objData = serialize($object);
		$fp = fopen(SAVE_PATH, "w");
		 
		if(is_writable(SAVE_PATH)) {
			fwrite($fp, $objData);
			fclose($fp);
		}else{
			throw new Exception('Cannot save data. File is not writeable.');
		}
	}
	
   /*
	* Read and pass saved data.
	*
	* @return void
	* @access public
	*/
	public function get(){
		if(file_exists(SAVE_PATH)){
			$objData = file_get_contents(SAVE_PATH);
			$obj = unserialize($objData);
			if(!empty($obj)){
				return $obj;
			}
		}else{
			throw new Exception('Cannot get data. File doesnt exist');
		}
	}
}

?>
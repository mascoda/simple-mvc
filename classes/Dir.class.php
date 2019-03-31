<?
namespace HM;
	
	class Dir {
	/** 
	* Set a persons weight in Kilogram
	*
	* @description
	*/
		public $path;
		/** 
		* Build object
		*
		* @param path (string)
		* 
		*/
		function __construct($path)
		{
				
			$this->path = $path;
			$this->realpath = realpath($path);
			
		}
		/** 
		* Build object
		*
		* @param -
		* @desc check if dir exists
		*/		
		public function exists()
		{
			return $return = is_dir($this->path) ? true : false;			
		}
		/** 
		* Build object
		*
		* @param -
		* @desc check if dir exists
		*/		
		public function create($mode = 0777, $recursive = false)
		{
			
			if (mkdir($this->path, $mode, $recursive) === true) :
				$oldmask = umask(0);
				chmod($this->path, $mode);
				umask($oldmask);
				return true;
			endif;
		}
		
}
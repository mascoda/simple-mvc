<?
namespace HM;
	
	class File {
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
			return $return = is_file($this->path) ? true : false;			
		}
		/** 
		* Build object
		*
		* @param -
		* @desc check if dir exists
		*/		
		public function create($mode = 'a', $chmod = 0777)
		{ 
			if (file_put_contents($this->path,'') === true):
				$oldmask = umask(0);
				chmod($this->path, $mode);
				umask($oldmask);
				return true;
			endif;
		}
		/** 
		* Build object
		*
		* @param -
		* @desc check if dir exists
		*/		
		public function write($content)
		{ 
			if (file_put_contents($this->path, $content)):
				return true;
			endif;
			return false;
		}
		
}
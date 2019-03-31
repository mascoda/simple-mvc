<?
namespace HM;
	
	class MVC {
	/** 
	* Generate page with controller and view
	*
	* 
	*
	*/
		public $page;
		public $controller;
		public $template;
		public $view;
		
		public $title;
		/* 
		* Constructor
		*
		* @description
		* build the complete page with controller and view 
		*
		* @param 
		* page (string)
		* template (string) [optional]
		*
		*	@return
		*	-
		*
		*/
		function __construct($page, $template = 'default')
		{
				
				$this->page($page);
			 $this->controller();	
			
				$this->template($template);
				$this->view();
		}
		/* 
		* Page
		*
		* @description
		* create page, if it does not exist, move on to 404 
		*
		* @param 
		* page (string)
		*
		*	@return
		*	-
		*
		*/
		private function page($page)
		{
				# define page from the uri
				$page = rtrim($page, '/');
				$this->page = ($page === '') ? 'index' : $page;
			}
		/** 
		* Controller
		*
		* @description
		* define controller 
		* controller/{page}.controller.php
		*
		* @param 
		* -
		*
		* @return
		* -
		*
		*/
		private function controller()
		{
				# define the first directory from path as controller
				$controller = array_shift(array_filter(explode('/', $this->page)));
				$this->controller = realpath(dirname(__DIR__) . '/controller/' . $controller .'.controller.php');	
		}
		/** 
		* View
		*
		* @params
		* -
		*
		* @description
		* define view similar to the url structure
		* '/page' 					will use this view 'render/views/page.view.php'
		* '/page/item' will use the view	 'render/views/page/item.view.php'
		*
		* @param 
		* -
		*
		* @return
		* -
		*
		*/
		private function view()
		{
				# create the template
				$this->view = realpath(dirname(__DIR__) . '/render/views/' . $this->page . '.view.php');
		}
		/** 
		* View
		*
		* @description
		* Defines the basic template, can be changed in the controller
		*	default template will use this 'render/template/default.template.php 
		*
		* @param 
		* -
		*
		* @return
		* -
		*
		*/
		public function template($template)
		{
				# create the template
				$this->template = dirname(__DIR__) . '/render/template/' . $template .'.template.php';	
		}
		
		/** 
		* Create a page
		*
		* @description
		* Create a full page included controller and view by a path
		* $page->create('/catalog/product/') will be create files in 
		* /controller/catalog.controller.php
		* /render/views/catalog/catalog.view.php
		* /render/views/catalog/product/product.view.php
		*
		* @param 
		* page (string)
		* @desc -
		*
		* @return
		* -
		*
		*/	
		private function create($page)
		{
					
					$path_to = "";
					
					$pages = explode('/', $page);			
					#if (count($pages)>0) :
						$pages = array_filter($pages);
					#endif;
			
					$this->controller = realpath(__DIR__ . '/../controller/' . current($pages) .'.controller.php');
			
					// current path
					$this->page = substr($page,1);

					// create directory if not exists
				 $path = new Dir(dirname(dirname(__DIR__) . '/render/views/' . $this->page));
					if ($path->exists() === false) :
						$path->create($mode = 0777, $recursive = true);
					endif;	
			
					// create views, if not exists
					foreach ($pages as $page):			
						
						$file = new File(dirname(__DIR__) . '/render/views/' . $path_to . $page . '.view.php');
						
						if ($file->exists() === false) :
							$file->create($mode = 0777, $recursive = true);
						 $file->write(str_replace('{TITLE}' , basename($file->path), file_get_contents(dirname(__DIR__) . '/render/template/default.view.php')));
						endif;	
			
					$path_to .= $page . '/';
					endforeach;			
					
		}	
}
<?


$dir = new HM\Dir(__DIR__ . '/../media/files', 0777, TRUE);

if ($dir->exists() === false) :
 $dir->create();
endif;

$A = "A";

#echo "controller";

#echo $dir->path;

HM\MVC::render();


/*
$file = new HM\File($dir->path . '/test2.json');

if ($file->exists() === false) :
 $file->create();
endif;

$info = new SplFileObject($file->path);

HM\Log::debug('hi');
*/
?>
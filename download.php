<?php
$the_folder = 'uploads';
$zip_file_name = 'course_material.zip';

class FlxZipArchive extends ZipArchive {
        /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  **/
    public function addDir($location, $name) {
      echo $location;
      echo $name;
        $this->addEmptyDir($name);
         $this->addDirDo($location, $name);
     } // EO addDir;

        /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann * @access private   **/
    private function addDirDo($location, $name) {
        $name .= '/';         $location .= '/';
      // Read all Files in Dir
        $dir = opendir ($location);
        while ($file = readdir($dir))    {
            if ($file == '.' || $file == '..') continue;
          // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
            $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
    } 
}

$za = new FlxZipArchive;
$res = $za->open($zip_file_name, ZipArchive::CREATE);
if($res === TRUE)    {
    $za->addDir($the_folder, basename($the_folder)); $za->close();
}
else  { echo 'Could not create a zip archive';}


$filename = "course_material.zip";

 if (file_exists($filename)) {
 header('Content-type: application/zip');
  header('Content-Disposition: attachment; filename="course_material.zip"');
  header("Content-length: " . filesize($filename));
  header("Pragma: no-cache");
  header("Expires: 0");
 ob_clean();
  flush();
  readfile($filename);
  unlink($filename);


}
?>
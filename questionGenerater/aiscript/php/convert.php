<?php




# get file contents (without saving the file locally)


function ppt( $file,$filetype){
        
        $name = "storage/example1." . $filetype;
        $file = file_get_contents($file);
        $fileopen = fopen($name, "w");
        fwrite($fileopen, $file);
    fclose($fileopen);

    $con = api($name, $filetype, 'pdf');
    unlink($name);
   $con->saveFiles('storage/example1.pdf');
    $filetype = "pdf";
    $name = "storage/example1." . $filetype;

$contents = api($name,$filetype,'txt')->getFile()->getContents();
unlink($name);



   

    return  $contents;

}
?>
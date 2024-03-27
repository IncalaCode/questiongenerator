<?php
require_once('vendor/autoload.php');
use \ConvertApi\ConvertApi;
   $resualt = "";
   if (!empty($_FILES["file"]["name"])) {
       // File upload path 
       $fileName = basename($_FILES["file"]["name"]);
       $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
       $file = $_FILES["file"]["tmp_name"];
       switch ($fileType) {
        case 'pdf':
            $result = convertapi($file, $fileType);
            break;
        case 'ppt':
            $result = ppt($file, $fileType);
            break;
        default:
            $result = false;
    }
}

    $url = $result->getFile()->getUrl();
    echo "$url";



   function convertapi( $file,$filetype){
    $name = "storage/example." . $filetype;
    $file = file_get_contents($file);
    $fileopen = fopen($name, "w");
    fwrite($fileopen, $file);
fclose($fileopen);


# get file contents (without saving the file locally)
$contents = api($name,$filetype,'docx');

     unlink($name);

    return  $contents;

}
function api($file,$filetype,$wcon){
   
    ConvertApi::setApiSecret('P5fDv1sAi8fKRNfJ');
    
    $result = ConvertApi::convert(
        $wcon,
        ['File' => $file],
        $filetype
    );
    return $result;
        
    }

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

$contents = api($name,$filetype,'docx');
unlink($name);



   

    return  $contents;

}
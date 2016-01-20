<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/15
 * Time: 17:05
 */
class UpLoad{
    function __construct($File)
    {
        $this->File = $File;
    }
    function uploadTxt(){
        if($this->judgeTxtType()){
            if($_FILES[$this->File]["error"] > 0){
                echo "UploadError";
            }else{
                if($_FILES[$this->File]["size"] > 4 * 1024 * 1024){
                    echo "FileSizeError";
                }else{
                    $this->submitFile();
                }
            }
        }else{
            echo "FileTypeError";
        }
    }

    function submitFile(){
        session_start();
        $enter_tsn1 = $_SESSION["enter_tsn"];
        $modify_date = $_SESSION['modify_date'];
        $path1 = "../../../upload_file/document_data/".$enter_tsn1."/".$modify_date;
        $filename = $_FILES[$this->File]["name"];
        $filename1 = iconv('utf-8','gbk',$_FILES[$this->File]["name"]);
        if(file_exists($path1)){
            $this->deldir($path1,0777);
        }
        mkdir($path1,0777,true);
        $filepath = $path1."/".$filename;
        $filepath1 = $path1."/".$filename1;
        if(move_uploaded_file($_FILES[$this->File]["tmp_name"],$filepath1)){
            include "../../../utils/conn.php";
            $sql = $conn->query("update `t_energy_data_entry` set `certificate_path` = '".$filepath."' where `enter_tsn`='".$enter_tsn1."' and `modify_date`='{$modify_date}'");
            if($sql){
                echo "UploadSuccess";
                unset($_SESSION['modify_date']);
            }else{
                echo "PathInsertError";
            }
        }else{
            echo "UpLoadError";
        }
    }

    function deldir($dir){
        //先删除目录下的文件：
        $dh = opendir($dir); //如果传入的参数是目录，则使用opendir将该目录打开，将返回的句柄赋值给$dh
        while ($file = readdir($dh))
        { //这里明确地测试返回值是否全等于（值和类型都相同）FALSE，否则任何目录项的名称求值为 FALSE 的都会导致循环停止（例如一个目录名为“0”）。
            if ($file != "." && $file != "..")
            { //在文件结构中，都会包含形如“.”和“..”的向上结构，但是它们不是文件或者文件夹
                $fullpath = $dir . "/" . $file; //当前文件$dir为文件目录+文件
                if (!is_dir($fullpath))
                { //如果传入的参数不是目录，则为文件，应将其删除
                    unlink($fullpath); //删除文件
                } else
                {
                    deldir($fullpath); //递归删除文件
                }
            }
        }
        closedir($dh);
        //删除当前文件夹：
        if (rmdir($dir)){
            return true;
        }else{
            return false;
        }
    }

    function judgeTxtType(){
        if(($_FILES["file0"]["type"] == "image/gif")
            || ($_FILES["file0"]["type"] == "image/jpeg")
            || ($_FILES["file0"]["type"] == "image/png")
            || ($_FILES["file0"]["type"] == "image/pjpeg")
            || ($_FILES["file0"]["type"] == "application/pdf")
            || ($_FILES["file0"]["type"] == "application/msword")
            || ($_FILES["file0"]["type"] == "application/x-rar-compressed")
            || ($_FILES["file0"]["type"] == "application/zip")
            || ($_FILES["file0"]["type"] == "application/x-zip-compressed")
            || ($_FILES["file0"]["type"] == "application/octet-stream")
            || ($_FILES["file0"]["type"] == "text/plain")
            || ($_FILES["file0"]["type"] == "application/vnd.ms-excel")
            || ($_FILES["file0"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            || ($_FILES["file0"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")){
            return true;
        }else{
            return false;
        }
    }
}

$obj = new UpLoad($_GET["file0"]);
$obj->uploadTxt();

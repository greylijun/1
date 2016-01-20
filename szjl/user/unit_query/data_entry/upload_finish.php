<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/16
 * Time: 13:22
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
        $time = time();
        $date_time = date("Y-m-d his",$time);
        $enter_tsn1 = $_SESSION["enter_tsn"];
        $project_name = $_SESSION['project_name'];
        $path1 = "../../../upload_file/finish/".$enter_tsn1."/".$date_time;
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
            $sql = $conn->query("update `t_energy_saving_measures_finish` set `technical_renovation_content` = '".$filepath."' where `enter_tsn`='".$enter_tsn1."' and `project_name`='{$project_name}'");
            if($sql){
                echo "UploadSuccess";
                unset($_SESSION['project_name']);
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
        if(($_FILES["file2"]["type"] == "image/gif")
            || ($_FILES["file2"]["type"] == "image/jpeg")
            || ($_FILES["file2"]["type"] == "image/png")
            || ($_FILES["file2"]["type"] == "image/pjpeg")
            || ($_FILES["file2"]["type"] == "application/pdf")
            || ($_FILES["file2"]["type"] == "application/msword")
            || ($_FILES["file2"]["type"] == "application/x-rar-compressed")
            || ($_FILES["file2"]["type"] == "application/zip")
            || ($_FILES["file2"]["type"] == "application/x-zip-compressed")
            || ($_FILES["file2"]["type"] == "application/octet-stream")
            || ($_FILES["file2"]["type"] == "text/plain")
            || ($_FILES["file2"]["type"] == "application/vnd.ms-excel")
            || ($_FILES["file2"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            || ($_FILES["file2"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")){
            return true;
        }else{
            return false;
        }
    }
}

$obj = new UpLoad($_GET["file2"]);
$obj->uploadTxt();
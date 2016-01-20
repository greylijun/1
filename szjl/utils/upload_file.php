<?php

class UpLoad{
	
	function __construct($File)
    {
        $this->File = $File;
    }
	
	function uploadFile(){
		//echo $_FILES["file"]["type"];
		if($this->judgeFileType()){
			if ($_FILES[$this->File]["error"] > 0){
				echo "UploadError";
			}else{
				if($_FILES[$this->File]["size"] > 3 * 1024 * 1024){
					echo "FileSizeError";
				}else{
					$this->moveFile();
				}
			}
		}else{
			echo "FileTypeError";
		}
	}
	
	function moveFile(){
		session_start();
		$enter_tsn = $_SESSION["login_tsn"];
		$path = "../UnitPicture/unit_image/".$enter_tsn;
		$filename = iconv("utf-8", "GBK", $_FILES[$this->File]["name"]);
        $filename1 = $_FILES[$this->File]["name"];
        if(file_exists($path)){
			$this->deldir($path, 0777);
		}
		mkdir($path, 0777);
		$filepath = $path."/".$filename;
        $filepath1 = $path."/".$filename1;
		if (move_uploaded_file($_FILES[$this->File]["tmp_name"], $filepath)){
			include "../utils/conn.php";
			$sql = $conn->query("update `t_enterprise_info` set `unit_image_path` = '".$filepath1."' where `tsn` = '".$enter_tsn."'");
			if($sql){
				echo "UpLoadSuccess";
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
	
	function judgeFileType(){
        if (($_FILES["file"]["type"] == "image/gif") 
        || ($_FILES["file"]["type"] == "image/jpeg") 
        || ($_FILES["file"]["type"] == "image/png") 
        || ($_FILES["file"]["type"] == "image/pjpeg"))
        {
            return true;
        } else
        {
            return false;
        }
    }
}

$obj = new UpLoad($_GET["file"]);
$obj->uploadFile();
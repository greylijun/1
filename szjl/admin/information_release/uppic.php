<?php 
//公共函数库

/**
  * 文件上传处理函数
  * @param string filename 要上传的文件表单项名
  * @param string $path	上传文件的保存路径
  * @param array  允许的文件类型
  * @return array 二个单元：["error"] false:失败，true:成功
  *  						["info"] 存放失败原因或成功的文件名
  */

function uploadFile($filename,$path,$typelist=null){
	//1. 获取上传文件的名字
	$upfile = $_FILES[$filename];
	//echo $upfile;
	if ($upfile["name"]==""){
		
		}else{
			//var_dump($upfile); 
    if(empty($typelist)){
		$typelist=array("image/gif","image/jpg","image/jpeg","image/png");//允许的文件类型
	}
	//$path="upload3"; //指定上传文件的保存路径（相对的）
	$res=array("error"=>false);//存放返回的结果
	//2.过滤上传文件件的错误号
	if($upfile["error"]>0){
		switch($upfile["error"]){
			case 1: 
				$res["info"]="上传的文件超过了 php.ini 中 upload_max_filesize 选项限制";
				break;
			case 2:
				$res["info"]="上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项";
				break;
			case 3:
				$res["info"]="文件只有部分被上传";
				break;
			case 4:
				$res["info"]="没有文件被上传";
				break;
			case 6:
				$res["info"]="找不到临时文件夹。";
				break;
			case 7:
				$res["info"]="文件写入失败";
				break;
			default:
				$res["info"]="未知错误！";
				break;
		}
		return $res;
	}
echo $upfile["size"];
	//3.本次文件大小的限制
	if($upfile["size"]>100000){
		$res["info"]="上传文件过大！";
		return $res;
	}

	//4. 过滤类型
	if(!in_array($upfile["type"],$typelist)){
		$res["info"]="上传类型不符！".$upfile["type"];
		return $res;
	}

	//5. 初始化下信息(为图片产生一个随机的名字)
	$fileinfo = pathinfo($upfile["name"]);
	do{
		$newfile = date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];//随机产生一个的文件名
	}while(file_exists($newfile));
	//6. 执行上传处理
	if(is_uploaded_file($upfile["tmp_name"])){
		if(move_uploaded_file($upfile["tmp_name"],$path."/".$newfile)){
			//将上传成功后的文件名赋给返回数组
			$res["info"]=$newfile;
			$res["error"]=true;
			return $res;
		}else{
			$res["info"]="上传文件失败！";
		}
	}else{
		$res["info"]="不是一个上传的文件！";
	}
	return $res;
}
}
//========================================================================================

/**
 * 等比缩放函数（以保存的方式实现）
 * @param string $picname 被缩放的处理图片源
 * @param int $maxx 缩放后图片的最大宽度
 * @param int $maxy 缩放后图片的最大高度
 * @param string $pre 缩放后图片名的前缀名
 * @return String 返回后的图片名称(带路径)，如a.jpg=>s_a.jpg
 */
function imageUpdateSize($picname,$maxx=100,$maxy=100,$pre="s_"){
	$info = getimageSize($picname); //获取图片的基本信息
	
	$w = $info[0];//获取宽度
	$h = $info[1];//获取高度
	
	//获取图片的类型并为此创建对应图片资源	
	switch($info[2]){
		case 1: //gif
			$im = imagecreatefromgif($picname);
			break;
		case 2: //jpg
			$im = imagecreatefromjpeg($picname);
			break;
		case 3: //png
			$im = imagecreatefrompng($picname);
			break;
		default:
			die("图片类型错误！");
	}
	
	//计算缩放比例
	if(($maxx/$w)>($maxy/$h)){
		$b = $maxy/$h;
	}else{
		$b = $maxx/$w;
	}
	
	//计算出缩放后的尺寸
	$nw = floor($w*$b);
	$nh = floor($h*$b);
	
	//创建一个新的图像源(目标图像)
	$nim = imagecreatetruecolor($nw,$nh);
		
	//执行等比缩放
	imagecopyresampled($nim,$im,0,0,0,0,$nw,$nh,$w,$h);
	
	//输出图像（根据源图像的类型，输出为对应的类型）
	$picinfo = pathinfo($picname);//解析源图像的名字和路径信息
	$newpicname= $picinfo["dirname"]."/".$pre.$picinfo["basename"];
	switch($info[2]){
		case 1:
			imagegif($nim,$newpicname);
			break;
		case 2:
			imagejpeg($nim,$newpicname);
			break;
		case 3:
			imagepng($nim,$newpicname);
			break;
	}
	//释放图片资源
	imagedestroy($im);
	imagedestroy($nim);
	//返回结果
	return $newpicname;
}

//========================================================================================

/**
 * 为一张图片添加上一个logo图片水印（以保存的方式实现）
 * @param string $picname 被处理图片源
 * @param string $logo 水印图片
 * @param string $pre 处理后图片名的前缀名
 * @return String 返回后的图片名称(带路径)，如a.jpg=>n_a.jpg
 */
function imageUpdateLogo($picname,$logo,$pre="n_"){
	$picnameinfo = getimageSize($picname); //获取图片源的基本信息
	$logoinfo = getimageSize($logo); //获取logo图片的基本信息
	//var_dump($logoinfo);
	//根据图片类型创建出对应的图片源
	switch($picnameinfo[2]){
		case 1: //gif
			$im = imagecreatefromgif($picname);
			break;
		case 2: //jpg
			$im = imagecreatefromjpeg($picname);
			break;
		case 3: //png
			$im = imagecreatefrompng($picname);
			break;
		default:
			die("图片类型错误！");
	}
	//根据logo图片类型创建出对应的图片源
	switch($logoinfo[2]){
		case 1: //gif
			$logoim = imagecreatefromgif($logo);
			break;
		case 2: //jpg
			$logoim = imagecreatefromjpeg($logo);
			break;
		case 3: //png
			$logoim = imagecreatefrompng($logo);
			break;
		default:
			die("logo图片类型错误！");
	}
	

	//执行图片水印处理
	imagecopyresampled($im,$logoim,$picnameinfo[0]-$logoinfo[0],$picnameinfo[1]-$logoinfo[1],0,0,$logoinfo[0],$logoinfo[1],$logoinfo[0],$logoinfo[1]);
	
	//输出图像（根据源图像的类型，输出为对应的类型）
	$picinfo = pathinfo($picname);//解析源图像的名字和路径信息
	$newpicname= $picinfo["dirname"]."/".$pre.$picinfo["basename"];
	switch($picnameinfo[2]){
		case 1:
			imagegif($im,$newpicname);
			break;
		case 2:
			imagejpeg($im,$newpicname);
			break;
		case 3:
			imagepng($im,$newpicname);
			break;
	}
	//释放图片资源
	imagedestroy($im);
	imagedestroy($logoim);
	//返回结果
	return $newpicname;
}
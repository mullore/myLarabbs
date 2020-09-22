<?php


namespace App\Handlers;

use App\Exceptions\Handler;
use Illuminate\Support\Str;

class ImageUploadHandler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file,$folder,$file_prefix){
        /*构建存储的文件夹规则*/
        $folder_name  = "/uploads/images/$folder/".date('Ym/d', time());
        /*文件具体的物理路径*/
        $upload_name = public_path(). '/'. $folder_name;
        /*获取文件的后缀名*/
        $extension =  strtolower($file->getClientOriginalExtension()) ?: 'png';
        /*拼接文件名*/
        $filename = $file_prefix . '_'. time().'_'. Str::random(10).'.'. $extension;
        /*判断后缀不是图片终止操作*/
        if(!in_array($extension,$this->allowed_ext)){return false;}
        /*将图片移动到我们的目标存储路径中*/
        $file->move($upload_name,$filename);

        return [
            'path'=> config("app.url")."/$folder_name/$filename"
        ];

    }
}

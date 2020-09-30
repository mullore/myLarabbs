<?php


namespace App\Handlers;

use App\Exceptions\Handler;
use Illuminate\Support\Str;
use Image;

class ImageUploadHandler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file,$folder,$file_prefix,$max_width = false){
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

        /*图片宽度超过指定大小并且不是gif图执行*/
        if($max_width && $extension != 'gif'){
            $this->reduceSize($upload_name.'/'.$filename,$max_width);
        }

        return [
            'path'=> config("app.url")."/$folder_name/$filename"
        ];

    }

    /*
     * 对上传图片进行裁切
     * @params $file_path 绝对路径
     * @params $max_width 最大宽度
     * */
    public function reduceSize($file_path,$max_width){
        /*实例化*/
        $image = Image::make($file_path);


        $image->resize($max_width,null,function ($constraint){

            /*设定宽度是 max_width,高度等比例缩放*/
            $constraint->aspectRatio();
            /*防止裁图时图片变大*/
            $constraint->upsize();
        });
        $image->save();


    }
}

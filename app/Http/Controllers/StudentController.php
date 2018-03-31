<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mail;

class StudentController extends Controller
{
    //\\\\
    public function  upload(Request $request){

        if($request->isMethod('post'))
        {
       //var_dump($_FILES);
         $file=$request->file('source');
            //判断文件是否上传成功
            if($file->isValid()){
                //源文件名
               $originalName= $file->getClientOriginalName();
               //扩展名
                $ext= $file->getClientOriginalExtension();
                //MImetype
                $type =$file->getClientMimeType();
                //临时绝对路径
                $realPath = $file->getRealPath();


                $filename= date('Y-m-d-H-i-s'). '-' . uniqid() . '.'. $ext;
                $bool=Storage::disk('uploads')->put($filename,file_get_contents($realPath));
                //var_dump($bool);

            }

        }

        return view('student.upload')->with('success','添加成功');

    }
    public  function  ma11231il(){
        Mail::raw('我不是针对谁，没错，我是用SMTP服务器发的。哼哼哼',function($message) {
           $message->from('408508177@qq.com','Andy');
            $message->subject('wangyue');
            $message->to('1793363644@qq.com');
        });
//        Mail::send('student.mail',['name'=>'andy'],function($message){
//           $message->to('408508177@qq.com');
//        });

    }
}

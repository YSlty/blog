<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use Lcobucci\JWT\Parser;
use App\Http\Controllers\ResponseJson;
class CommonController extends Controller
{
    use ResponseJson;

//首页自定义导航栏
    public static function getHead()
    {
        $data = DB::table('article')->orderBy('id','desc')->get()->toArray();
		dump($data).die;
        return $data;
    }
	// 文章展示
	public function article(Request $request){
		$data = DB::table('article')->orderBy('id','desc')->get()->toArray();
		return $this->jsonSuccess($data);
	}
	// 上传文章
	public function artUpdata(Request $request){
		$data['title']=$request->input('title');
		$data['type']=$request->input('type');
		$data['typeId']=$request->input('typeId');
		$data['jianjie']=$request->input('jianjie');
		$data['content']=$request->input('content');
		$data['user']='YS';
		$data['time']=date("Y-m-d H:i:s");
		if(!empty($data['title'])){
			if(!empty($data['jianjie'])){
				// dump(empty($data['title'])).die;
				$article = DB::table('article')->insert($data);
				return $this->jsonSuccess($data);
			}else{
				return $this->jsonError(-2,"请填写简介");
			}
		}else{
			return $this->jsonError(-1,"请填写标题");
		}
		
	}
	// 获取留言
	public function leaveMsg(Request $request){
		$data['cont']=$request->input('cont');
		// $data['type']=$request->input('type');
		// $data['typeId']=$request->input('typeId');
		$data['artId']=$request->input('artId');
		$data['time']=date("Y-m-d H:i:s");
		if(!empty($data['cont'])){
			$leavemsg = DB::table('leavemsg')->insert($data);
			return $this->jsonSuccess("提交成功,等待后台审核");
		}else{
			return $this->jsonError(-1,"请填写您的留言内容");
		}
		
	}
	// 筛选留言展示接口
	public function screenLeaveMsg(Request $request){
		$data = DB::table('leavemsg')->where('is_show',0)->orderBy('id','desc')->get()->toArray();
		return $this->jsonSuccess($data);
	}
	// 筛选后留言展示接口
	public function showLeaveMsg(Request $request){
		$data = DB::table('leavemsg')->where('is_show',1)->orderBy('id','desc')->get()->toArray();
		return $this->jsonSuccess($data);
	}
	// 通过留言
	public function passLeaveMsg(Request $request){
		$id=$request->input('id');
		$data = DB::table('leavemsg')->where('id',$id)->update(['is_show' => "1"]);
		return $this->jsonSuccess("已通过筛选");
	}
	// 删除留言
	public function delLeaveMsg(Request $request){
		$id=$request->input('id');
		$data = DB::table('leavemsg')->where('id',$id)->delete();
		return $this->jsonSuccess("删除成功");
	}
	
	// 注册
	public function reg(Request $request){
		
	}
	// 生日
	public function BirthdayCake(){
		return view('home.index');
	}
	//客户案例页面
	public function city()
	{
		
	}
}

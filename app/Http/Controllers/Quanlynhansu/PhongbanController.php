<?php
namespace App\Http\Controllers\Quanlynhansu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quanlynhansu\PhongbanRequest;
use Illuminate\Http\Request;
use App\Models\Quanlynhansu\Phongban;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
class PhongbanController extends Controller
{
    public function phongban()
        {
            $phongban=DB::table('phongban')->paginate(10);        
            return view('quanlynhansu.danhmuc.phongban.phongban',compact('phongban'));
            
        }
    public function them_pb()
         {
             return view('quanlynhansu.danhmuc.phongban.them_phongban');
         }
         public function luu_pb(PhongbanRequest $request)
          {
            DB::table('phongban')->insert(
                [
                    'ma_pb'=>$request->txt_ma_pb,
                    'ten_pb'=>$request->txt_ten_pb,
                ]
                );
                Toastr::success('Thêm mới thông tin thành công!!!','Thông Báo');
                return redirect()->route('phongban');
          }
          public function sua_pb($id)
            {
              $data=  DB::table('phongban')->where('id',$id)->first();
                return view('quanlynhansu.danhmuc.phongban.sua_phongban',compact('data'));
            }
            public function capnhat_pb($id,Request $request)
             {
                DB::table('phongban')->where('id',$id)->update(
                    [
                        'ma_pb'=>$request->txt_ma_pb,
                        'ten_pb'=>$request->txt_ten_pb,

                    ]);
                    Toastr::success('Cập nhật thông tin thành công!!!','Thông Báo');
                    return redirect()->route('phongban');
             }
             public function xoa_pb($id)
               {
                     DB::table('phongban')->where('id',$id)->delete();
                     Toastr::success('Xóa thông tin thành công!!!','Thông Báo');
                     return redirect()->route('phongban');
                      
               }
               

}


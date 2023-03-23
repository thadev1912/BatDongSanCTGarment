<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRestful\Auth_APIController;
use App\Http\Controllers\ApiRestful\PostAPIController;
use App\Http\Controllers\ApiRestful\NhanvienAPIController;
use App\Http\Controllers\ApiRestful\BangchamcongAPIController;
use App\Http\Controllers\Quanlybanhang\ProductController;
use App\Http\Controllers\Quanlybanhang\ChamsockhachhangController;
use App\Http\Controllers\Quanlykhovattu\PhieunhapkhoController;
use App\Http\Controllers\Quanlykhovattu\PhieuxuatkhoController;
use App\Http\Controllers\Quanlykhovattu\XuatnhaptonController;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

                    //-------------API RESTFUL-----------------//
//Hệ Thống APIRestful
Route::post('check_api',[Auth_APIController::class,'check_api'])->name('check_api'); //Nhận Token thông qua đăng nhập
Route::delete('thoat_api',[Auth_APIController::class,'thoat_api'])->name('thoat_api'); //Thoát và xóa token

// Xác thực Authraztion cho Dữ liệu API
Route::middleware('auth_api:api')->group(function () {   
Route::get('check_token',[Auth_APIController::class,'check_token'])->name('check_token');// nhiệm vụ kiểm tra token có tồn tại hay không?
//API CARAR RIVER PARK
Route::group(['prefix'=>'post'],function()
    {
Route::resource('post',PostAPIController::class)->names('post');   // Bao gồm Crud: Get,Post,Put,Delete
    });
// API nhan vien 
Route::group(['prefix'=>'nhanvien'],function()
    {
        Route::post('create',[NhanvienAPIController::class,'create'])->name('nhanvien.create');
        Route::get('edit/{id}',[NhanvienAPIController::class,'edit'])->name('nhanvien.edit'); 
        Route::post('update/{id}',[NhanvienAPIController::class,'update'])->name('nhanvien.update');
        Route::delete('delete/{id}',[NhanvienAPIController::class,'delete'])->name('nhanvien.delete'); 
    });


});

// Không xác thực cho Dữ Liệu API
//API Nhân Viên
Route::group(['prefix'=>'nhanvien'],function()
{
         Route::get('get',[NhanvienAPIController::class,'get'])->name('nhanvien.get');    
});  
//API Bảng Chấm Công
Route::group(['prefix'=>'bangchamcong'],function()
{
         Route::get('bangchamcong',[BangchamcongAPIController::class,'bangchamcong'])->name('bangchamcong.get');    
});   




                    //-------------AJAX JQUERY-----------------//
//Jax tìm kiếm sản phẩm bán hàng
Route::group(['prefix'=>'cart'],function()
{
Route::get('timkiem_sanpham',[ProductController::class,'timkiem_sanpham'])
->name('timkiem_sanpham');
});
Route::group(['prefix'=>'lienhe'],function()
{
Route::post('/luuthongtin_khachhang',[ChamsockhachhangController::class,'luuthongtin_khachhang'])
->name('luuthongtin_khachhang');
});
//ajax_nhap kho
Route::group(['prefix'=>'nhapkho'],function()
{
Route::get('ajax_dsvattu/{id_vattu}',[PhieunhapkhoController::class,'ajax_dsvattu'])
->name('ajax_dsvattu');
Route::post('luu_vattu',[PhieunhapkhoController::class,'luu_vattu'])
->name('luu_vattu');
Route::get('sua_vattu/{id}',[PhieunhapkhoController::class,'sua_vattu'])
->name('sua_vattu');
Route::post('capnhat_vattu/{id}',[PhieunhapkhoController::class,'capnhat_vattu'])
->name('capnhat_vattu');
Route::get('xoa_vattu/{id}',[PhieunhapkhoController::class,'xoa_vattu'])
->name('xoa_vattu');
});
//ajax_xuat kho
Route::group(['prefix'=>'xuatkho'],function()
{
Route::get('ajax_dsvtxuat/{id_vattu}',[PhieuxuatkhoController::class,'ajax_dsvtxuat'])
->name('ajax_dsvtxuat');
Route::post('luu_vtxuat',[PhieuxuatkhoController::class,'luu_vtxuat'])
->name('luu_vtxuat');
Route::get('sua_vtxuat/{id}',[PhieuxuatkhoController::class,'sua_vtxuat'])
->name('sua_vtxuat');
Route::post('capnhat_vtxuat/{id}',[PhieuxuatkhoController::class,'capnhat_vtxuat'])
->name('capnhat_vtxuat');
Route::get('xoa_vtxuat/{id}',[PhieuxuatkhoController::class,'xoa_vtxuat'])
->name('xoa_vtxuat');
Route::post('select_vattu',[XuatnhaptonController::class,'select_vattu'])
->name('select_vattu');
});


























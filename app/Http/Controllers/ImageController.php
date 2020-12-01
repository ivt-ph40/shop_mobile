<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use DB;
use Session;
session_start();

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pro_id = $id;
        return view('images.add', compact('pro_id'));
    }
    public function select_image(Request $request)
    {
        $product_id = $request->pro_id;
        $images = Image::where('product_id', $product_id)->get();
        $count_img = $images->count();
        $output = '
        <form>
        '.csrf_field().'
        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên hình ảnh</th>
                                    <th>Hình ảnh</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                        <tbody>';
        if ($count_img> 0) {
            $i = 0;
            foreach ($images as $key => $img) {
                $i++;
                $output .= '
                                <tr>
                                    <td>'.$i.'</td>
                                    <td contenteditable class="edit_image_name" data-img_id="'.$img->id.'">'.$img->name.'</td>
                                    <td>
                                    <img src="'.url('upload/images/'.$img->path).'" class="img-thumbnail" width="100px" height="110px" alt="">
                                    <input type="file" id="file-'.$img->id.'" accept="image/*" class="file_image" data-img_id="'.$img->id.'" style="width:50%" name="file">
                                    </td>
                                    <td>
                                    <button class="btn btn-xs btn-danger delete_image" data-id="'.$img->id.'" type="button">Xóa</button>
                                    </td>
                                </tr>
                            ';
            }
        } else{
            $output .= '<tbody>
                            <tr>
                                <td colspan="4">Chưa có thư viện ảnh</td>
                                
                            </tr>';
        }
        $output .= '</tbody>
                 </table>
                </form>';
        echo $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        $get_image = $request->file('file');
        if ($get_image) {
            foreach ($get_image as $key => $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image-> move('upload/images', $new_image);
                $data['name'] = $new_image;
                $data['path'] = $new_image;
                $data['product_id'] = $product_id;
                Image::create($data);
            }
        }
        return Redirect()->back()->with('message', 'Thêm thư viện ảnh thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data['name'] = $request->img_text;
        $img_id = $request->img_id;
        Image::find($img_id)->update($data);

    }
    public function update_image(Request $request)
    {
        $get_image = $request->file('file');
        $img_id = $request->img_id;
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image-> move('upload/images', $new_image);
            $data['path'] = $new_image;
            $images = Image::find($img_id);
            unlink('upload/images/'.$images->path);
            $images->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $img_id = $request->img_id;
        $images = Image::find($img_id);
        unlink('upload/images/'.$images->path);
        $images->delete();
    }
}

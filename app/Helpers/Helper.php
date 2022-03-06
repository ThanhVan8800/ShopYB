<?php


namespace   App\Helpers;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnSelf;

// dùng auto-load composer.json
// composer dump-autoload
class Helper
{
        public static function menu($menus , $parent_id = 0 , $char = '') // 0 là lấy danh mục cha, 1 lấy danh mục all
        {
            $html = '';
            foreach($menus as $key => $menu){

                if($menu->parent_id == $parent_id){
                    
                    $html .= '
                    <tr>
                            <td>' . $menu->id . '</td>
                            <td>' .$char. $menu->name . '</td>
                            <td>' . self::active($menu->active) . '</td>
                            <td>' . $menu->updated_at . '</td>
                            <td>
                                <a href="/admin/menus/edit/' .$menu->id.'" class="btn btn-primary btn-sm" >
                                <i class="far fa-edit"></i>
                                </a>
                                <a href="#"  class="btn btn-danger btn-sm"
                                onclick="removeRow('.$menu->id.', \'/admin/menus/destroy\')" >
                                <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                    </tr>
                    ';
                
                    unset($menus[$key]); // đệ quy lần 1 hủy xong chạy tiếp ok chưa
                    $html .= self::menu($menus, $menu->id, $char . '--'); // tự gọi nó lại lần nữa
                };
            }
            return $html;   //return để đọc cái html xuất ra 
            
        }
        public static function active( $active = 0) : string
        {
            return $active == 0 ? '<span class= "btn btn-danger btn-xs">NO</span>' : 
            '<span class= "btn btn-success btn-xs"> YES</span>';    
        }
        public static function menus($menus, $parent_id = 0) : string
        {
            $html = '';
            foreach($menus as $key => $menu)
            {
                if($menu->parent_id == $parent_id)
                {
                    $html .= '
                        <li>
	                        <a href="/danh-muc/'.$menu->id.'-'.Str::slug($menu->name, '-').'.html">
                                    '.$menu->name.'
                            </a>';

                            unset($menus[$key]);

                            if(self::isChild($menus, $menu->id)){
                                    $html.='<ul class="sub-menu">';
                                        $html.= self::menus($menus,$menu->id);

                                    $html.='</ul>';
                            }
                        
                        $html.= ' </li>
                    
                    ';
                }
            }
            return $html;
        }
        public static function isChild($menus , $id) : bool
        {
            foreach($menus as $key => $menu)
            {
                if($menu -> parent_id == $id)
                return true;
            }
            return false;
        }
        public static function price($price = 0, $price_sale = 0)
        {
            if($price != 0 ) return number_format($price);
            if($price_sale != 0) return number_format($price_sale);
            return '<a href="/lien-he.html">Liên hệ</a>';
        }
}
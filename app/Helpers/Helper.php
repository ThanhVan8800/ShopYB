<?php


namespace   App\Helpers;

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
                              onclick="RemoveRow('.$menu->id.', \'/admin/menus/destroy\')" >
                              <i class="far fa-trash-alt"></i>
                              </a>
                                

                            </td>
                    </tr>
                    ';
                   
                    unset($menus[$key]); // đệ quy
                    $html .= self::menu($menus, $menu->id, $char . '--');
                };
            }
            return $html;   //return để đọc cái html xuất ra 
            
        }
        public static function active( $active = 0) : string
        {
            return $active == 0 ? '<span class= "btn btn-danger btn-xs">NO</span>' : 
            '<span class= "btn btn-success btn-xs"> YES</span>';    
        }
}
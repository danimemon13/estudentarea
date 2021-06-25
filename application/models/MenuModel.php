<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of categorymodel
 *
 * @author https://www.roytuts.com
 */
class MenuModel extends CI_Model {

    private $category = 'main_menu';

    function __construct() {
        
    }

    public function category_menu($role_id) {
        // Select all entries from the menu table
        //$query = $this->db->query("select id, name, link,icon,is_child,parent from " . $this->category);
        /*
        $query = 
        $query .= $this->db->where($condition);
        $query .= $this->db->get($this->category);*/
        $role_id = 1;
        $condition = "ps_menu_access.role_id =" . "'" . $role_id . "' and ps_menu_access.view_access='1'";
        $this->db->select('ps_menu.id, ps_menu.name, ps_menu.link,ps_menu.icon,ps_menu.is_child,parent');
		$this->db->from('ps_menu');
		$this->db->join('ps_menu_access','ps_menu_access.menu_id=ps_menu.id'); 
		$this->db->where($condition);
		$query = $this->db->get();
        // Create a multidimensional array to contain a list of items and parents
        $cat = array(
            'items' => array(),
            'parents' => array()
        );
        // Builds the array lists with data from the menu table
        foreach ($query->result() as $cats) {
            // Creates entry into items array with current menu item id ie. $menu['items'][1]
            $cat['items'][$cats->id] = $cats;
            // Creates entry into parents array. Parents array contains a list of all items with children
            $cat['parents'][$cats->parent][] = $cats->id;
        }

        if ($cat) {
            $result = $this->build_category_menu(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }

    // Menu builder function, parentId 0 is the root
    function build_category_menu($parent, $menu) {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            //$html .= "<ul>\n";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
                    if($menu['items'][$itemId]->parent==0){
                    $html .= '<li>';
                    $html .= "<a aria-expanded='false' data-toggle='collapse' class='list-group-item d-flex justify-content-between list-group-item-action align-items-center' href='#submenu".$menu['items'][$itemId]->id ."' >";
                    $html .= '<span class="sidebar_icon"><img src="'.base_url().$menu['items'][$itemId]->icon .'" alt=""></span>';
                    $html .= '<span class="sidebar_link ml-3">'.$menu['items'][$itemId]->name.'</span>';
                    $html .= '<span class="sidebar_link submenu-icon ml-auto"></span>';
                    $html .= '</a>';
                    $html .= '</li>';
                }
                else{
                    $html .= '<div id="submenu'.$menu['items'][$itemId]->parent .'" class="collapse sidebar-submenu">';
                    $html .= '<a href="'.base_url().''.$menu['items'][$itemId]->link.'" class="list-group-item list-group-item-action">';
                    $html .= '<span class="menu-collapsed">'.$menu['items'][$itemId]->name.'</span>';
                    $html .= '</a>';
                    $html .= '</div>';
                }
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= '<li>';
                    $html .= "<a aria-expanded='false' data-toggle='collapse' class='list-group-item d-flex justify-content-between list-group-item-action align-items-center' href='#submenu".$menu['items'][$itemId]->id ."' >";
                    $html .= '<span class="sidebar_icon"><img src="'.base_url().$menu['items'][$itemId]->icon .'" alt=""></span>';
                    $html .= '<span class="sidebar_link ml-3">'.$menu['items'][$itemId]->name.'</span>';
                    $html .= '<span class="sidebar_link submenu-icon ml-auto"></span>';
                    $html .= '</a>';
                    $html .= $this->build_category_menu($itemId, $menu);
                    $html .= '</li>';
                }
            }
            //$html .= "</ul>\n";
        }
        return $html;
    }
    
    public function  get_menu(){
        $this->db->select('*');
		$this->db->from('ps_main_menu');
		$query = $this->db->get();
		return $query->result();
    }
}

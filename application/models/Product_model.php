<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Product_model extends CI_Model {


    function get_category($parent=null){

        $this->db->where("parent_id", $parent);
        $query = $this->db->get('category');
        if($query->num_rows() == 0){
            $parent = $this->db->get_where("categorias", array("id"=>$parent))->result()[0]->parent_id;
            $this->db->where("parent_id", $parent);
            $query = $this->db->get('categorias');
        }
        $result = $query->result();
        
        if($parent != ""){
            $result_with_home = array();
            $home_element = new stdClass();
            $home_element->id = " ";
            $home_element->name = "Seleccione  sub-categoria...";
            $home_element->seo_name = "";
            $home_element->parent_id = null;
            $result_with_home[] = $home_element;
            foreach($result as $r){
                $result_with_home[] = $r;
            }
            $result = $result_with_home;
        }

        return $result;
    }

    
    function get_all_categories($parent=null, $tab){

        $this->db->where("parent_id", $parent);
        $query = $this->db->get('category');
        $result = $query->result();
        $tab = $tab."\t";
        foreach($result as $record){
                $categories = $categories . $tab . $record->name . "\n" . $this->get_categories($record->id,$tab);
        }
        return  $categories;

    }

    function get_property($parent=null){
        $this->db->where("category_id", $parent);
        $query = $this->db->get('category_properties');
        $result = $query->result();
        return $result;
    }

    function get_tree($id){
        $this->db->select('ascending_path');
        $this->db->from('category');
        $this->db->where('id', $id);
        $result = $this->db->get();

        return $result->row_array();;
    }


    function product_check(){

    }

    function code_check(){


    }

    function save_product($data){

        $this->db->insert("product", $data);

        
    }

    function get_new_id(){
        $this->db->select_max('id');
        $query = $this->db->get('product');
        $result = $query->result();
        return ($result[0]->id+1);
    }


    function get_added_product($id){

        $this->db->where("id", $id);
        $query = $this->db->get('product');
       // $result = $query->result();
       // return $result;
        if($query->num_rows() == 0){
            echo "El Producto no se cargo satisfactoriamente, Intente volver a cargarlo por favor.";
        } else{ 
            $result = $query->result();
            return $result[0];

            }
    }


    function get_catalog($id){

        $this->db->where("supplier_id", $id);
        $query = $this->db->get('product');
        if($query->num_rows() == 0){
            echo "No registra ningun producto cargado hasta el momento";
        } else{ 
            $result = $query->result();
            return $result;
            }
    }

}


<?php

class HCfaq{
    public static function insert($data){
        $db = $GLOBALS['wpdb'];
        return $db->insert($db->prefix.'qna',$data);
    }
    public static function update($data,$where){
        $db = $GLOBALS['wpdb'];
        return $db->update($db->prefix.'qna',$data,$where);
    }
    public static function delete($id){
        $db = $GLOBALS['wpdb'];
        return $db->query('delete from '.$db->prefix.'qna where id='.$id);
    }
    public static function get($id){
        $db = $GLOBALS['wpdb'];
        $post = $db->get_row('select * from '.$db->prefix.'qna where id="'.$id.'"');
        return !empty($post)? $post :null;
    }

 
   
    public static function getAll($valid = "",$params=array()){
        $db = $GLOBALS['wpdb'];
        $where = '';
        
        if($valid=="0" || $valid!=""){
            $where.="where valid={$valid}";
        }
        if(!empty($params))
            $posts = $db->get_results('select * from '.$db->prefix.'qna '.$where.' order by id desc limit '.$params['start'].','.$params['show']);
        else
            $posts = $db->get_results('select * from '.$db->prefix.'qna '.$where);
        return !empty($posts)?$posts:null;
    }
    public static function countAllResult($status = "",$valid = ""){
        $db = $GLOBALS['wpdb'];
        $where = '';
        if($valid!="" || $valid=='0'){
            $where.="where valid='{$valid}'";
        }
       
        $posts = $db->get_results('select id from '.$db->prefix.'qna '.$where.' order by id desc');
        return !empty($posts)?count($posts):0;
    }

}

?>
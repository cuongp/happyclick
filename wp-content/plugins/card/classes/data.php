<?php


class CardType{
    
    public static function insert($data){
        $db = $GLOBALS['wpdb'];
        return $db->insert($db->prefix.'card_type',$data);
    }
    public static function update($data,$where){
        $db = $GLOBALS['wpdb'];
        return $db->update($db->prefix.'card_type',$data,$where);
    }
    
    public static function delete($id){
        $db = $GLOBALS['wpdb'];
        $db->query('delete from '.$db->prefix.'card_type where id='.$id);
    }
    
    public static function get($id){
        $db = $GLOBALS['wpdb'];
        $post = $db->get_row('select * from '.$db->prefix.'card_type where id="'.$id.'"');
        return !empty($post)? $post :null;
    }
    
    public static function getAll($params){
        $db = $GLOBALS['wpdb'];
        if($params['valid']==null)
            $valid = '';
        else
            $valid = ' where valid='.$params['valid'];
        $posts = $db->get_results('select * from '.$db->prefix.'card_type '.$status.' order by id desc limit '.$params['start'].','.$params['show']);

        return !empty($posts)?$posts:null;
    }
}


class HCcard{
    public static function insert($data){
        $db = $GLOBALS['wpdb'];
        return $db->insert($db->prefix.'cards',$data);
    }
    public static function update($data,$where){
        $db = $GLOBALS['wpdb'];
        return $db->update($db->prefix.'cards',$data,$where);
    }
    public static function delete($id){
        $db = $GLOBALS['wpdb'];
        return $db->query('delete from '.$db->prefix.'cards where id='.$id);
    }
    public static function get($id){
        $db = $GLOBALS['wpdb'];
        $post = $db->get_row('select * from '.$db->prefix.'cards where id="'.$id.'"');
        return !empty($post)? $post :null;
    }

    public static function getAll($status = "",$valid = "",$params=array()){
        $db = $GLOBALS['wpdb'];
        $where = '';
        if($status!="" && $valid!=""){
            $where.="where status = {$status} and valid={$valid}";
        }elseif($status!="" || $status=='0'){
            $where.="where status ={$status}";
        }elseif($valid=="0" || $valid!=""){
            $where.="where valid={$valid}";
        }
        if(!empty($params))
            $posts = $db->get_results('select * from '.$db->prefix.'cards '.$where.' order by id desc limit '.$params['start'].','.$params['show']);
        else
            $posts = $db->get_results('select * from '.$db->prefix.'cards '.$where);
        return !empty($posts)?$posts:null;
    }
    public static function countAllResult($status = "",$valid = ""){
        $db = $GLOBALS['wpdb'];
        $where = '';
        if($status!="" && $valid!=""){
            $where.="where status='{$status}' and valid='{$valid}'";
        }elseif($status!="" || $status=='0'){
            $where.="where status ='{$status}'";
        }elseif($valid!="" || $valid=='0'){
            $where.="where valid='{$valid}'";
        }
       
        $posts = $db->get_results('select id from '.$db->prefix.'cards '.$where.' order by id desc');
        return !empty($posts)?count($posts):0;
    }

}

?>
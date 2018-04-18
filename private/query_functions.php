<?php
function find_all_subjects()
{
    global $db;
    $sql="SELECT * FROM subjects ";
    $sql .="ORDER BY id ASC";
  //  echo $sql;
    $result=mysqli_query($db,$sql);
    confirm_result_set($result);
    return $result;
}
function find_subject_by_id($id){
    global $db;
    $sql="SELECT * FROM subjects ";
    $sql .="WHERE id= '" . db_esccape($db,$id) . "'";
   // echo $sql;
    $result=mysqli_query($db,$sql);
    confirm_result_set($result);
    $subject=mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns anad assoxc array

}
function validate_subject($subject){
    $errors=[];
    if(is_blank($subject['menu_name'])){
        $errors[]="Name Cannot Be Blank.";
    }elseif(!has_length($subject['menu_name'],['min'=>2,'max'=>255])){
        $errors[]="Name Must be between 2 and 255 characters.";
    }
    $position_int=(int)$subject['position'] ;
    if($position_int<=0){
        $errors[]="Position Must be grater than zero.";
    }
    if($position_int>999){
        $errors[]="Position must less than 999";
    }
return $errors;
}
function find_page_by_id($id)
{
    global $db;
    $sql="SELECT * FROM pages WHERE id='" . $id . "'";
    $result=mysqli_query($db,$sql);
    confirm_result_set($result);
    $page=mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page;

}
function insert_subject($subject){
    global $db;
    $errors=validate_subject($subject);
    if(!empty($errors)){return $errors;}

    $sql= "INSERT INTO subjects ";
    $sql .="(menu_name,position,visible) ";
    $sql .="values (";
    $sql .="'" . db_esccape($db,$subject['menu_name']) . "',";
    $sql .="'" . db_esccape($db, $subject['position']) . "',";
    $sql .="'" . db_esccape($db,$subject['visible']) . "'";
    $sql .=")";
    $result=mysqli_query($db,$sql);
    // for insert statements , $result is true or false
    if($result){
       return true;
         }else
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }


}
function update_subject($subject)
{
    global $db;
    $errors=validate_subject($subject);
    if(!empty($errors)){return $errors;}

    $sql="UPDATE subjects SET ";
    $sql .="menu_name='" . db_esccape($db,$subject['menu_name']) . "',position='" . db_esccape($db,$subject['position']) . "',visible='" . db_esccape($db,$subject['visible']) . "' ";
    $sql .="WHERE id='" . db_esccape($db,$subject['id']) ."' LIMIT 1";

    $result=mysqli_query($db,$sql);
    //for update statement the reult id true or false
    if($result){
        //redirect_to(url_for('/staff/subjects/show.php?id=' . $id));
        return true;
    }else
    {
        // update failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_subject($id)
{
    global $db;
    $sql="DELETE FROM subjects WHERE id='" . db_esccape($db,$id) . "' LIMIT 1";
    $result=mysqli_query($db,$sql);
// for delete satements the result is tru AND FALSE
    if($result)
    {
        return true;
            //        redirect_to(url_for('/staff/subjects/index.php'));
    }else{
        //delete failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}
function find_all_pages()
{
    global $db;
    $sql="SELECT * FROM pages ";
    $sql .="ORDER BY id  ASC";
    $result=mysqli_query($db,$sql);
    confirm_result_set($result);
    return $result;
}

function insert_page($page)
{
    global $db;
    $errors=validate_page($page);
    if(!empty($errors)){
        return $errors;}
    $sql="INSERT INTO pages ";
    $sql .="(subject_id,menu_name,position,visible,content) ";
    $sql .="values (";
    $sql .="'" . db_esccape($db,$page['subject_id']) . "',";
    $sql .="'" . db_esccape($db,$page['menu_name']) . "',";
    $sql .="'" . db_esccape($db,$page['position']) . "',";
    $sql .="'" . db_esccape($db,$page['visible']) . "',";
    $sql .="'" . db_esccape($db,$page['content']) . "'";
    $sql .=")";
    //echo $sql;
    $result=mysqli_query($db,$sql);
    if($result){
        return true;
    }else
    {
        echo mysqli_errno($db);
        db_disconnect($db);
        exit;
    }
}
function validate_page($page){
    global $db;
    $errors=[];

    if(is_blank($page['subject_id'])) {
        $errors[] = "Subject cannot be blank.";
    }

    if(is_blank($page['menu_name'])){
        $errors[]="Name Cannot Be bLank";}
        elseif (!has_length($page['menu_name'],['min'=>2,'max'=>255])){
        $errors[]="Name must be in between 2 and 255 characters.";
    }
    $current_id=isset($page['id']) ? $page['id']: '0';
    if(!has_unique_page_menu_name($page['menu_name'],$current_id)){
        $errors[]="Menu Name must be unique.";
    }
    $postion_int = (int) $page['position'];
    if($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }
    if(is_blank($page['content'])) {
        $errors[] = "Content cannot be blank.";
    }

    return $errors;
}

function update_page($page)
{
    global $db;
    $errors=validate_page($page);
        if(!empty($errors)){return $errors;
    }

    $sql="UPDATE pages SET ";
    $sql .="subject_id='" . db_esccape($db,$page['subject_id']) . "', ";
    $sql .="menu_name='" . db_esccape($db,$page['menu_name']) . "', ";
    $sql .="position='" . db_esccape($db,$page['position']) . "', ";
    $sql .="visible='" . db_esccape($db,$page['visible']) . "', ";
    $sql .="content='" . db_esccape($db,$page['content']) . "' ";
    $sql .="WHERE id='" . db_esccape($db,$page['id']) ."' ";
    $sql .="LIMIT 1";
    //echo $sql;
    $result=mysqli_query($db,$sql);
    //for update statement the reult id true or false
    if($result){
        //redirect_to(url_for('/staff/subjects/show.php?id=' . $id));
        return true;
    }else
    {// update failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}
function delete_page($id){
    global $db;

    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . db_esccape($db,$id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
?>
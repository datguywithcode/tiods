 <?php
class Mysql_Func
{
    
    private $dbHost;
    private $dbUser;
    private $dbpass;
    private $dbName;
    public $last_query;
    
    
    function Connect($getHost, $getUser, $getPass, $getName)
    {
        $this->dbHost = $getHost;
        $this->dbUser = $getUser;
        $this->dbpass = $getPass;
        $this->dbName = $getName;
        mysql_select_db($this->dbName, mysql_connect($this->dbHost, $this->dbUser, $this->dbpass)) or die(mysql_error());
        
    }
    
    
    
    function query($slt, $table, $where = false)
    {
        
        $this->last_query = "select " . $slt . " from " . $table . " where " . $where;
        //echo $this->last_query; die;
        return mysql_query("select " . $slt . " from " . $table . " where " . $where);
    }
    function query_execute($sql)
    {
        return mysql_query($sql);
    }
    function execute_query($slt, $table, $where = false, $order_by)
    {
        //echo "select ".$slt." from ".$table." where ".$where." order by ".$order_by;
        return mysql_query("select " . $slt . " from " . $table . " where " . $where . " order by " . $order_by);
    }
    function execute_join_query($select, $table1, $table2, $on, $where = false, $order_by)
    {
        $sql = "select " . $select . " from " . $table1 . " inner join " . $table2 . " on " . $on . " where " . $where . " order by " . $order_by;
        
        return mysql_query($sql);
    }
    function result($res, $p1, $p2)
    {
        return mysql_result($res, $p1, $p2);
    }
    function num_row($res)
    {
        return mysql_num_rows($res);
    }
    function get_row($res)
    {
        $row = mysql_fetch_array($res);
        return $row[0];
    }
    
    function get_single_row($res)
    {
        $row = mysql_fetch_array($res);
        return $row;
    }
    
    
    function get_all_row($res)
    {
        $row = mysql_fetch_assoc($res);
        return $row;
    }
    function get_pid()
    {
        return mysql_insert_id();
    }
    
    function insert_tbl($insert_arr, $tbl)
    {
        $sql = "INSERT INTO $tbl set ";
        foreach ($insert_arr as $key => $val)
            $sql .= $key . "='" . (mysql_real_escape_string($val)) . "',";
        $sql = substr($sql, 0, strlen($sql) - 1);
        //echo $sql; "<br>"; 
        $rs  = $this->query_execute($sql);
        if ($rs)
            return true;
        else
            return false;
    }
    
    function update_tbl($update, $tbl, $where, $addslashes = false)
    {
        $sql = "update $tbl set ";
        foreach ($update as $key => $val) {
            if ($addslashes)
                $val = addslashes($val);
            $sql .= $key . "='" . mysql_real_escape_string($val) . "',";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= " where $where ";
        //echo $sql; "<br>"; exit;
        $rs = $this->query_execute($sql);
        if ($rs)
            return true;
        else
            return false;
    }
    
    
    function meeting_time($format, $meet_time)
    {
        if ($format == 24) {
            for ($i = 1; $i <= 24; $i++) {
                $value = $i - 1;
                $val   = $value . '_' . $i;
                $name  = "From " . $value . " To " . $i;
                if ($val == $meet_time) {
                    $select = "selected";
                } else {
                    $select = "";
                }
                echo "<option value='" . $value . "' " . $select . ">" . $name . "</option>";
            }
        } else if ($format == 12) {
            for ($i = 0; $i <= 23; $i++) {
                // check the time format wise
                if ($i < 12) {
                    $a = $i;
                    $f = 'AM';
                } else if ($i == 12) {
                    $a = 12;
                    $f = 'PM';
                } else if ($i == 24) {
                    $a = 12;
                    $f = 'AM';
                } else {
                    $a = $i % 12;
                    $f = 'PM';
                }
                if ($i == 24) {
                    $value = $a;
                } else {
                    if ($a == 12)
                        $value = 1;
                    else
                        $value = $a + 1;
                }
                $val = $a . $f . '_' . $value . $f;
                if ($val == $meet_time) {
                    $select = "selected";
                } else {
                    $select = "";
                }
                $name = "From " . $a . " " . $f . " To " . $value . " " . $f;
                echo "<option value='" . $val . "' " . $select . ">" . $name . "</option>";
            }
        }
    }
    function _change_password()
    {
        $old_pass   = $_POST['old_password'];
        $new_pass   = $_POST['new_password'];
        $c_pass     = $_POST['c_password'];
        $userid     = USERNAME;
        $table_name = TABLE_PREFIX . 'admin';
        // check the old password is valid or not
        $res        = $this->query("*", $table_name, " userid='$userid' and password='$old_pass'");
        $count      = $this->num_row($res);
        if ($count) {
            if ($new_pass == $c_pass) {
                $curdate    = date('Y-m-d');
                $update_arr = array(
                    "password" => $new_pass,
                    "modify_by" => USERNAME,
                    "modify_date" => $curdate
                );
                $where      = " id='$id'";
                $this->update_tbl($update_arr, $table_name, $where);
                $msg = "Password Change Successfully.";
            } else {
                $msg = "Password and Confirm Password Should Be Same.";
            }
        } else {
            $msg = "Wrong Old Password.";
        }
        header("Location:change_password.php?msg=" . $msg);
    }
    
    function active_inactive($status, $id, $table_name)
    {
        $curdate    = date('Y-m-d');
        $update_arr = array(
            "status" => $status,
            "modify_by" => USERNAME,
            "modify_date" => $curdate
        );
        $where      = " id='$id'";
        $this->update_tbl($update_arr, $table_name, $where);
    }
    
    function get_field_name($table_name, $field, $condition)
    {
        //echo $field."==".$table_name."==".$condition;exit;
        $res = $this->query($field, $table_name, $condition);
        $row = $this->get_all_row($res);
        return $row[$field];
    }
    
    function get_field_concatname($table_name, $field, $condition)
    {
        $name = strstr($field, ' as ');
        $name = trim($name, ' as ');
        //echo $field."==".$table_name."==".$condition;exit;
        $res  = $this->query($field, $table_name, $condition);
        $row  = $this->get_all_row($res);
        return $row[$name];
    }
    function get_dropdown($tbl_name, $field_arr, $condition, $value, $name, $check = false)
    {
        $table_name = TABLE_PREFIX . $tbl_name;
        $field      = implode(",", $field_arr);
        //echo $field.'=='.$table_name;exit;
        $res        = $this->query($field, $table_name, $condition);
        while ($row = $this->get_all_row($res)) {
            if ($row[$value] == $check) {
                $select = "selected";
            } else {
                $select = '';
            }
            echo "<option value='" . $row[$value] . "' " . $select . ">" . $row[$name] . "</option>";
        }
    }
    function get_checkboxes($tbl_name, $field_arr, $condition, $value, $name, $checkboxname, $line, $check = false)
    {
        $table_name = TABLE_PREFIX . $tbl_name;
        $field      = implode(",", $field_arr);
        $res        = $this->query($field, $table_name, $condition);
        $ln         = 1;
        
        if ($check) {
            $check_arr = explode(",", $check);
            $flag      = true;
        }
        //echo "<pre>"; print_r($check_arr); exit;
        while ($row = $this->get_all_row($res)) {
            
            if ($flag) {
                if (in_array($row[$value], $check_arr)) {
                    $select = "checked";
                } else {
                    $select = '';
                }
            }
            echo "&nbsp;<input type='checkbox' name='" . $checkboxname . "' value='" . $row[$value] . "' " . $select . ">" . $row[$name] . "&nbsp;";
            //echo "<option value='".$row[$value]."' ".$select.">".$row[$name]."</option>";
            if ($ln % $line == 0)
                echo "<br>";
            $ln++;
        }
    }
    function dropdown($table_name, $field_arr, $condition)
    {
        $field = implode(",", $field_arr);
        $res   = $this->query($field, $table_name, $condition);
        while ($row = $this->get_all_row($res)) {
            echo "<option value=''></option>";
        }
    }
    function upload_files($path, $file)
    {
        $filename  = $_FILES[$file]['name'];
        $filetype  = $_FILES[$file]['type'];
        $filetmp   = $_FILES[$file]['tmp_name'];
        $ext       = end(explode(",", $filename));
        $file_path = "../product_logos/" . $path . "/";
        $blacklist = array(
            ".php",
            ".phtml",
            ".php3",
            ".php4"
        );
        $flag      = 0;
        foreach ($blacklist as $item) {
            if (preg_match("/$item\$/i", $filename)) {
                $flag++;
            }
        }
        if ($flag) {
            return "error_ext";
        }
        // malicious file validaiton
        $fp = fopen($_FILES[$file]['tmp_name'], 'r');
        fseek($fp, 0);
        $data  = fread($fp, 5);
        //echo $data;exit;
        $flag1 = 0;
        if (strcmp($data, "%DOC-") == 0 || strcmp($data, "%XLS-") == 0 || strcmp($data, "%PPT-") == 0 || strcmp($data, "%PDF-") == 0 || strcmp($data, "PK") == 0 || strcmp($data, "MZ") == 0) {
            $flag = 1;
        } else {
            $flag = 1;
            //return "error_type";
            //echo "Sorry, we only accept correct doc, pdf, ppt and xls file \n";exit;
        }
        
        fclose($fp);
        if ($filename != '') {
            $image2 = time() . '_' . $ext;
            $r      = move_uploaded_file($filetmp, $file_path . $image2);
            if ($r) {
                return $image2;
            } else {
                return "error_upload";
            }
        }
    }
    
    function file_upload($path)
    {
        $filename  = $_FILES['avatar']['name'];
        $filetype  = $_FILES['avatar']['type'];
        $filetmp   = $_FILES['avatar']['tmp_name'];
        $file_path = "../userimages/" . $path . "/";
        $blacklist = array(
            ".php",
            ".phtml",
            ".php3",
            ".php4"
        );
        $flag      = 0;
        foreach ($blacklist as $item) {
            if (preg_match("/$item\$/i", $filename)) {
                $flag++;
            }
        }
        if ($flag) {
            return "error_ext";
        }
        $imageinfo = @getimagesize($filetmp);
        $flag1     = 0;
        if ($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') {
            $flag1++;
        }
        if ($flag1) {
            return "error_type";
        }
        if ($filename != '') {
            $image2 = time() . '_' . '.jpg';
            $r      = move_uploaded_file($filetmp, $file_path . $image2);
            if ($r) {
                return $image2;
            } else {
                return "error_upload";
            }
        }
    }
    
    function file_image($path, $file_path)
    {
        $filename  = $_FILES['image']['name'];
        $filetype  = $_FILES['image']['type'];
        $filetmp   = $_FILES['image']['tmp_name'];
        //$file_path="../userimages/".$path."/";
        $blacklist = array(
            ".php",
            ".phtml",
            ".php3",
            ".php4"
        );
        $flag      = 0;
        foreach ($blacklist as $item) {
            if (preg_match("/$item\$/i", $filename)) {
                $flag++;
            }
        }
        if ($flag) {
            return "error_ext";
        }
        $imageinfo = @getimagesize($filetmp);
        $flag1     = 0;
        if ($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') {
            $flag1++;
        }
        if ($flag1) {
            return "error_type";
        }
        if ($filename != '') {
            $image2 = time() . '_' . '.jpg';
            $r      = move_uploaded_file($filetmp, $file_path . $image2);
            if ($r) {
                return $image2;
            } else {
                return "error_upload";
            }
        }
    }
    function file_image_logo($path, $file_path, $file)
    {
        $filename  = $_FILES[$file]['name'];
        $filetype  = $_FILES[$file]['type'];
        $filetmp   = $_FILES[$file]['tmp_name'];
        //$file_path="../userimages/".$path."/";
        $blacklist = array(
            ".php",
            ".phtml",
            ".php3",
            ".php4"
        );
        $flag      = 0;
        foreach ($blacklist as $item) {
            if (preg_match("/$item\$/i", $filename)) {
                $flag++;
            }
        }
        if ($flag) {
            return "error_ext";
        }
        $imageinfo = @getimagesize($filetmp);
        $flag1     = 0;
        if ($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') {
            $flag1++;
        }
        if ($flag1) {
            return "error_type";
        }
        if ($filename != '') {
            if ($file == 'logo') {
                //$image2=time().'_'.$file.'_'.'.jpg';
                $image2 = $filename;
            } else {
                $image2 = $file . '.ico';
            }
            $r = move_uploaded_file($filetmp, $file_path . $image2);
            if ($r) {
                return $image2;
            } else {
                return "error_upload";
            }
        }
    }
    
    /*function userid()
    {
    //$encypt1=uniqid(rand(), true);
    $table_name=TABLE_PREFIX.'employee';
    $encypt1=uniqid(rand(1000000000,9999999999), true);
    $usid1=str_replace(".", "", $encypt1);
    $pre_userid = substr($usid1, 0, 7);
    
    $checkid=mysql_query("select user_id from $table_name where user_id='$pre_userid'");
    if(mysql_num_rows($checkid)>0)
    {
    userid();
    }
    else
    return $pre_userid;
    }*/
}

?> 
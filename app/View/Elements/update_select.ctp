<?php


if(isset($selected)){
        echo "<option value=''></option>";
    foreach($data as $k=>$v){
       if($selected == $v){
           echo "<option value='$k' selected='selected'>".$v."</option>";
       }
       else {   
           echo "<option value='$k'>".$v."</option>";}

}
}
else{
     echo "<option value=''></option>";
    if(!empty($data)){
    foreach($data as $k=>$v){
    echo "<option value='$k'>".$v."</option>";
    }
}
}





?>

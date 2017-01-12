<?php
function asset_url($url){
    if(!empty($url))
    {
        echo base_url().'assets/'.$url;
    }else {
        echo "that";
      return base_url().'assets/';
    }
}
?>

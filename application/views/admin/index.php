<script src="<?php asset_url("js/chat-admin.js");?>"></script>

<div class="container admin">
    <div class="row">
        <div class="col-12">
            <p style="text-align: right"><a href="<?php echo base_url();?>admin/logout" class="logout">logout</a></p>
        </div>
    </div>


    <div class="row">
        <div class="col-8 offset-2 center">
            <h3>Set chat mode:</h3>
                <button value="1" id="mode_1" name="mode_change" class="mode mode_change btn btn-primary btn-lg">Chat on</button><!-- btn-primary is a lie -->
                <!-- <button value="2" id="mode_2" name="mode_change" class="mode mode_change btn btn-lg">Chat on:<br>Multi colour</button> -->
                <button value="3" id="mode_3" name="mode_change" class="mode mode_change btn btn-lg">Chat off</button>
                <button id="clear_chat" class="mode btn btn-lg">Clear chat</button>
        </div>
    </row>
    <br>
    <?php
        $this->load->view('admin/chat-view');
    ?>



</div>

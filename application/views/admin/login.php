<div class="container login">
    <div class="span6 offset3">
        <form action='<?php echo base_url();?>admin/processlogin' method='post' name='process'>
            <h2>User Login</h2>
            <br />
            <?php
            if($this->session->flashdata('error'))
            {
                echo "<p class='error'>".$this->session->flashdata('error')."</p>";
            }
            ?>
            <label for='username'>Username</label>
            <input type='text' name='username' id='username' size='25' /><br />

            <label for='password'>Password</label>
            <input type='password' name='password' id='password' size='25' /><br />

            <input type='Submit' value='Login' />
        </form>
    </div>
</div>

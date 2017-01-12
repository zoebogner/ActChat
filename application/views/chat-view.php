<script src="<?php asset_url("js/chat.min.js");?>"></script>

<div class="container">
    <div class="row">
        <div class="col-lg-12 chatarea">

            <div class="overlay"></div>

            <!-- <div id="received" rows="10" cols="50"></div> -->
            <div id="received" style="width:100%; height: 300px; overflow: scroll"></div>


        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 inputarea">
            <form>
              <input id="text" type="text" name="user" placeholder="What do you want to say?"><br><br>
              <input type="submit" value="Send" id="submit" class="btn btn-default btn-block">
            </form>
        </div>
    </div>
</div>

</body>
</html>

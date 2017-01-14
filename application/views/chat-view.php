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
        <div class="col-xs-12 inputarea">
            <form class="form-inline">
                <div class="form-group col-xs-11">
                    <input id="text" class="form-control" type="text" name="user" placeholder="Message">
                </div>
                
                <button type="submit" value="Send" id="submit" class="btn btn-default col-xs-1"><i class="glyphicon glyphicon-circle-arrow-up"></i>
            </form>
        </div>
    </div>
</div>

</body>
</html>

<script src="<?php asset_url("js/chat.min.js");?>"></script>

  <div class="row">
      <div class="col-lg-12 chatarea">
          <div id="received" style="width:100%; height: 300px; overflow: scroll"></div>
      </div>
  </div>

  <div class="row">
      <div class="col-lg-12 inputarea">
          <form>
            <input id="text" type="text" name="user" placeholder="What do you want to say?">
            <!-- <textarea id="text" name="userinput"></textarea> -->
            <br>
            
            <!-- Send -->
            <button type="submit" value="Send" id="submit" class="btn btn-lg btn-primary btn-block">Send</button>
            <br>
            <!-- Send as chat bubbles -->
            <button type="submit" value="Send grey chat" id="submitleft" class="btn btn-lg col-lg-6">Send grey chat</button>
            <button type="submit" value="Send green chat" id="submitright" class="btn btn-lg btn-success col-lg-6">Send green chat</button>
            <br>
            <!-- Start poll -->
            <button value="startpoll" id="startpoll" class="btn btn-lg btn-default btn-block">Start poll</button>
            <button type="submit" id="stoppoll" class="btn btn-lg btn-default btn-block" style="display:none">Stop poll</button>
          </form>
      </div>
  </div>

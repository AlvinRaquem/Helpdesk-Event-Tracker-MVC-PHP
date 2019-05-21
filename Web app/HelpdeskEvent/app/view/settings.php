<?php include VIEW_PATH.'/includes/header.php'; use helper\session;?>

  <style>
    
      @media (max-width: 500px){
        .col-3 {
          width: 100%;
        }
      }

      @media (max-width: 800px) and (min-width: 501px){
        .col-3 {
          width: 50%;
        }
      }

      #mainBody a {
        text-decoration: none;
        color: dimgray;
      }

  </style>

<div id="mainBody">
  <span class="pageheader"><i class="fa fa-cogs"></i> Settings</span><hr/>


      <div class="col-3">
        <div class="panel">
          <div class="panel-header panel-danger">
          &nbsp;
          </div>

          <div class="panel-body">
            <a href="changepassword" style="font-size:16pt;"><span class="fa fa-lock"> Change Password</span></a>
          </div>
        </div>
      </div>

      <?php if(session::get("SESS_USER_TYPE") == "admin") :?>
      <div class="col-3">
        <div class="panel">
          <div class="panel-header panel-danger">
          &nbsp;
          </div>

          <div class="panel-body">
            <a href="manage_users" style="font-size:16pt;"><span class="fa fa-users"> Users</span></a>
          </div>
        </div>
      </div>

      <div class="col-3">
        <div class="panel">
          <div class="panel-header panel-danger">
           &nbsp;
          </div>

          <div class="panel-body">
            <a href="atmlist" style="font-size:16pt;"><span class="fa fa-map-marker-alt"> Unit List(s)</span></a>
          </div>
        </div>
      </div>


      <div class="col-3">
        <div class="panel">
          <div class="panel-header panel-danger">
           &nbsp;
          </div>

          <div class="panel-body">
            <a href="complaint_lists" style="font-size:16pt;"><span class="fa fa-file-signature"> Complaint List(s)</span></a>
          </div>
        </div>
      </div>

    <?php endif?>
</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript">
  $('#settingnav').addClass('activenav');
</script>
</body>
</html>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Bid Product</title>
  </head>
  <body>
  <div class="container">
  <div class="row">

    <div class="col-md-12"><h3>Signin Page</h3></div>
    
  <form name="form1" method="post" action="<?php echo base_url('auth_login')?>">
  <?php 
  $msg = $this->session->flashdata('msg-info');
  $msg1 = $this->session->flashdata('msg-danger');

  if(isset($mag)){
    echo $msg;
  }else{
    echo $msg1;
  }
  
  ?>
  <div class="form-group">
    <label for="inputAddress">Username</label>
    <input type="text" name="username" class="form-control" id="inputAddress" placeholder="" value="<?php echo set_value('username'); ?>">
  </div>
  <div><span><?php echo form_error('username'); ?></span></div>
  <div class="form-group">
    <label for="inputAddress">Password</label>
    <input type="password" name="password" class="form-control" id="inputAddress" placeholder="" value="<?php echo set_value('password'); ?>">
  </div>
  <div><span><?php echo form_error('password'); ?></span></div>
  
  <button type="submit" class="btn btn-primary">Sign In</button>
</form>
</div>
<div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
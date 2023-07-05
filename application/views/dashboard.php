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

    <div class="col-md-12"><h3>DashBoard Page</h3></div>
    <a class="pull-right" href="<?php echo base_url('logout');?>">Logout</a>
     
  <?php 
  $bid_limit = $this->session->userdata('bids');
  $msg = $this->session->flashdata('msg-info');
  $msg1 = $this->session->flashdata('msg-danger');

  if(isset($mag)){
    echo $msg;
  }else{
    echo $msg1;
  }
  
  
  foreach ($result as $value) {
  ?>
    <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $value->image;?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title" id="price_<?php echo $value->id;?>"><?php echo $value->price; ?></h5>
    <p class="card-text"><?php echo $value->product_name;?>.</p>
    <button class="btn btn-primary" id="btns" <?php if($bid_limit == 0) { echo "disabled"; }?> onClick="hitValue('<?php echo $value->id; ?>')">Bid hit</button>
  </div>
</div>
<?php } ?>
</div>
<div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <script>
    function hitValue(vals){
        let product_id = vals;
        let price = $('#price_'+product_id).text();
        price = + price +10;
        $("#price_"+product_id).text(price);
        $.ajax({
            url : '<?php echo base_url('dashboard/bitHit');?>',
            data : { 'product_id' : product_id, 'hit': 1, 'price' : price},
            type:'POST',
            dataType : 'json',
            success:function(data){
                let btn = data.bid_limit;
                if(btn === 0){
                    $('button[id^="btns"]'). prop('disabled', true);
                }else{
                    $('button[id^="btns"]'). prop('disabled', false); 
                }
            }
        });
    }

    function getData(){
        $.ajax({
            url : '<?php echo base_url('dashboard/getAll');?>',
            type : 'get',
            dataType : 'json',
            success:function(data){
                $.each(data, function(key,val) {             
                    $("#price_"+val.id).text(val.price);
        });   
            }
        });
    }
    setInterval("getData()", 5000);

 </script>  

</body>
</html>
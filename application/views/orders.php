<html>
<head>
    <title><h1>Shopping ICE</h1></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
 <br /><br />
 
 <div class="col-lg-6 col-md-6">
  <div class="table-responsive">
   <h3 align="center">Shopping Cart</h3><br />
   <?php
   foreach($product as $row)
   {
    echo '
    <div class="col-md-4" style="padding:16px; background-color:#f1f1f1; border:1px solid #ccc; margin-bottom:16px; height:400px" align="center">
     <img src="'.base_url().'images/'.$row->product_image.'" class="img-thumbnail" /><br />
     <h4>'.$row->product_name.'</h4>
         
<form action="" method="POST">

         
     <div class="form-group">
                <label for="units_of_measurement" >Units of measurement:</label>
                  <select class="form-control units_of_measurement" id="units_of_measurement" name"units_of_measurement">
                        <option value="Lbs">Lbs</option>
                       <option value="Kg">Kg</option>
                       <option value="Each">Each</option>
                        <option value="Minimun_Charge">Minimun_Charge</option>
                  </select>
            </div>
            
            <div class="form-group">
            <label for="quantity" >quantity</label>
     <input type="text" name="quantity" class="form-control quantity" id="'.$row->product_id.'" /><br />
     </div>
<div>
<button type="button" name="add_cart" class="btn btn-success add_cart"  data-units_of_measurement="'.$row->units_of_measurement.'"  data-productname="'.$row->product_name.'" data-price="'.$row->product_price.'" data-productid="'.$row->product_id.'"/>Add to Cart</button>
   </div>      
</form>

    </div>
    ';
   }
   ?>
      
  </div>
 </div>
 <div class="col-lg-6 col-md-6">
  <div id="cart_details">
   <h3 align="center">Cart is Empty</h3>
  </div>
 </div>
 
</div>
</body>
</html>
<script>
$(document).ready(function(){
 
 $('.add_cart').click(function(){
  var product_id = $(this).data("productid");
  var product_name = $(this).data("productname");
  var product_price = $(this).data("price");
  var units_of_measurement = $(this).data("units_of_measurement");
 // var units_of_measurement = document.getElementById("email").value;   checked rhp this code to obtain units_of_measurement
  var quantity = $('#' + product_id).val();
  if(quantity != '' && quantity > 0)
  {
   $.ajax({
    url:"<?php echo base_url(); ?>index.php/orders/add",
    method:"POST",
    data:{ product_id:product_id, product_name:product_name, product_price:product_price, quantity:quantity, units_of_measurement:units_of_measurement},
    success:function(data)
    {
     alert("Product Added into Cart");
   //  alert(product_id) ;
     $('#cart_details').html(data);
     $('#' + product_id).val('');
    }
   });
  }
  else
  {
   alert("Please Enter quantity");
  }
 });

 $('#cart_details').load("<?php echo base_url(); ?>index.php/orders/load");

 $(document).on('click', '.remove_inventory', function(){
  var row_id = $(this).attr("id");
  if(confirm("Are you sure you want to remove this?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>index.php/orders/remove",
    method:"POST",
    data:{row_id:row_id},
    success:function(data)
    {
     alert("Product removed from Cart");
     $('#cart_details').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });

 $(document).on('click', '#clear_cart', function(){
  if(confirm("Are you sure you want to clear cart?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>index.php/orders/clear",
    success:function(data)
    {
     alert("Your cart has been clear...");
     $('#cart_details').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });

$(document).on('click', '#submit_order', function(){
  if(confirm("Are you sure you want to buy that product?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>index.php/orders/add_order",
    success:function(data)
    {
     alert("Your order has been submit...");
     $('#cart_details').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });

});
</script>
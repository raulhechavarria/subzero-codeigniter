<!doctype html>
<html lang="en">
  <head>
    <title>Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS--> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    </head>
    
  <body>
    <h1>Register page</h1>
    <p>Fill register details in our web</p>
    <?php if (isset($_SESSION['success'])) {?>
       <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
    <?php
    }?>
    <?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
       <div id="element">
    <form action="" method="POST">
        <div class="col-lg-5 col-lg-offset-2">
           
            <div class="block">
                <label for="namecompany" >Company name:</label>
                <input class="form-control" name="namecompany" id="namecompany" type="text">
            </div> 
            <div class="block">
                <label for="addresscompany" >Company address:</label>
                <input class="form-control" name="addresscompany" id="addresscompany" type="text">
            </div> 
            <div class="block">
                <label for="username" >Username:</label>
                <input class="form-control" name="username" id="username" type="text">
            </div> 
            <div class="block">
                  <label for="password" >Password:</label>
                  <input class="form-control" name="password" id="password" type="password">
            </div> 
            <div class="block">
                  <label for="password" >Confirm Password:</label>
                  <input class="form-control" name="password" id="password" type="password">
            </div>
            
            
            <div class="form-group">
			<label class="col-sm-2 control-label">Phones</label>
			<div class="col-sm-10">
			
				<div class="phone-list">
				
					<div class="input-group phone-input">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="type-text">Type</span> <span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
								<li><a class="changeType" href="javascript:;" data-type-value="phone">Phone</a></li>
								<li><a class="changeType" href="javascript:;" data-type-value="fax">Fax</a></li>
								<li><a class="changeType" href="javascript:;" data-type-value="mobile">Mobile</a></li>
							</ul>
						</span>
						<input type="hidden" name="phone[1][type]" class="type-input" value="" />
						<input type="text" name="phone[1][number]" class="form-control" placeholder="+1 (999) 999 9999" />
					</div>
					
				</div>
				
				
				<button type="button" class="btn btn-success btn-sm btn-add-phone"><span class="glyphicon glyphicon-plus"></span> Add Phone</button>
			</div>
			
		</div>
            
		<div class="form-group">
			<label class="col-sm-2 control-label">Emails</label>
			<div class="col-sm-10">
			
				<div class="email-list">
				
					<div class="input-group email-input">
						
						<input type="text" name="email[1][email]" class="form-control"  />
					</div>
					
				</div>
				
                                    <button type="button" class="btn btn-success btn-sm btn-add-email">
                                        <span class="glyphicon glyphicon-plus"></span> Add Email</button>
			</div>
			 
		</div>
        <div class="form-group">
			<label class="col-sm-2 control-label">Shipping addresses </label>
			<div class="col-sm-10">
				<div class="shippingaddress-list">
					<div class="input-group shippingaddress-input">
						<input type="text" name="shippingaddress[1][shippingaddress]" class="form-control" />
					</div>
				</div>
				<button type="button" class="btn btn-success btn-sm btn-add-shippingaddress">
                                    <span class="glyphicon glyphicon-plus"></span> Add Shipping address
                                </button>
			</div>
			
		</div>
    
            <div>
                <button class="btn btn-primary" name="register">Register</button>
            </div>
        </div>
    </form>
       </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>




<script>
  ///this is  for phone
     	$(function(){
		
			$(document.body).on('click', '.changeType' ,function(){
				$(this).closest('.phone-input').find('.type-text').text($(this).text());
				$(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
			});
			
			$(document.body).on('click', '.btn-remove-phone' ,function(){
				$(this).closest('.phone-input').remove();
			});
			
			
			$('.btn-add-phone').click(function(){

				var index = $('.phone-input').length + 1;
				
				$('.phone-list').append(''+
						'<div class="input-group phone-input">'+
							'<span class="input-group-btn">'+
								'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="type-text">Type</span> <span class="caret"></span></button>'+
								'<ul class="dropdown-menu" role="menu">'+
									'<li><a class="changeType" href="javascript:;" data-type-value="phone">Phone</a></li>'+
									'<li><a class="changeType" href="javascript:;" data-type-value="fax">Fax</a></li>'+
									'<li><a class="changeType" href="javascript:;" data-type-value="mobile">Mobile</a></li>'+
								'</ul>'+
							'</span>'+
							'<input type="text" name="phone['+index+'][number]" class="form-control" placeholder="+1 (999) 999 9999" />'+
							'<input type="hidden" name="phone['+index+'][type]" class="type-input" value="" />'+
							'<span class="input-group-btn">'+
								'<button class="btn btn-danger btn-remove-phone" type="button"><span class="glyphicon glyphicon-remove"></span></button>'+
							'</span>'+
						'</div>'
				);

			});
			
		});
  ///this is  for email
     	$(function(){
		
			$(document.body).on('click', '.changeTypeemail' ,function(){
				$(this).closest('.email-input').find('.type-text').text($(this).text());
				$(this).closest('.email-input').find('.type-input').val($(this).data('type-value'));
			});
			
			$(document.body).on('click', '.btn-remove-email' ,function(){
				$(this).closest('.email-input').remove();
			});
			
			
			$('.btn-add-email').click(function(){

				var index = $('.email-input').length + 1;
				
				$('.email-list').append(''+
						'<div class="input-group email-input">'+
							
							'<input type="text" name="email['+index+'][email]" class="form-control"  />'+
							'<span class="email-input-group-btn">'+
								'<button class="btn btn-danger btn-remove-email" type="button"><span class="glyphicon glyphicon-remove"></span></button>'+
							'</span>'+
						'</div>'
				);

			});
			
		});
  ///this is  for shippingaddress
     	$(function(){
		
		/*	$(document.body).on('click', '.changeTypeshippingaddress' ,function(){
				$(this).closest('.shippingaddress-input').find('.type-text').text($(this).text());
				$(this).closest('.shippingaddress-input').find('.type-input').val($(this).data('type-value'));
			});*/
			
			$(document.body).on('click', '.btn-remove-shippingaddress' ,function(){
				$(this).closest('.shippingaddress-input').remove();
			});
			
			
			$('.btn-add-shippingaddress').click(function(){

				var index2 = $('.shippingaddress-input').length + 1;
				
				$('.shippingaddress-list').append(''+
						'<div class="input-group shippingaddress-input">'+
							
							'<input type="text" name="shippingaddress['+index2+'][shippingaddress]" class="form-control" />'+
							'<span class="shippingaddress-input-group-btn">'+
								'<button class="btn btn-danger btn-remove-shippingaddress" type="button"><span class="glyphicon glyphicon-remove"></span></button>'+
							'</span>'+
						'</div>'
				);

			});
			
		});
 
 
</script>

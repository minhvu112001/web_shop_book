<div class="container">
  <ul class="breadcrumb">
	<li><a href="<?php echo urlAdmin(); ?>"><i class="fa fa-home"></i>Quản Trị</a></li>
	<li><a href="<?php echo urlCart(); ?>">Giỏ Hàng</a></li>
	<li><a href="<?php echo urlCheckout(); ?>">Thanh Toán</a></li>
  </ul>

  <div class="row">
    <div id="content" class="col-sm-12">
      <h1>Thanh Toán</h1>
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Xác nhận thông tin cá nhân và đơn hàng</h4>
          </div>
          <div class="panel-collapse" id="collapse-checkout-option">
            <div class="panel-body">
             <form action="<?php echo urlCheckout() ?>" method="post" enctype="multipart/form-data">
            	<!-- START GUEST FORM -->
            	<?php if ($_SESSION['ERROR_TEXT']) {?>
            	<div class="alert alert-danger">
            		<i class="fa fa-exclamation-circle"></i>&nbsp;<?php echo $_SESSION['ERROR_TEXT']?>
            		<button type="button" class="close" data-dismiss="alert">&times;</button>
            	</div>
            	<?php }?>
            	<?php unset($_SESSION['ERROR_TEXT']);?>
            	<div class="row">
				  <div class="col-sm-6">
				    <fieldset id="account">
				      <!-- <legend>Thông tin cá nhân</legend> -->
				      <div class="form-group required">
				        <label class="control-label" for="input-payment-fullname">Họ và Tên</label>
				        <input type="text" name="fullname" value="<?php echo $guest_fullname; ?>" placeholder="Tên" id="input-payment-fullname" class="form-control" />
				      </div>
				      
				      <div class="form-group required">
				        <label class="control-label" for="input-payment-address-1">Địa chỉ</label>
				        <input type="text" name="address" value="<?php echo $guest_address; ?>" placeholder="Địa chỉ" id="input-payment-address" class="form-control" />
				      </div>
				    </fieldset>
				  </div>
				  <div class="col-sm-6">
				    <fieldset id="address">
				      <!-- <legend>Địa chỉ</legend> -->
				      <div class="form-group required">
				        <label class="control-label" for="input-payment-email">Email</label>
				        <input type="text" name="email" value="<?php echo $guest_email; ?>" placeholder="Email" id="input-payment-email" class="form-control" />
				      </div>
				      <div class="form-group required">
				        <label class="control-label" for="input-payment-telephone">Điện thoại</label>
				        <input type="text" name="telephone" value="<?php echo $guest_telephone; ?>" placeholder="Điện thoại" id="input-payment-telephone" class="form-control" />
				      </div>
				    </fieldset>
				  </div>
				</div>
				
            	<!-- END GUEST FORM -->
            	
            	 <!-- START SHIPPING METHOD -->
				<p><strong>Ghi chú về đơn hàng</strong></p>
				<p>
				  <textarea name="comment" rows="8" class="form-control"><?php echo $guest_comment; ?></textarea>
				</p>
				
	            <!-- END SHIPPING METHOD -->
	            
	            <!-- START CONFIRM CHECKOUT -->
				<div class="table-responsive">
				  <table class="table table-bordered table-hover">
				    <thead>
				      <tr>
				      	<th class="text-left">Ảnh</th>
				        <th class="text-left">Tên Sản Phẩm</th>
				        <th class="text-left">Model</th>
				        <th class="text-right">Số lượng</th>
				        <th class="text-right">Đơn Giá</th>
				        <th class="text-right">Tổng Giá</th>
				      </tr>
				    </thead>
				    <tbody>
				      <?php foreach (cartGetBooksWithFormat() as $book) { ?>
				      <tr>
				      	<td class="text-left"><a href="<?php echo $book['href']; ?>"><img src="<?php echo $book['thumb']; ?>" alt="<?php echo $book['name']; ?>" title="<?php echo $book['name']; ?>" class="img-thumbnail" /></a></td>
				        <td class="text-left"><?php echo $book['name']; ?></td>
				        <td class="text-left"><?php echo $book['model']; ?></td>
				        <td class="text-right"><?php echo $book['quantity']; ?></td>
				        <td class="text-right"><?php echo $book['price']; ?></td>
				        <td class="text-right"><?php echo $book['total']; ?></td>
				      </tr>
				      <?php } ?>
				    </tbody>
				    <tfoot>
				      <tr>
				        <td colspan="5" class="text-right"><strong>Tổng giá trị đơn hàng:</strong></td>
				        <td class="text-right"><?php echo cartGetTotalWithFormat(); ?></td>
				      </tr>
				      <!-- 
				      <tr>
				        <td colspan="5" class="text-right"><strong>Phí giao hàng:</strong></td>
				        <td class="text-right"><?php echo cartGetShippingFeeWithFormat(); ?></td>
				      </tr>
				       -->
				    </tfoot>
				  </table>
				</div>
	            
	            <!-- END CONFIRM CHECKOUT -->
	            <div class="buttons">
				  <div class="pull-right">
				    <input type="submit" value="Xác nhận đơn hàng" id="button-confirm" data-loading-text="Đang tải" class="btn btn-primary" />
				  </div>
				</div>
			 </form>
            </div><!-- end .panel-body -->
            
           
          </div>
        </div>
      </div>
      </div>
    </div>
</div>

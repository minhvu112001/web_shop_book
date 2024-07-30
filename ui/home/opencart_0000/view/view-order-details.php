<div class="container">
 <div style="page-break-after: always;">
  <h1>Thông Tin Hóa Đơn</h1>
   <table class="table table-bordered">
    <thead>
     <tr>
      <td colspan="2"><b>Chi Tiết Hóa Đơn</b></td>
     </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 50%;">
            <address>
            Cửa hàng <strong><?php echo storeName(); ?></strong><br />
            <?php echo storeAddress(); ?>
            </address>
            <b>Điện thoại:</b> <?php echo storeTelephone(); ?><br />
            <b>Email:</b> <?php echo storeEmail(); ?><br />
            <b>Website:</b> <a href="<?php echo storeUrl(); ?>"><?php echo storeUrl(); ?></a>
          </td>
          <td style="width: 50%;">
            <b>Ngày tạo:</b> <?php echo $order['date_added']; ?><br />
            <b>ID Đơn hàng:</b> <?php echo $order['order_id']; ?><br />
            <b>Khách hàng:</b> <?php echo $order['fullname']; ?><br />
            <b>Địa chỉ:</b> <?php echo $order['address']; ?><br />
            <b>Phương thức thanh toán:</b> Giao hàng chuyển tiền.<br />
            <b>Phương thức giao nhận:</b> Vận chuyển thông thường.<br />
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Mỗi bảng responsive phải có một thẻ div riêng để chứa -->
    <!-- Không chứa nhiều bảng trong một thẻ -->
    <div class="table-responsive">
	    <table class="table table-bordered">
	      <thead>
	        <tr>
	          <td><b>Sản Phẩm</b></td>
	          <td><b>Model</b></td>
	          <td class="text-right"><b>Số Lượng</b></td>
	          <td class="text-right"><b>Đơn Giá</b></td>
	          <td class="text-right"><b>Tổng Tiền</b></td>
	        </tr>
	      </thead>
	      <tbody>
	        <?php foreach ($order['books'] as $book) { ?>
	        <tr>
	          <td><?php echo $book['name']; ?>
	          <td><?php echo $book['model']; ?></td>
	          <td class="text-right"><?php echo $book['quantity']; ?></td>
	          <td class="text-right"><?php echo $book['price']; ?></td>
	          <td class="text-right"><?php echo $book['total']; ?></td>
	        </tr>
	        <?php } ?>
	      </tbody>
	      <tfoot>
	      	<tr>
	      		<td colspan="4" style="text-align:right"><b>Tổng giá trị đơn hàng:</b></td>
	      		<td style="text-align:right"><b><?php echo $order['total'];?></b></td>
	      	</tr>
	      </tfoot>
	    </table>
    </div>
    <?php if ($order['comment']) { ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b>Ghi Chú</b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $order['comment']; ?></td>
        </tr>
      </tbody>
    </table>
    <?php } ?>
    <div class="buttons clearfix">
      <div class="pull-right"><a href="<?php echo urlOrderHistory(); ?>" class="btn btn-primary">Tiếp Tục</a></div>
     </div>
  </div>
</div>
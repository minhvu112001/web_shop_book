<div class="container">
  <ul class="breadcrumb">
    <li><a href="<?php echo urlHome(); ?>"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="<?php echo urlCart(); ?>">Giỏ Hàng</a></li>
  </ul>
  
  <?php if (cartHasBooks()) {?>
  <div class="row">
    <div id="content" class="col-sm-12">
      <h1>Xem Giỏ Hàng</h1>
      <form action="<?php echo urlCartEdit(); ?>" method="post" enctype="multipart/form-data">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">Ảnh</th>
                <th class="text-left">Tên Sản Phẩm</th>
                <th class="text-left">Model</th>
                <th class="text-left">Số Lượng</th>
                <th class="text-right">Giá Mỗi Sản Phẩm</th>
                <th class="text-right">Tổng Tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (cartGetBooksWithFormat() as $book) { ?>
              <tr>
                <td class="text-center"><?php if ($book['thumb']) { ?>
                  <a href="<?php echo $book['href']; ?>"><img src="<?php echo $book['thumb']; ?>" alt="<?php echo $book['name']; ?>" title="<?php echo $book['name']; ?>" class="img-thumbnail" /></a>
                  <?php } ?></td>
                <td class="text-left"><a href="<?php echo $book['href']; ?>"><?php echo $book['name']; ?></a>
                  <?php if (!$book['stock']) { ?>
                  <span class="text-danger">***</span>
                  <?php } ?>
                  
                  </td>
                <td class="text-left"><?php echo $book['model']; ?></td>
                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="quantity[<?php echo $book['key']; ?>]" value="<?php echo $book['quantity']; ?>" size="1" class="form-control" />
                    <span class="input-group-btn">
                    <button type="submit" data-toggle="tooltip" title="Cập Nhật" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                    <button type="button" data-toggle="tooltip" title="Xóa Bỏ" class="btn btn-danger" onclick="cart.remove('<?php echo $book['key']; ?>');"><i class="fa fa-times-circle"></i></button></span></div></td>
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
			</tfoot>
          </table>
        </div>
      </form>
      
      <br />
      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered">
            <?php foreach ($totals as $total) { ?>
            <tr>
              <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
              <td class="text-right"><?php echo $total['text']; ?></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      
      <div class="buttons">
        <div class="pull-left"><a href="<?php echo urlHome(); ?>" class="btn btn-default">Tiếp tục mua sắm</a></div>
        <div class="pull-right"><a href="<?php echo urlCheckout(); ?>" class="btn btn-primary">Thanh toán</a></div>
      </div>
      </div>
    </div>
    <?php }else { ?>
    	<div class="row">Giỏ hàng trống</div><!-- @todo tìm ảnh empty cart quẳng vào đây -->
    <?php }?>
</div><!-- end .container -->

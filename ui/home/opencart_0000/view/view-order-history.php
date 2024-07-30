<div class="container">
  <ul class="breadcrumb">
   <li><a href="<?php echo urlHome(); ?>"><i class="fa fa-home"></i></a></li>
   <li><a href="<?php echo urlAccount(); ?>">Tài khoản</a></li>
   <li><a href="<?php echo urlOrderHistory(); ?>">Lịch sử đơn hàng</a></li>
  </ul>
  <div class="row">                
  <div id="content" class="col-sm-9">      
   <h1>Lịch Sử Đơn Hàng</h1>
   <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="text-right">ID</th>
              <th class="text-left">Ngày Tạo</th>
              <th class="text-left">Khách Hàng</th>
              <th class="text-right">Số Sản Phẩm</th>
              <th class="text-right">Tổng Giá Trị</th>
              <th class="text-center">Chi Tiết</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($orders as $order) { ?>
            <tr>
              <td class="text-right"><?php echo $order['order_id']; ?></td>
              <td class="text-left"><?php echo $order['date_added']; ?></td>
              <td class="text-left"><?php echo $order['fullname']; ?></td>
              <td class="text-right"><?php echo $order['quantity']; ?></td>
              <td class="text-right"><?php echo $order['total']; ?></td>
              <td class="text-center"><a data-original-title="Chi Tiết" href="<?php echo $order['view'];?>" data-toggle="tooltip" title="" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
    </div>
    <div class="text-right"></div>
     <div class="buttons clearfix">
      <div class="pull-right"><a href="<?php echo urlAccount(); ?>" class="btn btn-primary">Tiếp Tục</a></div>
     </div>
    </div>
   <?php include_once DIR_UI_HOME_THEMES."view/view-account-box.php" ?>
</div>
</div>
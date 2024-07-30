<div class="container">
  <ul class="breadcrumb">
        <li><a href="<?php echo urlHome(); ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="<?php echo urlAccount(); ?>">Tài khoản</a></li>
  </ul>
  <div class="row">                
  <div id="content" class="col-sm-9">      
      <h2>Tài Khoản Của Tôi (<a href="<?php echo urlAccountEdit().'?cid='.$_SESSION['CUS_LOGGED']; ?>">sửa</a>)</h2> 
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <tr>
              <th class="text-right">Email</th>
              <td class="text-left"><?php echo $email; ?></td>
            </tr>
            <tr>
              <th class="text-right">Điện Thoại</th>
              <td class="text-left"><?php echo $telephone; ?></td>
            </tr>
            <tr>
              <th class="text-right">Địa Chỉ</th>
              <td class="text-left"><?php echo $address; ?></td>
            </tr>
            <tr>
              <th class="text-right">Thành Phố</th>
              <td class="text-left"><?php echo $city; ?></td>
            </tr>
            <tr>
              <th class="text-right">Mật Khẩu</th>
              <td class="text-left">*******</td>
            </tr>
            <tr>
              
            </tr>
        </table>
      </div>
      <div class="buttons clearfix">
       <div class="pull-right"><a href="<?php echo urlHome(); ?>" class="btn btn-primary">Tiếp Tục</a></div>
      </div>
    </div>
    <?php include_once DIR_UI_HOME_THEMES."view/view-account-box.php" ?>
   </div>
</div>
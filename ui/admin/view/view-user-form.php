<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-user" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $url_cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
	    <li><a href="<?php echo urlAdmin(); ?>"><i class="fa fa-home"></i>Quản Trị</a></li>
	    <li><a href="<?php echo urlAdminUser(); ?>">Nhân Viên</a></li>
	  </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php $_SESSION['ERROR_TEXT'] = NULL;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Sửa Người Dùng Quản Trị</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-username">Tên Đăng Nhập</label>
            <div class="col-sm-10">
              <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Tên Đăng Nhập" id="input-username" class="form-control" />
              <?php if ($error_username) { ?>
              <div class="text-danger"><?php echo $error_username; ?></div>
              <?php } ?>
            </div>
          </div>
       
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-fullname">Tên</label>
            <div class="col-sm-10">
              <input type="text" name="fullname" value="<?php echo $fullname; ?>" placeholder="Tên" id="input-fullname" class="form-control" />
              <?php if ($error_fullname) { ?>
              <div class="text-danger"><?php echo $error_fullname; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-email">Email</label>
            <div class="col-sm-10">
              <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" id="input-email" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image">Ảnh</label>
            <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $user_thumb; ?>" alt="" title="" data-placeholder="<?php echo $user_placeholder; ?>" /></a>
              <input type="hidden" name="image" value="<?php echo $user_image; ?>" id="input-image" />
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-password">Mật khẩu</label>
            <div class="col-sm-10">
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="Mật khẩu" id="input-password" class="form-control" autocomplete="off" />
              <?php if ($error_password) { ?>
              <div class="text-danger"><?php echo $error_password; ?></div>
              <?php  } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-confirm">Xác nhận mật khẩu</label>
            <div class="col-sm-10">
              <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>" placeholder="Xác nhận mật khẩu" id="input-confirm" class="form-control" />
              <?php if ($error_confirm_password) { ?>
              <div class="text-danger"><?php echo $error_confirm_password; ?></div>
              <?php  } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status">Trạng thái</label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($user_status) { ?>
                <option value="0">Không cho phép</option>
                <option value="1" selected="selected">Cho phép</option>
                <?php } else { ?>
                <option value="0" selected="selected">Không cho phép</option>
                <option value="1">Cho phép</option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

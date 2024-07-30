<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo urlAdminBannerAdd(); ?>" data-toggle="tooltip" title="Thêm mới" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="confirm('Bạn có chắc muốn xóa') ? $('#form-banner').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
       <ul class="breadcrumb">
        <li><a href="<?php echo urlAdmin();?>">Quản Trị</a></li>
        <li><a href="<?php echo urlAdminBanner();?>">Banners</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?PHP $_SESSION['ERROR_TEXT']=NULL;?>
    <?php if ($_SESSION['SUCCESS_TEXT']) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $_SESSION['SUCCESS_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php $_SESSION['SUCCESS_TEXT'] = null;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Danh Sách Banner</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_delete; ?>" method="post" enctype="multipart/form-data" id="form-banner">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>">Tên banner</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>">Tên banner</a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>">Trạng thái</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>">Trạng thái</a>
                    <?php } ?></td>
                  <td class="text-right">Hành động</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($banners) { ?>
                <?php foreach ($banners as $banner) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($banner['banner_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $banner['banner_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $banner['banner_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $banner['name']; ?></td>
                  <td class="text-left"><?php echo $banner['status']; ?></td>
                  <td class="text-right">
					<a href="<?php echo $banner['edit']; ?>" data-toggle="tooltip" title="Sửa" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
					
					<!-- 
                  	Sau khi bấm vào nút xóa thì tích chọn tự động vào checkbox của bản ghi này, 
                  	rồi yêu cầu user xác nhận lại một lần nữa trước khi thực hiện xóa thực sự.
                  	Nếu user không muốn xóa nữa thì bỏ tích trên các hộp checkbox
                  	Sử dụng kĩ thuật: multiple attribute selector (jQuery) và hàm hệ thống confirm()
                  	 -->
                  	<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="$('input[name*=\'selected\'][value=\'<?php echo $banner['banner_id'];?>\']').prop('checked', true);confirm('<?php echo 'Bạn có chắc là muốn xóa'; ?>') ? $('#form-banner').submit() : false;$('input[name*=\'selected\']').prop('checked', false);"><i class="fa fa-trash-o"></i></button>
				  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="4">Không tìm thấy kết quả nào</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
        	<div class="col-sm-6 text-left"><?php echo $web_pagination_controls; ?></div>
          <div class="col-sm-6 text-right"><?php echo $web_pagination_results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

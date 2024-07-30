<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo urlAdminAuthorAdd(); ?>" data-toggle="tooltip" title="Thêm mới" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="confirm('Bạn có chắc muốn xóa') ? $('#form-author').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <ul class="breadcrumb">
        <li><a href="<?php echo urlAdmin();?>">Quản Trị</a></li>
        <li><a href="<?php echo urlAdminAuthor();?>">Tác Giả</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php $_SESSION['ERROR_TEXT']=NULL ?>
    <?php if ($_SESSION['SUCCESS_TEXT']) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $_SESSION['SUCCESS_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php $_SESSION['SUCCESS_TEXT']=NULL;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i>Các Tác Giả</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_delete; ?>" method="post" enctype="multipart/form-data" id="form-author">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-center">
                  	<a href="<?php echo $sort_author_id;?>" class="<?php if ($sort == 'author_id') {echo strtolower($order);} ?>"><?php echo 'Id.'; ?></a>
                  </td>
                  <td class="text-center"><?php echo 'Ảnh'; ?></td>
                  <td class="text-left"><?php if ($sort == 'name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>">Tác Giả</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>">Tác Giả</a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'sort_order') { ?>
                    <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>">Trật tự sắp xếp</a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_sort_order; ?>">Trật tự sắp xếp</a>
                    <?php } ?></td>
                  <td class="text-right">Hành động</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($authors) { ?>
                <?php foreach ($authors as $author) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($author['author_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $author['author_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $author['author_id']; ?>" />
                    <?php } ?>
                  </td>
                  <td>
                  	<?php echo $author['author_id'] ?>
                  </td>
                  <td class="text-center">
                    <?php if ($author['image']) { ?>
                    <img src="<?php echo $author['image']; ?>" alt="<?php echo $author['name']; ?>" class="img-thumbnail" />
                    <?php } else { ?>
                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php echo $author['name']; ?></td>
                  <td class="text-right"><?php echo $author['sort_order']; ?></td>
                  <td class="text-right">
                  	<a href="<?php echo $author['edit']; ?>" data-toggle="tooltip" title="Sửa" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  	<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger" onclick="$('input[name*=\'selected\'][value=\'<?php echo $author['author_id'];?>\']').prop('checked', true); confirm('Bạn có chắc muốn xóa') ? $('#form-author').submit() : false;$('input[name*=\'selected\']').prop('checked', false);"><i class="fa fa-trash-o"></i></button>
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
        <div class="row"><!-- Phân Trang, xem class.Paginator.php, sys.functions.php - paginate() -->
          <div class="col-sm-6 text-left"><?php echo $web_pagination_controls; ?></div>
          <div class="col-sm-6 text-right"><?php echo $web_pagination_results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

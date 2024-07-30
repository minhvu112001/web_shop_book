<div id="content">
<div class="page-header">
<div class="container-fluid">
<div class="pull-right">
<button type="submit" form="form-author" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
<a href="<?php echo $url_cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
<ul class="breadcrumb">
<li><a href="<?php echo urlAdmin(); ?>"><i class="fa fa-home"></i>Quản Trị</a></li>
<li><a href="<?php echo urlAdminAuthor(); ?>">Tác Giả</a></li>
</ul>
</div>
</div>
<div class="container-fluid">
<?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php $_SESSION['ERROR_TEXT']=NULL;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $form_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-author" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">Tên Tác Giả</label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $author_name; ?>" placeholder="Tên Tác Giả" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image">Ảnh</label>
            <div class="col-sm-10"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $author_thumb; ?>" alt="" title="" data-placeholder="<?php echo $author_placeholder; ?>" /></a>
              <input type="hidden" name="image" value="<?php echo $author_image; ?>" id="input-image" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-description">Mô tả</label>
            <div class="col-sm-10">
            	<textarea name="description" placeholder="Mô tả" id="input-description" class="form-control"><?php echo $author_description; ?></textarea>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order">Trật tự sắp xếp</label>
            <div class="col-sm-10">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="Trật tự sắp xếp" id="input-sort-order" class="form-control" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$('#input-description').summernote({height: 300});
</script> 
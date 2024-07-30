<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-banner" data-toggle="tooltip" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $url_cancel; ?>" data-toggle="tooltip" title="Hủy" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      
      <ul class="breadcrumb">
	    <li><a href="<?php echo urlAdmin(); ?>"><i class="fa fa-home"></i>Quản Trị</a></li>
	    <li><a href="<?php echo urlAdminBanner(); ?>">Banner</a></li>
	  </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($_SESION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php $_SESION['ERROR_TEXT'] = NULL;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $form_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-banner" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">Tên Banner</label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $banner_name; ?>" placeholder="Tên Banner" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status">Trạng thái</label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($banner_status) { ?>
                <option value="1" selected="selected">Cho phép</option>
                <option value="0">Không cho phép</option>
                <?php } else { ?>
                <option value="1">Cho phép</option>
                <option value="0" selected="selected">Không cho phép</option>
                <?php } ?>
              </select>
            </div>
          </div>
          <table id="images" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left">Tựa đề</td>
                <td class="text-left">Link và Mô Tả</td>
                <td class="text-left">Ảnh</td>
                <td class="text-left">Trật tự sắp xếp</td>
                <td class="text-left">Hành Động</td>
              </tr>
            </thead>
            <tbody>
              <?php $image_row = 0; ?>
              <?php foreach ($banner_images as $banner_image) { ?>
              <tr id="image-row<?php echo $image_row; ?>">
                <td class="text-left">
                    <input type="text" name="banner_image[<?php echo $image_row; ?>][title]" value="<?php echo htmlspecialchars($banner_image['title']);?>" placeholder="Tựa đề" class="form-control" />
                    <br>
                    <input type="text" name="banner_image[<?php echo $image_row; ?>][sub_title]" value="<?php echo htmlspecialchars($banner_image['sub_title']);?>" placeholder="Tựa đề phụ" class="form-control" />
                    <br>
                    <label>Giá Sản Phẩm</label>
                    <input type="number" name="banner_image[<?php echo $image_row; ?>][price]" value="<?php echo htmlspecialchars($banner_image['price']);?>" placeholder="Giá sản phẩm" class="form-control" />
                  <?php if (isset($error_banner_image)) { ?>
                  <div class="text-danger"><?php echo $error_banner_image; ?></div>
                  <?php } ?>
                </td>
                <td class="text-left" style="width: 30%;">
                	<input type="text" name="banner_image[<?php echo $image_row; ?>][link]" value="<?php echo $banner_image['link']; ?>" placeholder="Link" class="form-control" />
                	<br>
                	<textarea name="banner_image[<?php echo $image_row; ?>][description]" placeholder="Mô tả" cols="40" rows="6"><?php echo $banner_image['description']; ?></textarea>
               	</td>
                <td class="text-left">
                  <a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail">
                  		<img src="<?php echo $banner_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $banner_placeholder; ?>" />
                  </a>
                  <input type="hidden" name="banner_image[<?php echo $image_row; ?>][image]" value="<?php echo $banner_image['image']; ?>" id="input-image<?php echo $image_row; ?>" />
                </td>
                <td class="text-right">
                	<input type="text" name="banner_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $banner_image['sort_order']; ?>" placeholder="Trật tự sắp xếp" class="form-control" />
                </td>
                <td class="text-left">
                	<button type="button" onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="Gỡ bỏ" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                </td>
              </tr>
              <?php $image_row++; ?>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4"></td>
                <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Thêm mới" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
    html += '  <td class="text-left">';
	html += '      <input type="text" name="banner_image[' + image_row + '][title]" value="" placeholder="Tựa đề" class="form-control" /><br>';
	html += '      <input type="text" name="banner_image[' + image_row + '][sub_title]" value="" placeholder="Tựa đề phụ" class="form-control" /><br>';
	html += '  	   <label>Giá sản phẩm</label>';
	html += '      <input type="number" name="banner_image[' + image_row + '][price]" value="" placeholder="Giá sản phẩm" class="form-control" />';	
	html += '  </td>';	
	html += '  <td class="text-left">';
	html += '  	   <input type="text" name="banner_image[' + image_row + '][link]" value="" placeholder="Link" class="form-control" /><br>';
	html += '      <textarea name="banner_image[' + image_row + '][description]" placeholder="Mô tả" cols="40" rows="6"></textarea>';
	html += '  </td>';		
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $banner_placeholder; ?>" alt="" title="" data-placeholder="<?php echo $banner_placeholder; ?>" /></a><input type="hidden" name="banner_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="banner_image[' + image_row + '][sort_order]" value="" placeholder="Trật tự sắp xếp" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Gỡ bỏ" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#images tbody').append(html);
	
	image_row++;
}
</script></div>

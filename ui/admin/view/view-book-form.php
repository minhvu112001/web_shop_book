<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-book" data-toggle="tooltip" title="<?php echo 'Lưu'; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo urlAdminBook(); ?>" data-toggle="tooltip" title="<?php echo 'Hủy'; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      
      <ul class="breadcrumb">
        <li><a href="<?php echo urlAdmin(); ?>">Quản Trị</a></li>
        <li><a href="<?php echo urlAdminBook(); ?>">Sách</a></li>
        <li><a href="<?php echo urlAdminBookAdd(); ?>">Thêm Mới</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($_SESSION['ERROR_TEXT']) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['ERROR_TEXT']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php unset($_SESSION['ERROR_TEXT']);?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $form_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $url_action; ?>" method="post" enctype="multipart/form-data" id="form-book" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Thông Tin Sản Phẩm</a></li>
            <li><a href="#tab-links" data-toggle="tab">Liên Kết</a></li>
            <li><a href="#tab-image" data-toggle="tab">Ảnh</a></li>
          </ul>
          
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              
                <div class="tab-pane" id="language">
                  <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-image">Ảnh</label>
	                <div class="col-sm-10"><!-- @see admin/src/js/common.js để xem cách quản lý file ảnh:  -->
	                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $book_thumb; ?>" alt="" title="" data-placeholder="<?php echo $book_image_placeholder; ?>" /></a>
	                  <input type="hidden" name="image" value="<?php echo $book_image; ?>" id="input-image" />
	                </div>
	              </div> 
	              
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name">Tên</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="<?php echo $book_name; ?>" placeholder="Tên sản phẩm" id="input-name" class="form-control" />
                      <?php if (isset($error_name)) { ?>
                      <div class="text-danger"><?php echo $error_name; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-model">Model</label>
	                <div class="col-sm-10">
	                  <input type="text" name="model" value="<?php echo $book_model; ?>" placeholder="Model" id="input-model" class="form-control" />
	                  <?php if ($error_model) { ?>
	                  <div class="text-danger"><?php echo $error_model; ?></div>
	                  <?php } ?>
	                </div>
	              </div>
	              
	              <div class="form-group">
	                <label class="col-sm-2 control-label" for="input-price">Giá</label>
	                <div class="col-sm-10">
	                  <input type="text" name="price" value="<?php echo $book_price; ?>" placeholder="Giá" id="input-price" class="form-control" />
	                </div>
	              </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description">Mô tả</label>
                    <div class="col-sm-10">
                      <textarea name="description" placeholder="Mô tả" id="input-description"><?php echo $book_description; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-tag"><span data-toggle="tooltip" title="Dùng dấu phẩy để ngăn cách">Tags</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="tag" value="<?php echo $book_tag; ?>" placeholder="Tags" id="input-tag" class="form-control" />
                    </div>
                  </div>
                             
              
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">Trạng thái</label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($book_status) { ?>
                    <option value="1" selected="selected">Cho phép</option>
                    <option value="0">Không cho phép</option>
                    <?php } else { ?>
                    <option value="1">Cho phép</option>
                    <option value="0" selected="selected">Không cho phép</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">Thứ Tự Sắp Xếp</label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $book_sort_order; ?>" placeholder="Sort Order" id="input-sort-order" class="form-control" />
                </div>
              </div>
                  
                  
                </div>
              
            </div>
            
            <div class="tab-pane" id="tab-links">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-publisher"><span data-toggle="tooltip" title="(Autocomplete)">Nhà Xuất Bản</span></label>
                <div class="col-sm-10">
                  <input type="text" name="publisher" value="<?php echo $publisher ?>" placeholder="Nhà sản xuất" id="input-publisher" class="form-control" />
                  <input type="hidden" name="publisher_id" value="<?php echo $publisher_id; ?>" />
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-author"><span data-toggle="tooltip" title="(Autocomplete)">Tác Giả</span></label>
                <div class="col-sm-10">
                  <input type="text" name="author" value="<?php echo $author ?>" placeholder="Tác Giả" id="input-publisher" class="form-control" />
                  <input type="hidden" name="author_id" value="<?php echo $author_id; ?>" />
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="(Autocomplete)">Loại sản phẩm</span></label>
                <div class="col-sm-10">
                  <input type="text" name="category" value="" placeholder="Loại sản phẩm" id="input-category" class="form-control" />
                  <div id="book-category" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($book_categories as $book_category) { ?>
                    <div id="book-category<?php echo $book_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $book_category['name']; ?>
                      <input type="hidden" name="book_category[]" value="<?php echo $book_category['category_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-related"><span data-toggle="tooltip" title="(Autocomplete)">Sản phẩm liên quan</span></label>
                <div class="col-sm-10">
                  <input type="text" name="related" value="" placeholder="Sản phẩm liên quan" id="input-related" class="form-control" />
                  <div id="book-related" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($book_relateds as $book_related) { ?>
                    <div id="book-related<?php echo $book_related['book_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $book_related['name']; ?>
                      <input type="hidden" name="book_related[]" value="<?php echo $book_related['book_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            
            
            <div class="tab-pane" id="tab-image">
              <div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Ảnh</td>
                      <td class="text-right">Thứ tự sắp xếp</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $image_row = 0; ?>
                    <?php foreach ($book_images as $book_image) { ?>
                    <tr id="image-row<?php echo $image_row; ?>">
                      <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $book_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $book_image_placeholder; ?>" /></a><input type="hidden" name="book_image[<?php echo $image_row; ?>][image]" value="<?php echo $book_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                      <td class="text-right"><input type="text" name="book_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $book_image['sort_order']; ?>" placeholder="Trật tự sắp xếp" class="form-control" /></td>
                      <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="Gỡ bỏ" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $image_row++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Thêm mới" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
// Rich Text Editor
$('#input-description').summernote({height: 300});
</script> 
  <script type="text/javascript">
// Nhà sản xuất / Publisher
$('input[name=\'publisher\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '<?php echo urlAdminPublisherAutocomplete(); ?>?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				json.unshift({
					publisher_id: 0,
					name: '---Không---'
				});
				
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['publisher_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'publisher\']').val(item['label']);
		$('input[name=\'publisher_id\']').val(item['value']);
	}	
});

// Tác giả author
$('input[name=\'author\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '<?php echo urlAdminAuthorAutocomplete(); ?>?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				json.unshift({
					publisher_id: 0,
					name: '---Không---'
				});
				
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['author_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'author\']').val(item['label']);
		$('input[name=\'author_id\']').val(item['value']);
	}	
});

// Loại sản phẩm / Category
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '<?php echo urlAdminCategoryAutocomplete()?>?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			},
			error: function(xhr, status, text) {
		        //alert(status);
		        //alert(text)
		        alert(xhr.responseText);
		    }
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');
		
		$('#book-category' + item['value']).remove();
		
		$('#book-category').append('<div id="book-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="book_category[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#book-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

// Sản phẩm liên quan / Related Books
$('input[name=\'related\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '<?php echo urlAdminBookAutocomplete()?>?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['book_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'related\']').val('');
		
		$('#book-related' + item['value']).remove();
		
		$('#book-related').append('<div id="book-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="book_related[]" value="' + item['value'] + '" /></div>');	
	}	
});

$('#book-related').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
</script> 

  <script type="text/javascript">
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $book_image_placeholder; ?>" alt="" title="" data-placeholder="<?php echo $book_image_placeholder; ?>" /><input type="hidden" name="book_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="book_image[' + image_row + '][sort_order]" value="" placeholder="Trật tự sắp xếp" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Gỡ bỏ" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#images tbody').append(html);
	
	image_row++;
}
</script> 
  <script type="text/javascript">
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
</script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
$('#option a:first').tab('show');
//--></script></div>

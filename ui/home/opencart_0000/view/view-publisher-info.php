<div class="container">
  <ul class="breadcrumb">
    <li><a href="<?php echo urlHome();?>"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="<?php echo urlBookPublisher();?>">Thương Hiệu</a></li>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h2><?php echo $publisher_name; ?></h2>
      <?php if ($manu_books) { ?>
      <p><a href="<?php echo $compare; ?>" id="compare-total"> <?php echo $text_compare; ?></a></p>
      <div class="row">
        <div class="col-sm-3">
          <div class="btn-group hidden-xs">
            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
          </div>
        </div>
        <div class="col-sm-1 col-sm-offset-2 text-right">
          <label class="control-label" for="input-sort">Xếp theo</label>
        </div>
        <div class="col-sm-3 text-right">
          <select id="input-sort" class="form-control col-sm-3" onchange="location = this.value;">
            <?php foreach ($manu_sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-1 text-right">
          <label class="control-label" for="input-limit">Hiện</label>
        </div>
        <div class="col-sm-2 text-right">
          <select id="input-limit" class="form-control" onchange="location = this.value;">
            <?php foreach ($manu_limits as $limits) { ?>
            <?php if ($limits['value'] == $limit) { ?>
            <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <br />
      <div class="row">      
        <?php foreach ($manu_books as $book) { ?>
        <div class="book-layout book-list col-xs-12">
          <div class="book-thumb">
            <div class="image"><a href="<?php echo $book['href']; ?>"><img src="<?php echo $book['thumb']; ?>" alt="<?php echo $book['name']; ?>" title="<?php echo $book['name']; ?>" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="<?php echo $book['href']; ?>"><?php echo $book['name']; ?></a></h4>
              <p><?php echo $book['description']; ?></p>
              
              <p class="price">
                <?php echo $book['price']; ?>
              </p>
            </div>
            <div class="button-group">
              <button type="button" onclick="cart.add('<?php echo $book['book_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Giỏ hàng</span></button>
              <button type="button" data-toggle="tooltip" title="Whishlist" onclick="wishlist.add('<?php echo $book['book_id']; ?>');"><i class="fa fa-heart"></i></button>
              <button type="button" data-toggle="tooltip" title="So sánh sản phẩm" onclick="compare.add('<?php echo $book['book_id']; ?>');"><i class="fa fa-exchange"></i></button>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="row">
      	<div class="col-sm-6 text-left"><?php echo $web_pagination_controls; ?></div>
          <div class="col-sm-6 text-right"><?php echo $web_pagination_results; ?></div>
      </div>
      <?php } else { ?>
      <p>Không tìm thấy kết quả nào</p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo urlHome(); ?>" class="btn btn-primary">Tiếp tục</a></div>
      </div>
      <?php } ?>
      </div>
    </div>
</div>

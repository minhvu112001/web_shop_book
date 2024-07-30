<div class="container">
  <ul class="breadcrumb">
    <li> <a href="<?php echo urlHome(); ?>"><i class="fa fa-home"></i>Trang Chủ</a> </li>
    <li> <a href="<?php echo urlBookPublisher(); ?>">Thương Hiệu</a> </li>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-12">
      <h1>Tìm thương hiệu bạn yêu thích</h1>
      <?php if ($publishers) { ?>
      <p><strong>Danh mục thương hiệu</strong>
        <?php foreach ($publishers as $brand) { ?>
        &nbsp;&nbsp;&nbsp;<a href="<?php echo urlBookPublisher().'#'.$brand['name']; ?>"><?php echo $brand['name']; ?></a>
        <?php } ?>
      </p>
      <?php foreach ($publishers as $brand) { ?>
      <h2 id="<?php echo $brand['name']; ?>"><?php echo $brand['name']; ?></h2>
      <?php if ($brand['publisher']) { ?>
      <?php foreach (array_chunk($brand['publisher'], 4) as $publishers) { ?>
      <div class="row">
        <?php foreach ($publishers as $publisher) { ?>
        <div class="col-sm-3"><a href="<?php echo $publisher['href']; ?>"><?php echo $publisher['name']; ?></a></div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php } ?>
      <?php } ?>
      <?php } else { ?>
      <p>Không tìm thấy thương hiệu nào</p>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="<?php echo urlHome();?>" class="btn btn-primary">Tiếp tục</a></div>
      </div>
      <?php } ?>
      </div>
    </div>
</div>

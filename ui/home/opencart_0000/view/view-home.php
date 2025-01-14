<div class="container">
    <div class="row">
        <div id="content" class="col-sm-12">
             <!-- 
             SLIDE SHOW BANNER TO VÀ DÀI Ở TRANG CHỦ (đang bị lỗi khi thu nhỏ)
             phải xóa đi nhiều mã html sinh ra ở bản lưu từ IE về thì slide mới chạy được. 
             -->
             <div id="slideshow0" class="flexslider">
             	<ul class="slides" style="width: 400%; transition-duration: 0.6s; transform: translate3d(-1132px, 0px, 0px);">
                <?php foreach (homeSlideshowBanners() as $banner) { ?>
					<li style="width: 1132px; float: left; display: block;">
						<?php if ($banner['link']) { ?>
						<a href="<?php echo $banner['link']; ?>">
							<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
						</a>
						<?php } else { ?>
						<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
						<?php } ?>
					</li>
				<?php } ?>
            	</ul>
            </div>
            <script type="text/javascript">
                $('#slideshow0').flexslider({
                    animation: 'slide',
                    animationLoop: true,
                    itemWidth: 1140
                });
            </script>
            
            <!-- START LOẠI SẢN PHẨM GIỚI THIỆU -->
            <h3>Danh Mục Hot</h3>
		    <div class="row"  style="border-bottom: #ddd solid 1px;">
		    	<?php foreach (categoryGetByModule('banner_categories') as $category) { ?>
				<div class="col-sm-4">
					<a href="<?php echo $category['href']; ?>">
					<img src="<?php echo $category['thumb']; ?>" alt="banner-3" title="banner-3" width="<?php echo $category['width']?>" height="<?php echo $category['height']?>" style="transition: all 0.5s ease;z-index: -100">
					<div class="s-desc" style="">
						<h1><?php echo $category['name']; ?></h1>
					</div>
					</a>
				</div>
				<?php } ?>
		    </div>
		    <!-- END LOẠI SẢN PHẨM GIỚI THIỆU -->
		    
		    <!-- START SẢN PHẨM NỔI BẬT -->
		    <h3>Ấn Phẩm Nổi Bật</h3>
            <div class="row book-layout">
			    <?php foreach (booksFeatured() as $book) { ?>                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="book-thumb transition">
                        <div class="image">
                            <a href="<?php echo $book['href']; ?>">
                            	<img src="<?php echo $book['thumb']; ?>" alt="<?php echo $book['name']; ?>" title="<?php echo $book['name']; ?>" class="img-responsive">
                            </a>
                        </div>
                        <div class="caption">
                            <h4><a href="<?php echo $book['href']; ?>"><?php echo $book['name']; ?></a></h4>
                            <p><?php echo $book['description']; ?></p>
                            <p class="price">
                                <span class="price-new"><?php echo $book['price']; ?></span> 
                                <!-- 
                                <span class="price-old">$122.00</span>
                                <span class="price-tax">Ex Tax: $80.00</span>
                                 -->
                            </p>
                        </div>
                        <div class="button-group">
                            <button type="button" onclick="cart.add('<?php echo $book['book_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Thêm vào giỏ</span></button>
                            <button type="button" data-toggle="tooltip" title="" onclick="alert('đang xây dựng...');//wishlist.add('30');" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                            <button type="button" data-toggle="tooltip" title="" onclick="alert('đang xây dựng...');//compare.add('30');" data-original-title="Compare this Book"><i class="fa fa-exchange"></i></button>
                        </div>
                    </div>
                </div>
                <?php }  ?>
            </div>
            
             <!-- SLIDE SHOW ẢNH LOGO CÁC HÃNG SẢN XUẤT -->
             <h3>Nhà Xuất Bản</h3>
             <div id="carousel0" class="flexslider carousel">
                    <ul class="slides" style="width: 2200%; transition-duration: 0.6s; transform: translate3d(-1540px, 0px, 0px);">
                        
                        <?php foreach (homeCarouselBanners() as $banner) { ?>
                        <li style="width: 208px; float: left; display: block;">
						    <?php if ($banner['link']) { ?>
						    <a href="<?php echo $banner['link']; ?>">
						    	<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" draggable="false" />
						    </a>
						    <?php } else { ?>
						    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" draggable="false"/>
						    <?php } ?>
						  <?php } ?>
						 </li>
                    </ul>
            </div>
            
            <script type="text/javascript">
                $(window).load(function() {
                    $('#carousel0').flexslider({
                        animation: 'slide',
                        itemWidth: 130,
                        itemMargin: 100,
                        minItems: 2,
                        maxItems: 4
                    });
                });
            </script>
            
            <!-- Google Map -->
			<div style="height: 450px;position: relative; background-color: rgb(229, 227, 223); overflow: hidden;" id="google-map" class="col-sm-12">
			</div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(function() {
    $("#google-map").googleMap({
      zoom: 15, // Initial zoom level (optional) zoom scale: [0 5 10 15 20]
      coords: [21.035672,105.818939], // Map center (optional)
      type: "ROADMAP" // Map type (optional) // SATELLITE
    });
	
    $("#google-map").addMarker({
      coords: [21.035672,105.818939],	// 285 Đội Cấn. Ba Đình. Hà Nội.
      //icon: '/<?php echo APP?>/themes/image/gmap_marker.png', // Icon tùy biến
      url: 'http://apple.com' // Link URL
    });
	
	// Add a route
	$("#google-map").addWay({
    	start: "Tòa nhà Aptech,285 Đội Cấn,Ba Đình,Hà Nội, Việt Nam", // Postal address for the start marker (obligatory)
		//start: [21.035672,105.818939], // Postal address for the start marker (obligatory) (doesn't work!!!)
		end:  [20.985158, 105.842896], // Postal Address or GPS coordinates for the end marker (obligatory)
		route : 'way', // Block's ID for the route display (optional)
		langage : 'english' // language of the route detail (optional)
	});
	
	$("#google-map").addMarker({
      coords: [20.985158, 105.842896],	// 43 Kim Đồng, Giáp Bát, Hoàng Mai, Hà Nội, Việt Nam
      //icon: '/<?php echo APP?>/themes/image/gmap_marker.png', // Icon tùy biến
      url: 'http://apple.com' // Link URL
    });
  });	
</script>
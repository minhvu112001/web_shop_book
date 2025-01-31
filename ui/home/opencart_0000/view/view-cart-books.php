<div id="cart" class="btn-group btn-block">
  <button type="button" data-toggle="dropdown" data-loading-text="Đang tải..." class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i class="fa fa-shopping-cart"></i> <span id="cart-total"><?php echo cartGetTextCountAndTotal(); ?></span></button>
  <ul class="dropdown-menu pull-right">
    <li>
      <table class="table table-striped">
        <?php foreach (cartGetBooksWithFormat() as $book) { ?>
        <tr>
          <td class="text-center"><?php if ($book['thumb']) { ?>
            <a href="<?php echo $book['href']; ?>"><img src="<?php echo $book['thumb']; ?>" alt="<?php echo $book['name']; ?>" title="<?php echo $book['name']; ?>" class="img-thumbnail" /></a>
            <?php } ?></td>
          <td class="text-left"><a href="<?php echo $book['href']; ?>"><?php echo $book['name']; ?></a>
          
          <td class="text-right">x <?php echo $book['quantity']; ?></td>
          <td class="text-right"><?php echo $book['total']; ?></td>
          <td class="text-center"><button type="button" onclick="cart.remove('<?php echo $book['key'];?>');" title="Gỡ bỏ" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
        </tr>
        <?php } ?>
      </table>
    </li>
    <li>
      <div>
        <table class="table table-bordered">
          <tr>
            <td class="text-right"><strong>Tổng giá trị:</strong></td>
            <td class="text-right"><?php echo cartGetTotalWithFormat(); ?></td>
          </tr>
        </table>
        <p class="text-right"><a href="<?php echo urlCart(); ?>"><strong><i class="fa fa-shopping-cart"></i> Xem giỏ hàng</strong></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo urlCheckout(); ?>"><strong><i class="fa fa-share"></i> Thanh Toán</strong></a></p>
      </div>
    </li>
  </ul>
</div>

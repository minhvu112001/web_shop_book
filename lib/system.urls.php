<?php

/* URL function convention:
 basically, we should write url function name with the syntax
 	/web/admin/module-name.php
 	 
 But in some special cases, we all understand that the module is under 'admin',
 so we can ignore the parent 'admin' in url, example:
 	function urlAdminCategoryAdd() {...}
 
@todo Anyway, to make things simple and less-confused. We should use an explicit and clear
 name for the url function. Like: every url related to 'admin' module must
 has the format:
 	/web/admin/sub-module.php
 
 No More Confused !!!
 	
*/
// relative path to web iconic image (*.ico) displayed on web browser's tab.

function urlIcon()
{
	return URL_IMAGE. settings('config_icon');
}

function urlAdmin()
{
	return "/".APP."/admin.php";
}

function urlAdminLogout()
{
	return "/".APP."/admin-logout.php";
}

function urlAdminSignout()
{
	return urlAdminLogout();
}

function urlLogoutAdmin()
{
	return urlAdminLogout();
}

function urlSignoutAdmin()
{
	return urlAdminLogout();
}

function urlAdminDashboard()
{
	return "/".APP."/admin/dashboard.php";
}

function urlAdminCategory()
{
	return "/".APP."/admin/category.php";
}

function urlAdminCategoryAdd()
{
	return "/".APP."/admin/category-add.php";
}

function urlAdminCategoryEdit()
{
	return "/".APP."/admin/category-edit.php";
}

function urlAdminCategoryDelete()
{
	return "/".APP."/admin/category-delete.php";
}

function urlAdminCategoryAutocomplete()
{
	return "/".APP."/admin/category-autocomplete.php";
}

function urlAdminBook()
{
	return "/".APP."/admin/book.php";
}

function urlAdminBookAdd()
{
	return "/".APP."/admin/book-add.php";
}

function urlAdminBookEdit()
{
	return "/".APP."/admin/book-edit.php";
}

function urlAdminBookDelete()
{
	return "/".APP."/admin/book-delete.php";
}

function urlAdminBookCopy()
{
	return "/".APP."/admin/book-copy.php";
}

function urlAdminBookAutocomplete()
{
	return "/".APP."/admin/book-autocomplete.php";
}

function urlAdminPublisher()
{
	return "/".APP."/admin/publisher.php";
}

function urlAdminPublisherAdd()
{
	return "/".APP."/admin/publisher-add.php";
}

function urlAdminPublisherEdit()
{
	return "/".APP."/admin/publisher-edit.php";
}

function urlAdminPublisherDelete()
{
	return "/".APP."/admin/publisher-delete.php";
}

function urlAdminPublisherAutocomplete()
{
	return "/".APP."/admin/publisher-autocomplete.php";
}

function urlAdminAuthor()
{
	return "/".APP."/admin/author.php";
}

function urlAdminAuthorAdd()
{
	return "/".APP."/admin/author-add.php";
}

function urlAdminAuthorEdit()
{
	return "/".APP."/admin/author-edit.php";
}

function urlAdminAuthorDelete()
{
	return "/".APP."/admin/author-delete.php";
}

function urlAdminAuthorAutocomplete()
{
	return "/".APP."/admin/author-autocomplete.php";
}

function urlAdminSettingEdit()
{
	return "/".APP."/admin/setting-edit.php";
}

function urlAdminUser()
{
	return "/".APP."/admin/user.php";
}

function urlAdminUserAdd()
{
	return "/".APP."/admin/user-add.php";
}

function urlAdminUserEdit()
{
	return "/".APP."/admin/user-edit.php";
}          

function urlAdminUserDelete()
{
	return "/".APP."/admin/user-delete.php";
}

function urlAdminFilemanager()
{
	return "/".APP."/admin/filemanager.php";
}

function urlAdminFilemanagerDelete()
{
	return "/".APP."/admin/filemanager-delete.php";
}

function urlAdminFilemanagerFolder()
{
	return "/".APP."/admin/filemanager-folder.php";
}

function urlAdminFilemanagerUpload()
{
	return "/".APP."/admin/filemanager-upload.php";
}

function urlAdminModuleFeatured()
{
	return "/".APP."/admin/module/featured.php";
}

function urlAdminModuleBestSeller()
{
	return "/".APP."/admin/module/best_seller.php";
}

function urlAdminModuleSpecials()
{
	return "/".APP."/admin/module/specials.php";
}

function urlAdminModuleLatest()
{
	return "/".APP."/admin/module/latest.php";
}

function urlAdminModuleBannerBooks()
{
	return "/".APP."/admin/module/banner_books.php";
}

function urlAdminModuleBannerCategories()
{
	return "/".APP."/admin/module/banner_categories.php";
}

function urlAdminModule()
{
	return "/".APP."/admin/module.php";
}
function urlAdminModuleBanner()
{
	return "/".APP."/admin/module/banner.php";
}

function urlAdminModuleSlideshow()
{
	return "/".APP."/admin/module/slideshow.php";
}

function urlAdminModuleCarousel()
{
	return "/".APP."/admin/module/carousel.php";
}

function urlAdminBanner()
{
	return "/".APP."/admin/banner.php";
}

function urlAdminBannerAdd()
{
	return "/".APP."/admin/banner-add.php";
}

function urlAdminBannerDelete()
{
	return "/".APP."/admin/banner-delete.php";
}

function urlAdminBannerEdit()
{
	return "/".APP."/admin/banner-edit.php";
}

function urlAdminOrder()
{
	return "/".APP."/admin/order.php";
}

function urlAdminCustomer()
{
	return "/".APP."/admin/customer.php";
}

function urlAdminCustomerAutocomplete()
{
	return "/".APP."/admin/customer-autocomplete.php";
}

function urlAdminCustomerAdd()
{
	return "/".APP."/admin/customer-add.php";
}

function urlAdminCustomerEdit()
{
	return "/".APP."/admin/customer-edit.php";
}

function urlAdminCustomerDelete()
{
	return "/".APP."/admin/customer-delete.php";
}

function urlAdminOrderAdd()
{
	return "/".APP."/admin/order-add.php";
}

function urlAdminOrderInvoice()
{
	return "/".APP."/admin/order-invoice.php";
}

function urlAdminOrderDelete()
{
	return "/".APP."/admin/order-delete.php";
}

function urlAdminOrderInfo()
{
	return "/".APP."/admin/order-info.php";
}

function urlAdminLogin()
{
	return "/".APP."/admin-login.php";
}

function urlImgStoreLogo()
{
	return URL_IMAGE.settings('config_logo');
}

	/* Home's URLs */
function urlHome()
{
	return "/".APP;
}

function urlBookDetails()
{
	return "/".APP."/book-details.php";
}

function urlSearch()
{
	return "/".APP."/search.php";
}

function urlBookSearch()
{
	return urlSearch();
}

function urlSearchBook()
{
	return urlSearch();
}

function urlBookCategory()
{
	return "/".APP."/book-category.php";
}

function urlPublisherInfo()
{
	return "/".APP."/publisher-info.php";
}

function urlPublisherList()
{
	return "/".APP."/publisher-list.php";
}

function urlBookPublisher()
{
	return "/".APP."/book/publisher.php";
}

function urlCartAdd()
{
	return "/".APP."/cart-add.php";
}

function urlCartRemove()
{
	return "/".APP."/cart-remove.php";
}

function urlCartEdit()
{
	return "/".APP."/cart-edit.php";
}

function urlCart()
{
	return "/".APP."/cart.php";
}

function urlShoppingCart()
{
	return urlCart();
}

function urlCheckout()
{
	return "/".APP."/checkout.php";
}

function urlCartAjax()
{
	return "/".APP."/cart-ajax.php";
}

function urlAccount()
{
	return "/".APP."/account.php";
}

// @todo account-register.php
// account-edit.php
// account-authenticate.php

function urlRegister()
{
	return "/".APP."/register.php";
}

function urlRegisterAccount()
{
	return urlRegister();
}

function urlCreateAccount()
{
	return urlRegister();
}

function urlAccountEdit()
{
	return "/".APP."/account-edit.php";
}

function urlLogin()
{
	return "/".APP."/login.php";
}

function urlLogout()
{
	return "/".APP."/logout.php";
}

function urlOrderHistory()
{
	return "/".APP."/order-history.php";
}

function urlOrderDetails()
{
	return "/".APP."/order-details.php";
}


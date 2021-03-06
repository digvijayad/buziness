<?php
	$css = '.main-navigation #primary-menu.menu li.current_page_item, 
.main-navigation #primary-menu.menu li.current-menu-ancestor{
	border-bottom: 4px solid #f7c651;
}

/*#f7c651*/
.main-navigation #primary-menu.menu li ul li.current-menu-item{
	background: #f7c651;
}
.main-navigation #primary-menu.menu li:hover{
	border-bottom: 4px solid #f7c651;
}

.main-navigation a { 
	color: #555;
}

.main-navigation li:hover > a, .main-navigation li.focus > a {
	color: #f7c651; 
}
.main-navigation ul ul li:hover > a, .main-navigation ul ul li.focus > a {
	color: #000; 
	background: #f7c651;
}
.main-navigation ul ul a {
    color: #fff;
}
.main-navigation ul ul a:hover {

    background: #f7c651;
    color: #fff;
}

li:hover.menu-item-has-children:after {
    color: #f7c651;
}

.nav-menu li li.menu-item-has-children > a:after {
 color: #222;
 }

 .main-navigation li.current_page_ancestor ul a {
	color:#fff;
}

.main-navigation ul ul li.current_page_item > a {
    color: #fff;
    background: #f7c651;
}

.main-navigation li.current_page_ancestor a {
	color:#f7c651;
}
.main-navigation .current_menu_ancestor a {
	color:#f7c651;
}

header.site-header {
	background: #fff;
}

.main-navigation .menu-cta-button a{

	background-color:  #f7c651;
}

.main-navigation .menu-cta-button a:hover {
	color: #f7c651 !important;
	background-color: #000;
}

#nav-icon span {
  background: #fbd849;
}

#drop::before,#drop::after{
  background: #000;
}
a {
    color: #555;
}

a:hover {
    color: #f7c651;
}

input[type="submit"]{
	background-color: #f7c651;
}

input[type="submit"]:hover{
	background-color: #000;
	color: #f7c651;
}
.entry-title a {
    color: #373b44;
}
.entry-title a:hover {
    color: #73c8a9;
}
.title h2 {
	color: #555;
}
.title h2:after {

	background: #f7c651;
}
.title p {
	color: #777;
}

.counter-area .title h2{
	color: #fff;
}
.counter-area .title h2:after {
	background: #f7c651;
}
.counter-number, .counter-prefix, .counter-description{
	color: #fff;
}

.cta-block h2, .cta-block p {
	color: #fff;
}
.dtl a {
	border-color: #fff;
	color: #fff;
}
.cta .dtl a:hover {
	background: #f7c651;
	color: #fff;
}

.blog-block:hover .blog-desc h4 a{
	color: #3498db; 
} 
.blog-desc h4 a:hover{
	color: #3498db !important; 
	background-color:#fff;
}

.entry-content a:hover {
    color: #000;
    background: #f7c651;
    border-color:  #f7c651;
}

.entry-content a{
	color: #555;
	border-color: #555;
}
.entry-footer a {
    color: #000;
    background: #f7c651;
}
.nav-links a {
    background: #f7c651;
    color: #000;
}

.footer-area-top {
	background-color: #000;
}
.footer-area-top .contact-name{
	color: #f7c651;
}

.footer-area-top .widget-resources a{
	color: #f7c651;
}
.footer-area-top .contacts li i {
  
    color: #f7c651;
}
.footer-area-top .footer-box{
	color: #fff;
}
.footer-area-bottom{
	background: #f7c651; 
	color: #fff;
}

.main-banner{

	background: #fff;
}

.offer .description p {
	color: #777;
	}

.offer .button-container a {
	    color: #5472D2;
}
.search-form span i:hover { 
	color: #3498db;
}
.widget_search .search-form input[type="search"] {
	background: #fff;
	border-color:  #eee;
	color: #fff;
} 

.widget_search .search-form input[placeholder] {
	color: #666;
}

h2.widget-title {
	color: #555; 
}
h2.widget-title:after {
	background: #f7c651;
}

.widget ul li {

	border-bottom-color: #ccc;

}
.widget ul li a {
	color: #777;
}

.widget ul li a:hover {
	color: #3498db;
	
}

.calendar_wrap td {
    background: #f4f4f4;
}

.calendar_wrap td, .calender_wrap th , .calender_wrap caption{
	border-color: #ccc;
}

.calendar_wrap td a {
	color: #777;
	}
.breadcrumb-title{
	color: #fff;
}

@media screen and (max-width: 990px){


	ul.submenu li.menu-item:hover, ul li.menu-item:hover{
		background: #f7c651;
	}

	ul.submenu li.menu-item:hover > a, ul li.menu-item:hover > a{
		color: #000;
	}

	ul li.menu-item, .bz-menuwrapper ul li { 
		border-top-color:  #444; 
	}

	.bz-menuwrapper ul, ul.bz-menu{
		background: #333;
	}

	.bz-menuwrapper ul li a, li.menu-item a {
		color: #fff;
		/*color: #000;*/
	}

	.bz-menuwrapper ul li:hover, ul.submenu li.menu-item:hover, ul li.menu-item:hover{
		/*background: #f7c651;*/
	    /*color: #000;*/
	}

	ul.bz-menu{
		/*background: #333;*/
	}

	ul li.menu-item:hover {
	    /*background: #3498db;*/
	    /*color: #fff;*/
	}

	li.menu-item a {
		/*color: #fff;*/
	}
	.bz-menuwrapper ul li{
		/*border-top-color: #444;*/
	}
}';
wp_add_inline_style( 'buziness-style', $css );
?>

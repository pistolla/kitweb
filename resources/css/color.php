<?php
header ("Content-Type:text/css");
$color = "#ea0117"; // Change your Color Here

function checkhexcolor($color) {
  return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
  $color = "#" . $_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
  $color = "#ea0117";
}

?>

.submit-btn{
	background-color: <?php echo $color; ?>;
	border: 2px solid <?php echo $color; ?>;
}
.boxed-btn, .btn-rounded{
	background-color: <?php echo $color; ?>;
}

.btn.btn-block.btn-submit:hover {
	background-color: #223245;
	color: <?php echo $color; ?>;
	border: 2px solid <?php echo $color; ?>;
}
.card {border: 2px solid <?php echo $color; ?>;}
.card-header {
	background-color:  <?php echo $color; ?>;
	border: 2px solid <?php echo $color; ?>;
}
.table {border: 2px solid <?php echo $color; ?>;}

.table th {
	color: <?php echo $color; ?>;
	padding: 16px;
}
.navbar-area.nav-fixed{background-color: <?php echo $color; ?>;}
.contact-page-container{ padding:25px;}


.navbar-area .right-btn-wrapper .boxed-btn:hover {
	background-color: #fff;
	color: <?php echo $color; ?>;
}

.boxed-btn:hover {
	color: <?php echo $color; ?>;
	background-color: #fff;
}
.video-area .video-area-content .btn-wrapper .boxed-btn:hover {
	border: 1px solid <?php echo $color; ?>;
}
.video-area .video-area-content .video-ply-wrapper .video-play-btn {

	border: 10px solid  <?php echo $color; ?>;
	color:  <?php echo $color; ?>;
}

.video-area .video-area-content .video-ply-wrapper .video-play-btn:hover {
	background-color: <?php echo $color; ?>;
	color: #fff;
}
.video-area.grd-overlay::after {
	background-color: <?php echo $color; ?>;
	opacity: .80;
}
.testimonial-area .right-content-area .testimonial-carousel .single-testimonial-carousel .author-details .content .post {
	color: <?php echo $color; ?>;
}
.achivement-area .single-achivement-item .number {
	-webkit-text-fill-color: <?php echo $color; ?>;
}

.faq-area .right-content-wrapper .card .card-header a::after {
	border: 2px solid <?php echo $color; ?>;
	color:<?php echo $color; ?>;
}

.faq-area .left-content-wrapper .card .card-header a::after {
	border: 2px solid <?php echo $color; ?>;
	color: <?php echo $color; ?>;
}
.faq-area .right-content-wrapper .card .card-header a[aria-expanded="true"]::after {
	background-color: <?php echo $color; ?>;
}
.faq-area .left-content-wrapper .card .card-header a[aria-expanded="true"]::after {
	background-color: <?php echo $color; ?>;
}
.faq-area .btn-wrapper .boxed-btn:hover {
	border: 1px solid <?php echo $color; ?>;
}
.marketing-area .marekting-inner .subscribe-form .submit-btn:hover {
color: <?php echo $color; ?>;
	background-color: #fff;
}
.back-to-top {
	background-color: <?php echo $color; ?>;
}
.footer-area .footer-widget .widget-body ul li a:hover {
	color: <?php echo $color; ?>;
}
.blog-page-conent .single-blog-post .content .title:hover {
	color: <?php echo $color; ?>;
}

.contact-page-container .contact-form .submit-btn:hover {
color: <?php echo $color; ?>;
	background-color: #fff;
}
.blog-page-conent .single-blog-post .content .readmore:hover {
color: <?php echo $color; ?>;
}
.navbar-area .navbar-collapse .navbar-nav .nav-item:hover .dropdown-menu .dropdown-item:hover {
	background-color: <?php echo $color; ?>;

}
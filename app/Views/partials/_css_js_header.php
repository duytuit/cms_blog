<?php $clr = esc($generalSettings->site_color);?>
<style>body {<?= $siteFonts->primary_font_family; ?>}  .widget-title .title, .home-slider-item .title, .home-slider-boxed-item .title, .reactions .title-reactions, .poll .title, .w-popular-list li .title, .random-post-slider .item-info .title, .first-tmp-slider-item .item-info .title, .post-item-horizontal .title, .post-item .title, .footer-widget .title, .f-random-list li .title, .post-content .post-title .title, .related-posts .post-list li .title, .related-posts .related-post-title .title, .comment-tabs a, .page-title, .leave-reply-title, .post-item-boxed .title, .w-our-picks-list li .title, .gallery-category-title {<?= $siteFonts->secondary_font_family; ?>}  .post-item-horizontal .item-image {float: left;}  .post-item-horizontal .item-content {float: left;}.add-to-reading-list{padding: 0 !important}  a:hover, a:focus, a:active, .text-category, .navbar-inverse .navbar-nav > li > a:hover, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:focus, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:hover, .read-more, .post-content .post-meta a:hover, .f-random-list li .title a:hover, .random-post-slider .owl-prev:hover .random-arrow-prev, .random-post-slider .owl-next:hover .random-arrow-next, .post-detail-slider .owl-prev:hover .post-detail-arrow-prev, .post-detail-slider .owl-next:hover .post-detail-arrow-next, .link-forget:hover, .nav-footer li a:hover, .widget-list li .w-meta a:hover, .post-content .post-text a, .post-files .file button{color: <?= $clr; ?>}#infinity-outline{stroke: <?= $clr; ?>}.nav-mobile-header, .navbar-toggle{background-color: #1c1c1c !important}.navbar-inverse .navbar-toggle{border-color: <?= $clr; ?> !important}.btn-custom, .btn-error-back, .post-content .post-tags .tag-list li a:hover,  .custom-checkbox:checked + label:before{background-color: <?= $clr; ?>;border-color: <?= $clr; ?>}::selection{background-color: <?= $clr; ?> !important;color: #fff}::-moz-selection{background-color: <?= $clr; ?> !important;color: #fff}.navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus, .navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:hover, .navbar-inverse .navbar-nav > .open > a:focus, .navbar-inverse .navbar-nav > li > a:focus, .navbar-inverse .navbar-nav > li > a:hover{color: <?= $clr; ?> !important;background-color: transparent}.home-slider-item .item-info .label-slider-category, .label-post-category, .widget-title .title::after, .ramdom-post-slider .item-info .label-slider-category, .w-tag-list li a:hover, .related-posts .related-post-title .title::after, .navbar-inverse .navbar-nav .active a::after, .newsletter button, .filters .active::after, .filters .btn:focus:after, .filters .btn:hover:after, .filters .btn:active:after, .label-slider-category, .reactions .col-reaction:hover .btn-reaction, .reactions .progress-bar-vertical .progress-bar, .reactions .btn-reaction-voted, .poll .result .progress .progress-bar, .spinner > div,  .label-reaction-voted, .switcher-box .open-switcher{background-color: <?= $clr; ?>}.pagination .active a{border: 1px solid <?= $clr; ?> !important;background-color: <?= $clr; ?> !important;color: #fff !important}.leave-reply .form-control:focus, .page-contact .form-control:focus, .form-input:focus, .custom-checkbox:hover + label:before{border-color: <?= $clr; ?>}.gallery-categories ul li a:hover, .gallery-categories ul li a:focus, .gallery-categories ul li a:active{background-color: <?= $clr; ?> !important;border-color: <?= $clr; ?> !important;color: #fff !important}.newsletter .newsletter-button{background-color: <?= $clr; ?>;border: 1px solid <?= $clr; ?>}.profile-buttons ul li a:hover{color: <?= $clr; ?>;border-color: <?= $clr; ?>}.comment-section .nav-tabs .active{border-bottom: 2px solid <?= $clr; ?>}.cookies-warning a, .post-meta .post-meta-inner a:hover {color: <?= $clr; ?> !important}.custom-checkbox input:checked + .checkbox-icon{background-color: <?= $clr; ?>;border: 1px solid <?= $clr; ?>}.swal-button--danger {background-color: <?= $clr; ?> !important;}@media (max-width: 768px) {.modal-newsletter .modal-body {padding: 30px;}.modal-newsletter .modal-newsletter-inputs {display: block;}.modal-newsletter .form-input{margin-bottom: 10px;}.modal-newsletter .btn {width:100% !important;}}</style>
<script>var InfConfig = {baseUrl: '<?= base_url(); ?>', csrfTokenName: '<?= csrf_token() ?>', csrfCookieName: '<?= config('App')->CSRFCookieName; ?>', sysLangId: '<?= $activeLang->id; ?>', isRecaptchaEnabled: '<?= isRecaptchaEnabled($generalSettings) ? 1 : 0; ?>'};</script>
<?php

$alignwide_max = 1240;
?>
:root {
    --accent-color: <?php echo rivax_get_option('accent-color')?: '#ff2c54'; ?>;
    --accent-color-alt: <?php echo rivax_get_option('accent-color-alt')?: '#FFF'; ?>;
    --second-color: <?php echo rivax_get_option('second-color')?: '#5960ff'; ?>;
    --second-color-alt: <?php echo rivax_get_option('second-color-alt')?: '#FFF'; ?>;
}

.container {
    padding-left: 15px;
    padding-right: 15px;
    max-width: 860px;
    margin: 0 auto;
}

body {
    color: #2e3039;
    background: #fff;
    font-family: <?php echo rivax_get_option('typography-body', 'font-family')?: 'Poppins'; ?>, sans-serif;
    font-weight: <?php echo rivax_get_option('typography-body', 'font-weight')?: '400'; ?>;
    font-style: <?php echo rivax_get_option('typography-body', 'font-style')?: 'normal'; ?>;
    line-height: 2;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    color: #191a1b;
    font-family: <?php echo rivax_get_option('typography-heading', 'font-family')?: 'inherit'; ?>;
    font-weight: <?php echo rivax_get_option('typography-heading', 'font-weight')?: '700'; ?>;
    font-style: <?php echo rivax_get_option('typography-heading', 'font-style')?: 'normal'; ?>;
}

a {
    color: var(--accent-color);
    transition: all ease 0.3s;
    text-decoration: none;
}

a:hover {
    color: inherit;
}

/* Generic WP styling */

.alignnone,
.aligncenter,
.alignleft,
.alignright,
.alignwide {
	margin-top: 1em;
	margin-right: auto;
	margin-bottom: 1em;
	margin-left: auto;
}

.alignright {
	float: right;
}

.alignleft {
	float: left;
}

.aligncenter {
	display: block;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
}

.alignwide {
	width: 100%;
}

@media (min-width: 792px) {
	.alignwide {
		width: calc(100vw - 48px);
		max-width: calc(100vw - 48px);
		margin-left: calc(50% - 50vw + 24px);
		margin-right: calc(50% - 50vw + 24px);
	}
}

@media (min-width: <?php echo sprintf( '%dpx', $alignwide_max ); ?>) {
	.alignwide {
		width: calc(<?php echo sprintf( '%dpx', $alignwide_max ); ?> - 48px);
		max-width: calc(<?php echo sprintf( '%dpx', $alignwide_max ); ?> - 48px);
		margin-left: calc(calc(50% - <?php echo sprintf( '%dpx', $alignwide_max ); ?> / 2) + 24px);
		margin-right: calc(calc(50% - <?php echo sprintf( '%dpx', $alignwide_max ); ?> / 2) + 24px);
	}
}

.alignfull {
	width: 100vw;
	max-width: 100vw;
	margin-left: calc(50% - 50vw);
	margin-right: calc(50% - 50vw);
}

.amp-wp-enforced-sizes {
	/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
	max-width: 100%;
	margin: 0 auto;
}

/* Template Styles */

.amp-wp-content,
.amp-wp-title-bar div {
	margin: 0 auto;
	max-width: 840px;
}

p,
ol,
ul,
figure {
	margin: 0 0 1em;
	padding: 0;
}


/* Quotes */

blockquote {
	background: rgba(127,127,127,.125);
	border-<?php echo is_rtl() ? 'right' : 'left'; ?>: 2px solid var(--accent-color);
	margin: 8px 0 24px 0;
	padding: 16px;
}

blockquote p:last-child {
	margin-bottom: 0;
}


/* Header */

.amp-wp-header {
    box-shadow: 0 10px 25px #2a2d3f14;
    margin-bottom: 40px;
}

.amp-wp-header-wrap {
    padding: 15px 0;
}

.amp-wp-header-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

#site-logo {
    font-size: 1.4rem;
    line-height: 1;
    display: block;
}

#site-logo amp-img {
    display: block;
	width: <?php echo intval(rivax_get_option('amp-logo-width')) ?: '100' ?>px;

}

.side-nav-opener {
    border: none;
    width: 30px;
    height: 18px;
    box-shadow: none;
    background: transparent;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    cursor: pointer;
}

.side-nav-opener span {
    height: 2px;
    width: 100%;
    background: #000;
}

.sidebar-left {
    width: 300px;
    max-width: 100%;
    background: #2c2c31;
    padding: 15px;
}

.side-nav-closer {
    border: none;
    width: 26px;
    height: 18px;
    box-shadow: none;
    background: transparent;
    padding: 0;
    margin: 0 0 30px;
    cursor: pointer;
}

.side-nav-closer span {
    height: 1px;
    width: 100%;
    background: #fff;
    display: block;
    transform: rotate(45deg);
}

.side-nav-closer span + span {
    transform: rotate(-45deg);
}

.amp-nav-wrapper {
    margin-bottom: 50px;
}

.amp-nav-wrapper ul {
    padding: 0;
    margin: 0;
    list-style: none;
}

.amp-nav-wrapper ul ul {
    padding: 0 0 10px 20px;
}

html[dir="rtl"] .amp-nav-wrapper ul ul {
    padding: 0 20px 10px 0;
}

.amp-nav-wrapper li a {
    text-decoration: none;
    color: #9898a3;
}

.amp-nav > li > a {
    color: #ffffff;
}

.amp-nav > li {
    border-bottom: 1px solid #47474c;
    line-height: 2.2;
}

.search-form {
    display: flex;
    gap: 5px;
    margin-bottom: 30px;
}

.search-form .search-field {
    flex-grow: 1;
    background: transparent;
    border: 1px solid #575762;
    padding: 8px;
    border-radius: 3px;
}

.search-form .submit {
    border: none;
    background: #575762;
    color: #fff;
    border-radius: 3px;
    padding: 8px;
    cursor: pointer;
}

/* Article Header */

.single-hero-title-2 .category a {
    display: inline-block;
    padding: 2px 8px;
    line-height: 1.6;
    margin-right: 7px;
    background: var(--accent-color);
    color: var(--accent-color-alt);
    font-size: 0.8rem;
    text-transform: uppercase;
    transition: 0.3s;
}

html[dir="rtl"] .single-hero-title-2 .category a {
    margin-right: 0;
    margin-left: 7px;
}

.single-hero-title-2 .category.multi-bg a {
    background: var(--term-color, var(--accent-color));
}

.single-hero-title-2 .category a:hover {
    background: #292930;
}

.single-hero-title-2 .title {
    border-bottom: 1px solid #dfe1ea;
    word-wrap: break-word;
    margin: 5px 0 20px;
}

.single-hero-title-2 .excerpt {
    color: #757a8b;
    font-size: 1rem;
}

.single-hero-title-2 .meta, .single-hero-title-2 .meta-details {
    display: flex;
    align-items: end;
    flex-wrap: wrap;
    font-size: 13px;
    letter-spacing: 1px;
    color: #51535a;
}

.single-hero-title-2 .meta {
    flex-wrap: nowrap;
    margin-bottom: 20px;
}

.single-hero-title-2 .meta a {
    color: #51535a;
}

.single-hero-title-2 .author-avatar {
    flex-shrink: 0;
}

.single-hero-title-2 .author-avatar img {
    width: 45px;
    border-radius: 50%;
    margin-right: 10px;
}

.single-hero-title-2 .author-name {
    flex-shrink: 0;
    width: 100%;
    font-size: 14px;
	font-weight: 700;
    text-align: left;
}

.single-hero-title-2 .author-name a {
    color: #000;
}

.single-hero-title-2 .meta-details .meta-item {
    position: relative;
}

.single-hero-title-2 .meta-details .meta-item:not(:last-child)::after {
    content: '/';
    display: inline-block;
    margin: 0 6px;
}

/* Featured image */

.article-featured-link {
    background: #41444c;
    padding: 25px;
    border-radius: 3px;
    color: #fff;
    letter-spacing: 1px;
}

.article-featured-link .link {
    font-size: 1.8rem;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    color: #fff;
}

.article-featured-link .title {
    margin: 20px 0 0;
    font-style: italic;
}

.article-featured-quote {
    background: #41444c;
    padding: 25px;
    border-radius: 3px;
    color: #fff;
}

.article-featured-quote .content {
    font-size: 1.2rem;
    margin: 0;
}

.article-featured-quote .author {
    margin: 20px 0 0;
    font-style: italic;
}

/* Article Content */

.amp-wp-article-content {
	margin: 0 16px;
}

.amp-wp-article-content ul,
.amp-wp-article-content ol {
	margin-<?php echo is_rtl() ? 'right' : 'left'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>: 1em;
}

.amp-wp-article-content .wp-caption {
	max-width: 100%;
}

.amp-wp-article-content amp-img {
	margin: 0 auto;
}

.amp-wp-article-content amp-img.alignright,
.amp-wp-article-content .wp-block-cover.alignright {
	margin: 0 0 1em 16px;
}

.amp-wp-article-content amp-img.alignleft,
.amp-wp-article-content .wp-block-cover.alignleft {
	margin: 0 16px 1em 0;
}

/* Captions */

.wp-caption {
	padding: 0;
}

.wp-caption.alignleft {
	margin-right: 16px;
}

.wp-caption.alignright {
	margin-left: 16px;
}

.wp-caption .wp-caption-text {
	border-bottom: 1px solid var(--accent-color);
	color: #555;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: .66em 10px .75em;
}

/* AMP Media */

.alignwide,
.alignfull {
	clear: both;
}

amp-carousel {
	margin: 0 -16px 1.5em;
}
amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
	margin: 0 -16px 1.5em;
}

.amp-wp-article-content amp-carousel amp-img {
	border: none;
}

amp-carousel > amp-img > img {
	object-fit: contain;
}

.amp-wp-iframe-placeholder {
	background: #f3f3f6 url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;
	background-size: 48px 48px;
	min-height: 48px;
}

/* Article Footer Meta */

.amp-wp-article-footer .amp-wp-meta {
	display: block;
}

.amp-wp-tax-category,
.amp-wp-tax-tag {
	color: #555;
	font-size: .875em;
	line-height: 1.5em;
	margin: 1.5em 16px;
}

.amp-wp-comments-link {
	color: #555;
	font-size: .875em;
	line-height: 1.5em;
	text-align: center;
	margin: 2.25em 0 1.5em;
}

.amp-wp-comments-link a {
    border-radius: 3px;
    background-color: var(--accent-color);
    color: var(--accent-color-alt);
    cursor: pointer;
    display: inline-block;
    letter-spacing: 1px;
    padding: 10px 25px;
    box-shadow: 0 10px 25px var(--accent-color);
}

/* AMP Footer */

.amp-footer {
    border-top: 1px solid #e9e9f1;
    margin: 60px 0 0;
    padding: 30px 0;
    text-align: center;
}

#footer-logo {
    font-size: 1.4rem;
}

#footer-logo amp-img {
    display: block;
    width: <?php echo intval(rivax_get_option('amp-logo-width')) ?: '100' ?>px;
}

.footer-copyright {
    color: #6b6d77;
    font-size: 0.85rem;
    margin: 10px 0;
}

.back-to-top {
    font-size: .85em;
    letter-spacing: 1px;
    font-weight: 600;
    margin-top: 15px;
    display: inline-block;
}

#amp-mobile-version-switcher>a {
    background-color: #262834;
}
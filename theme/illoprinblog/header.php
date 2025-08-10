<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

	<?php wp_head() ?>
</head>

<body data-bs-theme="dark">

	<!-- Nav-bar -->
	<header class="blog-header d-flex justify-content-between">

		<a href="/">
			<img src="<? echo get_template_directory_uri() ?>/img/logo.svg" alt="">
		</a>

		<nav class="navbar d-flex gap-5 align-items-center">
			<a href="<? echo get_post_type_archive_link("portfolio_case") ?>" class="nav-link">Портфолио</a>
			<a href="/articles" class="nav-link">Статьи</a>
			<a href="/#contacts" class="nav-link">Связаться</a>
		</nav>

		<button class="btn-glass navbar-toggle p-3">
			<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
				width="24" height="24" fill="none" viewBox="0 0 24 24">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
					d="m19 9-7 7-7-7" />
			</svg>

		</button>

	</header>
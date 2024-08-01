<?php header("Content-Type: text/html; charset=UTF-8");
	$lang = 'en'; // default language
	foreach (explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) as $urlseg) {
		if ($urlseg === 'de' || $urlseg === 'en')
		{
			$lang = $urlseg;
		}
	}

	include("core.php");
	$core = new EFWebCore("core.config.json");
?>

<!DOCTYPE html>

<html prefix="og: http://ogp.me/ns#" lang="<?= $lang ?>">
	<head>
		<title><?= $core->current->title ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="HandheldFriendly" content="true" /> 
		<meta name="mobile-web-app-capable" content="yes" />
		<meta name="description" content="<?= $core->current->description ?>" />
		<meta name="keywords" content="<?= $core->current->keywords ?>" />		
		<meta name="robots" content="<?= $core->current->robots ?>" />
		<meta name="author" content="luno@dogpixels.net" />
		<meta name="rating" content="general" />
		<meta name="theme-color" content="<?= $core->current->themeColor ?>" />
		<meta name="google" content="notranslate" /><!-- prevent Edge/Bing from translating this page -->

		<base href="<?= $core->base; ?>" />

		<link rel="apple-touch-icon" sizes="57x57" href="img/icon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="img/icon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="img/icon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="img/icon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="img/icon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="img/icon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="img/icon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="img/icon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="img/icon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192" href="img/icon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="img/icon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="img/icon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="img/icon/favicon-16x16.png">
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:site" content="@wildspotworks" />
		<meta name="twitter:creator" content="@wildspotworks" />
		<meta name="twitter:title" content="<?= $core->current->title ?>" />
		<meta name="twitter:description" content="<?= $core->current->description ?>" />
		<meta name="twitter:image" content="<?= $core->current->ogpImage ?>" />

		<meta property="og:image" content="<?= $core->current->ogpImage ?>" />
		<meta property="og:image:width" content="<?= $core->current->ogpImageWidth ?>" />
		<meta property="og:image:height" content="<?= $core->current->ogpImageHeight ?>" />
		<meta property="og:title" content="<?= $core->current->title ?>" />
		<meta property="og:description" content="<?= $core->current->description ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?= $core->get_full_url() ?>" />
		<meta property="og:site_name" content="WildSpotWorks Fursuits" />

		<link rel="canonical" href="<?= $core->get_full_url() ?>" />

		<?php 
		$bcdata = $core->get_breadcrumb_data();
		$pos = 2;
		?>

		<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "BreadcrumbList",
			"itemListElement": 
			[
				{
					"@type": "ListItem",
					"position": 1,
					"item": 
					{
						"@id": "https://dogpixels.net/wildspotworks",
						"name": "WildSpotWorks" 
					}
				}
			<?php foreach ($bcdata as $key => $bc) { ?>
				,{
					"@type": "ListItem",
					"position": <?= $pos++ ?>,
					"item":
					{
						"@id": "<?= $bc->url ?>",
						"name": "<?= $bc->name ?>"
					}
				}
			<?php } // end of foreach loop ?>
			]
		}
		</script>

		<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "Organization",
			"name": "WildSpotWorks",
			"url": "https://dogpixels.net/wildspotworks",
			"logo": "<?= $core->base ?>apple_favicon.png",
			"sameAs": [
				"https://twitter.com/wildspotworks"
			]
		}
		</script>

		<link rel="stylesheet" href="css/uikit.min.css" />
		<link rel="stylesheet" href="css/main.css" />
		<link rel="stylesheet" href="css/responsive.css" />
		
		<script src="js/uikit.min.js"></script>
		<script src="js/uikit-icons.min.js"></script>
	</head>

	<body>
		<?php if (str_starts_with($core->current->uri, 'home')) { ?>
			<div uk-slider="autoplay: true">
				<div class="uk-slider-items uk-child-width-1-1">
					<?php
						foreach (scandir('img/pages/home') as $fn) {
							if (in_array($fn, ['.', '..', '.thumbs']) || is_dir("img/pages/home/${fn}"))
								continue;
							echo "<div class=\"uk-cover-container\"><img src=\"img/pages/home/${fn}\" alt=\"\" uk-cover /></div>";
						}
					?>
				</div>
			</div>
		<?php } ?>

		<header>
			<nav uk-scrollspy="cls:uk-animation-slide-bottom-small">
				<?= $core->get_menu() ?>
			</nav>
		</header>

		<main>
			<div id="content" uk-scrollspy="cls: uk-animation-slide-bottom-small; target: > section; delay: 250">
				<?= $core->get_content() ?>
			</div>
		</main>
		
		<footer>
			<div uk-scrollspy="cls:uk-animation-slide-bottom-small">
				<div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-expand@l uk-grid-divider" uk-grid>
					<div>
						<h3>&copy; WildSpotWorks <?= date("Y"); ?></h3>
						<ul class="uk-list">
							<li><a href="<?= $lang ?>/legal"><?= $core->config->pages->{$lang . '/legal'}->menuText ?></a></li>
							<li><a href="<?= $lang ?>/terms"><?= $core->config->pages->{$lang . '/terms'}->menuText ?></a></li>
							<li><a href="<?= $lang ?>/privacy"><?= $core->config->pages->{$lang . '/privacy'}->menuText ?></a></li>
						</ul>
					</div>
					
					<div>
						<h3><?= $lang === 'de'? 'Andere Kanäle' : 'Follow Me' ?></h3>
						<div class="uk-button-group uk-width-1-1 uk-margin-small-bottom">
							<a href="http://www.furaffinity.net/user/lunowroo/" target="_blank" class="wsw-hide-ext">
								<span class="uk-icon uk-icon-button">
									<svg width="200" height="200" viewBox="0 0 20 20">
										<path d="M 8.8030422,17.543213 C 8.6326418,17.352999 8.5771627,17.14297 8.6286791,16.881426 c 0.095107,-0.515164 0.1109583,-1.046179 0.2655075,-1.55738 0.1307723,-0.431945 -0.1149212,-0.859927 -0.5270523,-1.050142 -0.1149211,-0.05152 -0.1585119,-0.04359 -0.1585119,0.08718 0,0.162474 0.00793,0.328912 -0.019814,0.487424 -0.035665,0.182289 -0.087182,0.404205 -0.3487263,0.352689 -0.2298423,-0.04359 -0.2179539,-0.249656 -0.2021027,-0.42402 0.015851,-0.174363 0.063405,-0.348725 0.075293,-0.523089 0.00793,-0.150586 0.00793,-0.317024 -0.1307723,-0.412131 -0.1466235,-0.09907 -0.2575819,0.01981 -0.3645774,0.103033 -0.178326,0.14266 -0.3487263,0.106995 -0.4359078,-0.07926 -0.1149211,-0.237762 -0.2100283,-0.103027 -0.3011726,-0.01188 -0.3368379,0.348727 -0.7331178,0.610272 -1.1571372,0.832188 -0.4081682,0.213991 -0.6816014,0.542904 -0.8361505,0.978811 -0.079256,0.221917 -0.1466235,0.455722 -0.3051355,0.645937 -0.1743631,0.210028 -0.392317,0.245693 -0.6181966,0.154548 -0.2179539,-0.09114 -0.2496563,-0.297209 -0.2258794,-0.5112 0.015851,-0.138698 0.055479,-0.277396 0.1505863,-0.380429 0.6261221,-0.661787 1.1333603,-1.446421 1.9734736,-1.882329 0.1545492,-0.07926 0.3011727,-0.190215 0.4240195,-0.313062 0.118884,-0.118883 0.3962798,-0.261544 0.019814,-0.424019 -0.083219,-0.03567 -0.055479,-0.12681 -0.023776,-0.202102 0.015851,-0.0317 0.023776,-0.06737 0.035665,-0.103033 -0.4438338,0.03567 -0.2496567,-0.332875 -0.3447639,-0.523089 -0.079256,-0.162476 -0.2773959,-0.15455 -0.4359078,-0.146624 -0.1545491,0.004 -0.2853215,0.08718 -0.4081682,0.178326 -0.1109586,0.08322 -0.221917,0.1704 -0.3447638,0.229842 -0.3566518,0.1704 -0.8123736,0.03566 -0.9154064,-0.257582 -0.095107,-0.261544 0.1822887,-0.657824 0.5389406,-0.752932 0.1585119,-0.03963 0.3209867,-0.04755 0.4834614,-0.0634 0.138698,-0.01585 0.2773959,-0.01189 0.4121311,-0.03963 0.2139911,-0.04359 0.4557218,-0.14266 0.471573,-0.360615 0.015851,-0.202102 -0.2417307,-0.261545 -0.4160939,-0.320987 -0.5349778,-0.174363 -1.081844,-0.213991 -1.6366357,-0.106995 -0.158512,0.0317 -0.3011727,0.05152 -0.4121311,-0.08718 C 2.8311048,10.30318 2.8231792,10.192222 2.8746956,10.081263 2.9579144,9.9029376 3.1362403,9.8395328 3.2868267,9.8989748 3.8812464,10.13278 4.4479266,9.895012 5.0225324,9.8236816 5.4861799,9.7642396 5.6090266,9.5462857 5.4307006,9.1103779 5.4029611,9.0430103 5.3395563,8.9637543 5.3950354,8.9003495 5.7952781,8.4485906 5.3910727,8.0602362 5.2721887,7.6679192 5.1929327,7.4103373 5.2127467,7.2874905 5.4742914,7.2320114 5.5971382,7.2082346 5.7279105,7.2082346 5.8467945,7.1725694 5.9894553,7.1289786 6.1955208,7.1844578 6.2391116,6.9585783 6.2787395,6.7723268 6.2272232,6.6138148 6.0885252,6.4790796 5.6803569,6.0867626 5.2563375,5.7142596 4.7411737,5.4566776 4.578699,5.3694961 4.4122615,5.2743889 4.2656379,5.1594678 4.1229772,5.0524722 4.008056,4.9018858 4.0793864,4.703746 4.1507167,4.5016432 4.2933775,4.366908 4.5152942,4.3312428 c 0.178326,-0.027739 0.3526891,-0.00397 0.511201,0.087182 0.511201,0.2972098 1.0144764,0.6102709 1.3671655,1.1056207 0.067368,0.091144 0.1347352,0.2060656 0.2456935,0.2258795 0.2655075,0.047554 0.4160938,0.19814 0.4993126,0.4438334 0.055479,0.1664376 0.1862515,0.2853215 0.372503,0.2496564 0.19814,-0.035665 0.1307724,-0.217954 0.1268096,-0.3408007 C 7.6340167,5.9282506 7.6657191,5.8133295 7.8717846,5.7935155 8.1610688,5.7697387 8.1372921,5.6231152 8.0342592,5.4011985 7.8797101,5.056435 7.685533,4.7354483 7.5151327,4.3986104 7.3883231,4.1489541 7.2218856,3.855707 7.4913559,3.6060507 7.6340167,3.4752784 7.9668917,3.7487115 8.117478,4.133103 8.2125852,4.3787964 8.2720272,4.6363784 8.3671343,4.8820718 8.4107251,5.0009558 8.4582787,5.1872073 8.6366046,5.1238026 8.7832282,5.0722862 8.7436002,4.8939603 8.7039722,4.7869647 8.5177207,4.2797265 8.3116552,3.7843767 8.1095525,3.2850641 8.0540733,3.1463661 7.9827429,3.011631 7.9312265,2.872933 7.8915985,2.7619747 7.8995241,2.6351651 8.0223709,2.5796859 c 0.1386979,-0.059442 0.2060655,0.051516 0.2496563,0.158512 0.059442,0.1505863 0.1228467,0.3051355 0.1545491,0.4636474 0.1545492,0.7568945 0.6261222,1.3315003 1.0976952,1.9061061 0.095107,0.1149211 0.1902144,0.1664375 0.3051355,0.019814 0.023777,-0.02774 0.051516,-0.079256 0.075293,-0.079256 0.558755,0.00397 0.420057,-0.4081682 0.408169,-0.7133037 -0.01585,-0.491387 -0.0634,-0.9788113 -0.09114,-1.4662355 -0.004,-0.1941771 -0.004,-0.4160938 0.261545,-0.412131 0.245693,0.00396 0.233805,0.2179539 0.225879,0.3962799 -0.01189,0.3883542 -0.07133,0.7806713 0.01981,1.1650627 0.114922,0.5072382 0.336838,0.5983826 0.772746,0.3130611 0.245694,-0.1585119 0.507238,-0.2734331 0.796523,-0.3289123 0.348726,-0.063405 0.475536,0.063405 0.404205,0.4002427 -0.01585,0.07133 -0.05152,0.1426607 -0.07529,0.2139911 -0.05548,0.1743631 -0.332876,0.3051355 -0.217954,0.4755358 0.194177,0.2892843 0.443833,0.5429034 0.733117,0.7529317 0.02774,0.019814 0.08322,0.035665 0.103033,0.023776 0.289284,-0.1822887 0.463648,-0.1347351 0.554792,0.2179539 0.04359,0.1624748 0.194177,0.1228468 0.301173,0.015851 0.178326,-0.178326 0.352689,-0.3606147 0.531015,-0.5349778 0.04756,-0.04359 0.09907,-0.1386979 0.178326,-0.079256 0.05548,0.043591 -0.0079,0.1149212 -0.02774,0.1704003 -0.106996,0.2694703 -0.229843,0.5310151 -0.388355,0.7727457 -0.253619,0.3923171 -0.1704,0.6538618 0.273433,0.8004854 0.166438,0.055479 0.344764,0.063405 0.515164,0.1069955 0.320987,0.083219 0.384392,0.2456935 0.154549,0.4676102 -0.265507,0.257582 -0.265507,0.4279823 0.09114,0.5746059 0.118885,0.047554 0.237769,0.1149211 0.178326,0.2813586 -0.134734,0.3764659 0.106996,0.649899 0.309099,0.8797413 0.194177,0.2219167 0.194177,0.3526891 -0.01189,0.5230891 -0.05944,0.04755 -0.114921,0.09511 -0.174364,0.142661 -0.431944,0.336838 -0.451758,0.412132 -0.206065,0.911444 0.07926,0.166437 -0.02378,0.253619 -0.118884,0.356652 -0.293247,0.324949 -0.265507,0.435908 0.134736,0.622159 0.09114,0.04359 0.178326,0.09511 0.249656,0.166437 0.106995,0.106997 0.221916,0.241731 0.142661,0.39628 -0.08718,0.174364 -0.261545,0.106996 -0.404206,0.07133 -0.122847,-0.0317 -0.237768,-0.07926 -0.356652,-0.122847 -0.08322,-0.0317 -0.174363,-0.07133 -0.229842,0.0317 -0.05152,0.09511 0.004,0.174363 0.06737,0.233805 0.09114,0.08322 0.202102,0.150586 0.289284,0.237767 0.07529,0.07529 0.11492,0.170401 0.02774,0.269471 -0.07926,0.08718 -0.158512,0.03567 -0.237768,0 -0.03567,-0.01585 -0.0634,-0.03963 -0.09907,-0.05548 -0.138698,-0.07926 -0.344763,-0.301173 -0.384391,-0.245693 -0.106996,0.154549 0.09907,0.297209 0.162474,0.451759 0.05548,0.138698 0.150586,0.265507 0.19814,0.404205 0.04756,0.134735 0.12681,0.320987 -0.0634,0.39628 -0.158512,0.05944 -0.281359,-0.07133 -0.364578,-0.206065 -0.106995,-0.170401 -0.194177,-0.352689 -0.309098,-0.515164 -0.08322,-0.118884 -0.166438,-0.309099 -0.32495,-0.281359 -0.194177,0.03567 -0.106995,0.249657 -0.126809,0.388355 -0.02378,0.138697 -0.01585,0.285321 -0.22588,0.26947 -0.182288,-0.01189 -0.14266,0.138698 -0.154548,0.24173 -0.04359,0.483462 0.09114,0.919369 0.356651,1.319612 0.138698,0.210029 0.277396,0.420057 0.408169,0.634048 0.09114,0.150586 0.158512,0.313061 0.170399,0.49535 0.01189,0.186251 -0.0079,0.360615 -0.210028,0.435908 -0.225879,0.08718 -0.364577,-0.05152 -0.463647,-0.221917 -0.07926,-0.138698 -0.142661,-0.29721 -0.174364,-0.451759 -0.118883,-0.586494 -0.372503,-1.117509 -0.649898,-1.640598 -0.03567,-0.06737 -0.07133,-0.134736 -0.122847,-0.186252 -0.217953,-0.213991 -0.475536,-0.455722 -0.784634,-0.320987 -0.313062,0.134736 -0.213991,0.471573 -0.170401,0.741044 0.0317,0.210028 0.103033,0.416093 0.134736,0.626122 0.0317,0.233804 0.09907,0.515163 -0.273434,0.534977 -0.344763,0.01981 -0.31306,-0.253619 -0.320987,-0.475536 -0.004,-0.174362 0.01586,-0.352688 0.01586,-0.527051 -0.004,-0.364578 -0.344763,-0.776709 -0.721229,-0.867853 -0.324949,-0.07926 -0.7806714,0.1704 -0.927295,0.523089 -0.2377679,0.56668 -0.2377679,1.176951 -0.3289122,1.775333 -0.047554,0.32495 -0.075293,0.649899 -0.3051355,0.911444 -0.075293,0.0079 -0.1505863,0.0079 -0.2258795,0.0079 z M 6.9801549,11.955667 c 0.00397,0.697452 0.3408006,1.046179 1.0342904,1.06203 0.3011727,0.0079 0.6023453,0.01585 0.903518,0 0.4240195,-0.01981 0.7885969,0.103033 1.0937327,0.408168 0.233805,0.237768 0.523089,0.39628 0.848038,0.463648 0.317024,0.06341 0.653862,0.08322 0.875779,-0.190215 0.638011,-0.788597 0.725193,-1.414718 0.08718,-2.159724 C 11.584926,11.262178 11.43434,10.980819 11.351122,10.624167 11.168833,9.8197188 10.578376,9.3679597 9.9126257,9.4828809 9.4925691,9.5542113 9.1161033,9.7246117 8.8387073,10.057487 8.668307,10.263553 8.4741299,10.370548 8.2125852,10.426027 7.4358767,10.584539 6.976192,11.178959 6.9801549,11.955667 Z M 10.998432,6.7128848 C 10.990507,6.2888653 10.931065,5.9005111 10.574413,5.6825572 10.304943,5.5200824 9.9958445,5.6151896 9.7580766,5.7895527 9.1834709,6.2056466 8.747563,6.7326987 8.5494231,7.4261885 8.4027995,7.9373895 8.688121,8.5199209 9.1755452,8.7458004 9.6431554,8.9637543 10.071138,8.8369448 10.419864,8.3574461 10.780479,7.8620964 10.978618,7.2993789 10.998432,6.7128848 Z m 2.187466,1.2482815 C 13.174009,7.4895932 13.094754,7.0497226 12.868874,6.6455172 12.547887,6.0748742 12.0565,6.0075066 11.624555,6.5028565 11.085614,7.1250158 10.887474,7.8660591 11.018246,8.67447 c 0.06341,0.3883543 0.269471,0.7133037 0.677639,0.8282249 0.408169,0.1149212 0.764821,-0.019814 1.065993,-0.3090983 0.35269,-0.3408006 0.412131,-0.7846341 0.42402,-1.2324303 z M 7.3764347,10.287329 C 8.0619989,10.291292 8.4345019,9.9623796 8.4701671,9.3481458 8.4899811,8.951866 8.3829855,8.5793628 8.17692,8.2385622 8.0421849,8.0206083 7.8519706,7.9453151 7.5983515,8.0285339 7.1782948,8.1711946 6.8454197,8.4168882 6.6116146,8.793354 6.3857351,9.1579315 6.4055491,9.5343973 6.603689,9.8989748 6.7780522,10.235813 7.1109272,10.271478 7.3764347,10.287329 Z m 6.5703203,0.638011 c 0.004,-0.400243 -0.126809,-0.760858 -0.32495,-1.1016584 -0.158512,-0.2734331 -0.388354,-0.3408007 -0.669712,-0.2021028 -0.360615,0.1743632 -0.634048,0.4438332 -0.836151,0.7846342 -0.229843,0.388355 -0.210028,0.788597 0.03567,1.085807 0.269471,0.320987 0.840114,0.53894 1.137324,0.431945 0.416093,-0.150586 0.653861,-0.511201 0.657824,-0.998625 z M 7.9629289,7.3191929 C 7.9510405,7.2280486 7.9074497,7.1686066 7.8202682,7.1884206 c -0.138698,0.02774 -0.2060656,0.1307723 -0.2060656,0.2655075 0,0.075293 0.051516,0.1466235 0.1426608,0.1307723 0.1347351,-0.02774 0.1822887,-0.1426607 0.2060655,-0.2655075 z M 12.314082,5.5121568 c -0.130773,0.055479 -0.114921,0.1743632 -0.114921,0.2813587 0.004,0.087182 0.01981,0.1941771 0.138697,0.1743632 0.114922,-0.019814 0.146624,-0.1347352 0.134736,-0.2338052 -0.004,-0.095107 -0.02774,-0.1981399 -0.158512,-0.2219167 z m 1.549454,3.5070767 c -0.004,-0.079256 -0.01189,-0.1664375 -0.114921,-0.1505863 -0.134735,0.019814 -0.1704,0.1307723 -0.158511,0.2456935 0.0079,0.07133 0.03567,0.1664375 0.122846,0.1545491 0.134735,-0.015851 0.138698,-0.1426607 0.150586,-0.2496563 z M 10.935028,5.2149469 c -0.004,-0.075293 -0.03567,-0.1347351 -0.106996,-0.1149211 -0.146624,0.035665 -0.225879,0.1386979 -0.233805,0.2892842 -0.004,0.055479 0.0079,0.1426608 0.09114,0.1109584 0.130772,-0.051516 0.221916,-0.1466235 0.249656,-0.2853215 z"/>
										<path d="m 2.7637373,14.448267 c 0.011888,0 0.02774,0 0.035665,-0.004 0.1188839,-0.04755 0.2417307,-0.07926 0.3249494,0.05152 0.043591,0.06737 0.043591,0.15455 -0.019814,0.202104 -0.1545491,0.122846 -0.2417307,-0.02378 -0.3408006,-0.103033 0,-0.04756 0,-0.09907 0,-0.146624 z"/>
										<path d="m 16.43143,9.1698198 c -0.206066,-0.063404 -0.52309,0.095107 -0.570643,-0.1426607 -0.0317,-0.1664375 0.305135,-0.087182 0.471573,-0.1545491 0.194177,-0.079256 0.408168,-0.1149212 0.614234,-0.1426608 0.118884,-0.015851 0.277396,0 0.289284,0.158512 0.0079,0.1228467 -0.106996,0.1902143 -0.225879,0.2060655 -0.194177,0.035665 -0.392318,0.055479 -0.578569,0.075293 z"/>
										<path d="m 14.818571,15.423116 c 0.24173,0.01189 0.550829,0.344763 0.519126,0.56668 -0.02378,0.1704 -0.154549,0.332875 -0.293246,0.277396 -0.281359,-0.114921 -0.289285,-0.435908 -0.368541,-0.689527 -0.03567,-0.114921 0.0317,-0.166438 0.142661,-0.154549 z"/>
										<path d="m 3.968428,7.1052019 c 0.2417307,0.047554 0.3368378,0.233805 0.3606147,0.4477961 0.019814,0.1822888 -0.1386979,0.217954 -0.2773959,0.217954 -0.2655076,0 -0.3249495,-0.1783259 -0.3170239,-0.4002427 0,-0.1505864 0.035665,-0.2734331 0.2338051,-0.2655074 z"/>
										<path d="m 4.8759088,13.453605 c -0.1624747,-0.02774 -0.194177,-0.158512 -0.1743631,-0.257582 0.051516,-0.245694 0.3051355,-0.293248 0.4794987,-0.404206 0.075293,-0.04755 0.1783259,0.04359 0.1505863,0.150587 -0.07133,0.245694 -0.2536191,0.392317 -0.4557219,0.511201 z"/>
										<path d="m 12.020835,3.5743483 c -0.05152,0.19814 -0.217954,0.2338051 -0.380429,0.2456936 -0.162475,0.011889 -0.118884,-0.1268096 -0.122847,-0.217954 -0.004,-0.1664375 0.0753,-0.253619 0.253619,-0.253619 0.150586,0.00793 0.237768,0.07133 0.249657,0.2258794 z"/>
										<path d="m 16.249141,12.942404 c 0.134735,0.0317 0.285322,0.08718 0.281358,0.26947 -0.004,0.110958 -0.103032,0.170401 -0.213991,0.162475 -0.150586,-0.01585 -0.253619,-0.103033 -0.26947,-0.261545 -0.01189,-0.12681 0.0634,-0.178326 0.202103,-0.1704 z"/>
										<path d="m 15.103892,5.2268354 c -0.146623,-0.015851 -0.122847,-0.1149212 -0.122847,-0.19814 0.004,-0.1704003 0.106996,-0.2377679 0.265508,-0.2417307 0.110958,-0.00397 0.166437,0.055479 0.150586,0.1585119 -0.02774,0.1743631 -0.166437,0.2338052 -0.293247,0.2813588 z"/>
										<path d="m 10.178133,15.835247 c -0.09114,-0.01585 -0.138698,-0.06737 -0.11492,-0.15455 0.03567,-0.134734 0.09907,-0.273432 0.245692,-0.289284 0.118884,-0.01189 0.09511,0.118885 0.08718,0.19814 -0.01189,0.130772 -0.07529,0.229843 -0.217954,0.245694 z"/>
										<path d="M 15.73794,7.0417971 C 15.71416,7.1487926 15.626981,7.1765322 15.5398,7.180495 15.44073,7.188425 15.3694,7.132941 15.381288,7.0219831 c 0.01189,-0.09907 0.07926,-0.158512 0.178326,-0.1426608 0.09114,0.011889 0.162475,0.063405 0.178326,0.1624748 z"/>
										<path d="M 4.6896573,7.1289786 C 4.6222896,7.1091647 4.5826618,7.0655735 4.598513,6.9982062 4.614364,6.9070622 4.661918,6.8317687 4.7609877,6.8278059 c 0.067368,-0.00397 0.1149211,0.04359 0.095107,0.118884 -0.027739,0.083219 -0.075293,0.1545491 -0.1664374,0.1822887 z"/>
										<path d="m 16.229327,7.0417971 c -0.01189,0.075293 -0.0317,0.1466235 -0.12681,0.1585119 -0.07529,0.00793 -0.118883,-0.031703 -0.126809,-0.1030328 -0.01189,-0.091144 0.0317,-0.1426607 0.122847,-0.1505863 0.06737,-0.00793 0.114921,0.023777 0.130772,0.095107 z"/>
									</svg>
								</span>
								FurAffinity
							</a>
						</div>
						<div class="uk-width-1-1 uk-margin-small-bottom">
							<a href="https://meow.social/@lunowroo" target="_blank" class="wsw-hide-ext">
								<span class="uk-icon-button" uk-icon="mastodon"></span>
								Mastodon
							</a>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<script>			
			document.querySelectorAll('nav a:not([href^="<?= $lang ?>"])').forEach(a => {
				a.remove()
			});
		</script>
		<script> // consent to load external content
			document.querySelectorAll('.consent-container').forEach(container => {
				container.innerHTML = `<h4><?= $lang === 'de'? 'Drittanbieter-Inhalt' : 'Third Party Content' ?></h4><p>${container.dataset.attrSrc}</p><p>- <?= $lang === 'de'? 'klicken zum Akzeptieren &amp; Laden' : 'click to allow &amp; load' ?> -</p>`;
				if (container.dataset.attrWidth)
					container.style.width = container.dataset.attrWidth + 'px';
				if (container.dataset.attrHeight)
					container.style.height = container.dataset.attrHeight + 'px';
				container.addEventListener('click', () => {
					const elem = document.createElement(container.dataset.elementType);
					for (attr in container.dataset) {
						if (attr.startsWith('attr')) {
							elem.setAttribute(attr.toLowerCase().replace(/^attr/, ''), container.dataset[attr]);
						}
					};
					container.replaceWith(elem);
				});
			});
		</script>
	</body>
</html>
<?php $core->end(); ?>
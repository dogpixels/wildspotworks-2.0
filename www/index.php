<?php header("Content-Type: text/html; charset=UTF-8");
	$ang = 'en'; // default language
	foreach (explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) as $urlseg) {
		if ($urlseg === 'de' || $urlseg === 'en')
		{
			$ang = $urlseg;
			break;
		}
	}
	if (!isset($ang))
	{
		header('Location: en');
	}

	include("core.php");
	$core = new EFWebCore("core.config.json");
?>

<!DOCTYPE html>

<html prefix="og: http://ogp.me/ns#" lang="<?= $ang ?>">
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
	</head>

	<body>
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
			<div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-expand@l uk-grid-divider" uk-grid>
				<div>
					<h3>Eurofurence <?= $core->current->number ?></h3>
					<span><?= $core->current->theme ?></span>
					<p>
						<?= $core->current->location ?><br />
						<?= $core->current->dates ?>
					</p>
				</div>
				
				<div>
					<h3>Find us on</h3>
					<div class="uk-button-group">
						<!-- <a href="home" class="uk-icon-button uk-icon" uk-tooltip="pos:top" title="Homepage" uk-icon="home"></a> -->
						<a target="_blank" href="https://app.eurofurence.org/" class="ef-hide-ext uk-icon-button uk-icon" uk-tooltip="pos:bottom" title="iOS & Android" uk-icon="phone"></a>
						<a target="_blank" href="https://www.twitter.com/eurofurence" class="ef-hide-ext uk-icon-button uk-icon" uk-tooltip="pos:bottom" title="Twitter" uk-icon="twitter"></a>
						<a target="_blank" href="https://www.facebook.com/eurofurence" class="ef-hide-ext uk-icon-button uk-icon" uk-tooltip="pos:bottom" title="Facebook" uk-icon="facebook"></a>
						<a target="_blank" href="https://vimeo.com/eurofurence" class="ef-hide-ext uk-icon-button uk-icon" uk-tooltip="pos:bottom" title="Vimeo" uk-icon="vimeo"></a>
						<a target="_blank" href="https://discord.com/invite/VMESBMM" class="ef-hide-ext uk-icon-button uk-icon" uk-tooltip="pos:bottom" title="Discord" uk-icon="discord"></a>
					</div>
				</div>

				<div>
					<h3>Convention Network</h3>
					<div id="links">
						<div uk-slideshow="autoplay: true; autoplay-interval: 3000; animation: pull; ratio: 5:2">
							<ul class="uk-slideshow-items js-disabled" id="partners">
								<li>JavaScript required to view links to other conventions.</li>
							</ul>
						</div>
					</div>
				</div>

				<div>
					<h3>Help</h3>
					<ul class="uk-list">
						<li><a href="https://help.eurofurence.org/contact" target="_blank"><span uk-icon="icon:mail" class="ef-uk-icon-lift"></span>Contact Us</a></li>
						<li><a href="https://help.eurofurence.org/faq" target="_blank"><span uk-icon="icon:question" class="ef-uk-icon-lift"></span>Frequently Asked Questions (FAQ)</a></li>
					</ul>
				</div>

				<div>
					<h3>Legal</h3>
					<ul class="uk-list">
						<li><a href="https://help.eurofurence.org/legal/imprint" target="_blank"><span uk-icon="icon:bookmark" class="ef-uk-icon-lift"></span>Imprint &amp; Legal Notice</a></li>
						<li><a href="https://help.eurofurence.org/legal/privacy" target="_blank"><span uk-icon="icon:lock" class="ef-uk-icon-lift"></span>Privacy Statement</a></li>
						<li><a href="website"><span uk-icon="icon:heart" class="ef-uk-icon-lift"></span>Site Attributions</a></li>
					</ul>
				</div>
			</div>
		</footer>
		<script src="js/uikit.min.js"></script>
		<script src="js/uikit-icons.min.js"></script>
		<script src="js/newsagent.js"></script>
		<script src="js/partners.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
<?php $core->end(); ?>
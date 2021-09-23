<?php 
error_reporting(true);
require __DIR__ . "/Instagram.class.php";

use IhsanDevs\InstagramDownloader\InstagramDownloader;

$target = 'https://www.instagram.com/reel/CT1yuGIh0U9/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Instagram Downloader</title>
</head>
<body>
<div class="container">
    <form action="" method="get">
        <div class="form-group">
          <label for="url">URL</label>
          <input type="url" autocomplete="off" placeholder="URL Instagram. [ Photo, Video or Reel...]" autofocus name="url" id="url" class="form-control" placeholder="" aria-describedby="helpId" required>
          <small id="helpId" class="text-danger">*Masukkan URL</small>
        </div>
        <button type="submit" name="" id="" class="btn btn-primary" btn-lg btn-block">Submit</button>
    </form>
<?php if(isset($_GET['url']) && !empty($_GET['url'])) : ?>
    <?php 
    $data = InstagramDownloader::Download($_GET['url']);
    // var_dump($data);
    ?>
    <div class="row mt-4 mb-4">
        <div class="container">
        <video id="video-id" poster="<?= $data['poster']; ?>"><source src="<?= $data['source']; ?>" type="video/mp4" />
        </div>
    </div>
    <div class="position-relative">
    <a name="" id="" class="btn btn-primary m-4" href="<?= $data['dl']; ?>" role="button">Download</a>
        <a name="" id="" class="btn btn-primary m-4" href="<?= $data['source']; ?>" role="button">Open New Tab</a>
    </div>
</div>
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script src="https://cdn.fluidplayer.com/v3/current/fluidplayer.min.js"></script>
<script>
    var myFP = fluidPlayer(
        'video-id',	{
	"layoutControls": {
		"controlBar": {
			"autoHideTimeout": 3,
			"animated": true,
			"autoHide": true
		},
		"htmlOnPauseBlock": {
			"html": null,
			"height": null,
			"width": null
		},
		"autoPlay": false,
		"mute": false,
		"allowTheatre": false,
		"playPauseAnimation": false,
		"playbackRateEnabled": false,
		"allowDownload": true,
		"playButtonShowing": true,
		"fillToContainer": true,
		"posterImage": ""
	},
	"vastOptions": {
		"adList": [],
		"adCTAText": false,
		"adCTATextPosition": ""
	}
    })
</script>
</body>
</html>
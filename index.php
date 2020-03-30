<?php
function get_CURL($url)
{
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($curl);
  curl_close($curl);
  
  return json_decode($result, true);
}

//MENGAMBIL API YOUTUBE
$IDKanalYT = 'UCjwGYOoNHTYzgwtih6oNBfQ';
$KODE_DAERAH = 'ID';

$YT_API_Identity_result = get_CURL("https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=$IDKanalYT+&key=AIzaSyCH1fWHEJwA4gGBZKwckOMHtXhOvMBzZto");
$YT_API_Videos_result = get_CURL("https://www.googleapis.com/youtube/v3/search?key=AIzaSyCH1fWHEJwA4gGBZKwckOMHtXhOvMBzZto&channelId=$IDKanalYT&maxResults=1&order=date&part=snippet");
$YT_API_Trending_Videos_results = get_CURL("https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&chart=mostPopular&regionCode=$KODE_DAERAH&key=AIzaSyCH1fWHEJwA4gGBZKwckOMHtXhOvMBzZto&maxResults=5");

//Data Identitas Channel dari YouTube yg dipakai
$YTChannelPic = $YT_API_Identity_result['items'][0]['snippet']['thumbnails']['medium']['url']; //Gambar Channel
$YTChannelName = $YT_API_Identity_result['items'][0]['snippet']['title']; //Nama Channel
$YTChannelVideos = $YT_API_Identity_result['items'][0]['statistics']['videoCount']; //Jumlah Video yg Diupload
$YTChannelSubscribers = $YT_API_Identity_result['items'][0]['statistics']['subscriberCount']; //Jumlah Subscribers (dibulatkan oleh YT sbg privasi)
$YTChannelViews = $YT_API_Identity_result['items'][0]['statistics']['viewCount']; //Jumlah Total Views Channel

//Data video terakhir yg diupload Channel YT
$YTLatestVideoID = $YT_API_Videos_result['items'][0]['id']['videoId'];

//5 Video Trending Indonesia
$YTVideoTrending1 = $YT_API_Trending_Videos_results['items'][0]['id'];
$YTVideoTrending2 = $YT_API_Trending_Videos_results['items'][1]['id'];

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Kanal Mas Adam dan Trending Youtube Indonesia</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container justify-content-center">
        <a class="navbar-brand" href="#home">Selamat Datang!</a>
      </div>
    </nav>


    <div class="jumbotron" id="home">
      <div class="container">
        <div class="text-center">
          <img src="img/profile1.png" class="rounded-circle img-thumbnail">
          <h1 class="display-4">Mas Adam</h1>
          <h3 class="lead">Learn | Design | Develop</h3>
        </div>
      </div>
    </div>


    <!-- About -->
    <section class="about" id="about">
      <div class="container">
        <div class="row mb-4">
          <div class="col text-center">
            <h2>About</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, molestiae sunt doloribus error ullam expedita cumque blanditiis quas vero, qui, consectetur modi possimus. Consequuntur optio ad quae possimus, debitis earum.</p>
          </div>
          <div class="col-md-5">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, molestiae sunt doloribus error ullam expedita cumque blanditiis quas vero, qui, consectetur modi possimus. Consequuntur optio ad quae possimus, debitis earum.</p>
          </div>
        </div>
      </div>
    </section>

    <!--Media Sosial YT & Instagram-->
    <section class="social bg-light" id="social">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Kanal Mas Adam</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
                <img src="<?= $YTChannelPic; ?>" width="200" alt="" class="rounded-circle img-thumbnail"> <!--ambil  Foto Profil Channel Terkini-->
              </div>
              <div class="col-md-8">
                <h5><?= $YTChannelName; ?></h5> <!--ambil  Nama Channel Terkini-->
                <p><?= $YTChannelSubscribers; ?> Berlangganan <!--ambil  Jumlah Subscriber Terkini-->
                <br><?= $YTChannelVideos; ?> Vidio Upload <!--ambil  Jumlah Video Upload Terkini-->
                <br><?= $YTChannelViews; ?> Tayangan <!--ambil  Jumlah Total Tayangan Terkini-->
                <div class="g-ytsubscribe" data-channelid="<?=$IDKanalYT?>" data-layout="default" data-count="default"></div> <!--Tombol SUbscription-->
                </p>
              </div>
            </div>
            <div class="row mt-3 pb-3">
              <div class="col">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $YTLatestVideoID; ?>?rel=0" allowfullscreen></iframe> <!--ambil  ID Video Terakhir upload-->
              </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <section class="social" id="about">
        <div class="container">
          <div class="row mb-4">
            <div class="col text-center">
              <h2>2 Video Terpopuler di YouTube Indonesia</h2>
            </div>
          </div>
          <div class="row md-8 mt-3 pb-3 justify-content-center" height="200px">
            <div class="col pl-8 pr-8">
              <div class="row mt-3 pb-3">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $YTVideoTrending1; ?>?rel=0" allowfullscreen></iframe> <!--ambil  ID Video Terakhir upload-->
                </div>
              </div>
            </div>
            <div class="col pl-8 pr-8">
              <div class="row mt-3 pb-3">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $YTVideoTrending2; ?>?rel=0" allowfullscreen></iframe> <!--ambil  ID Video Terakhir upload-->
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Copyright &copy; 2018.</p>
          </div>
        </div>
      </div>
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    
    <!--Script Tombol Subscription-->
    <script src="https://apis.google.com/js/platform.js"></script>

  </body>
</html>
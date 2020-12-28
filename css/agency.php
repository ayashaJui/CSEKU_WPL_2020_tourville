<?php
  header("Content-type: text/css");

  include '../includes/db.php';

  $agency_cover = '';
  if(isset($_GET['agency_id'])){
    $agency_id = $_GET['agency_id'];

    $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
    $stmt->execute([':agency_id'   => $agency_id]);
    $agency = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
?>

.agency {
  background-image: url("../images/<?php echo $agency['cover_image']; ?>");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  height: 50vh;
}
.agency-logo {
  position: relative;
  top: 160px;
}
.review-content,
.info-content {
  display: none;
}
.card {
  border-radius: 5px;
  background-color: #fff;
  padding-left: 60px;
  padding-right: 60px;
  margin-top: 30px;
  padding-top: 30px;
  padding-bottom: 30px;
}

.rating-box {
  width: 130px;
  height: 130px;
  margin-right: auto;
  margin-left: auto;
  background-color: #fbc02d;
  color: #fff;
}

.rating-label {
  font-weight: bold;
}

.rating-bar {
  width: 300px;
  padding: 8px;
  border-radius: 5px;
}
td {
  padding-bottom: 10px;
}

.star-active {
  color: #fbc02d;
}

.star-inactive {
  color: #cfd8dc;
}

.star-half{
  color: #fbc02d;
}

.star-active:hover,
.star-half:hover {
  color: #f9a825;
  cursor: pointer;
}

.content {
  font-size: 18px;
}

.profile-pic {
  width: 90px;
  height: 90px;
  border-radius: 100%;
  margin-right: 30px;
}

.status{
  background: #EAE8FF;
  font-size: .8rem;
  font-weight: 500;
  border: 2px solid #85998A;
}

.effect:hover{
  box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
  -webkit-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
  -moz-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
  transition: box-shadow 0.2s ease-in-out;
}

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

.star-active:hover {
  color: #f9a825;
  cursor: pointer;
}

.star-inactive {
  color: #cfd8dc;
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

<?php

    function getSingleImage($package_id){
        include 'db.php';
        //getting multiple image from database..
        $stmt = $pdo->prepare('SELECT place_images FROM packages WHERE package_id = :package_id');
        $stmt->execute([':package_id' => $package_id]);
        $img = $stmt->fetchColumn();
        //convert string to array
        $img = explode(',', $img);
        //replace the special character to space
        $search = ["(", "'", ")" ];
        $place_img = str_replace($search, '', $img[0]);

        return $place_img;
    }

    function readPackage($package_id){
        include 'db.php';
        
        //Package Name Read Query
        $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
        $stmt->execute([':package_id' => $package_id]);
        $package = $stmt->fetch(PDO::FETCH_ASSOC);

        return $package;
    }

    function readPackageDates($package_id){
        include 'db.php';
        //read package date data
        $stmt = $pdo->prepare('SELECT * FROM package_dates WHERE package_id = :package_id');
        $stmt->execute([':package_id'   => $package_id]);
        $date = $stmt->fetch(PDO::FETCH_ASSOC);

        return $date;
    }

    function readAgency($agency_id){
        include 'db.php';
        //read Specific agency data
        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id'   => $agency_id ]);
        $agency = $stmt->fetch(PDO::FETCH_ASSOC);

        return $agency;
    }

    function readTourist($tourist_id){
        include 'db.php';

        //read tourist name
        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id' => $tourist_id]);
        $tourist = $stmt->fetch(PDO::FETCH_ASSOC);

        return $tourist;
    }

?>
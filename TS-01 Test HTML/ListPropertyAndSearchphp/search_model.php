<?php


function fetchResult($pdo,$propName,$proptype,$minPrice,$maxPrice,$location) 
    {
        $sql = "SELECT * FROM property WHERE propName = :propName AND price >= :minPrice  AND propType = :propType AND price <= :maxPrice  AND location = :location";
        //  
        $stmt = $pdo->prepare($sql);
        $stmt->bindparam(":propName",$propName);
        $stmt->bindparam(":propType",$proptype);
        $stmt->bindparam(":maxPrice",$maxPrice);
        $stmt->bindparam(":minPrice",$minPrice);
        $stmt->bindparam(":location", $location);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $result;
    }
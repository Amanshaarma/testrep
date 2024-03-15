<?php


function fetchResult($pdo,$propName,$proptype,$minPrice,$maxPrice,$location,$userid) 
    {
        $sql = "SELECT * FROM property WHERE signup_id = $userid";

        if (!empty($propName)) {
            $sql .= " AND propName = :propName";
        }
        if (!empty($proptype)) {
            $sql .= " AND propType = :propType";
        }
        if (!empty($maxPrice)) {
            $sql .= " AND price <= :maxPrice";
        }
        if (!empty($minPrice)) {
            $sql .= " AND price >= :minPrice";
        }
        if (!empty($location)) {
            $sql .= " AND location = :location";
        }
        
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters if they exist
        if (!empty($propName)) {
            $stmt->bindParam(':propName', $propName);
        }
        if (!empty($proptype)) {
            $stmt->bindParam(':propType', $proptype);
        }
        if (!empty($maxPrice)) {
            $stmt->bindParam(':maxPrice', $maxPrice);
        }
        if (!empty($minPrice)) {
            $stmt->bindParam(':minPrice', $minPrice);
        }
        if (!empty($location)) {
            $stmt->bindParam(':location', $location);
        }
        
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $result;
    }
    // $sql = "SELECT * FROM property WHERE 1 ;";
    // //  propName = :propName  AND propType = :propType   
    // if(!empty($propName))
    // {
    //     $sql .= " AND propName = '$propName'";
    // }
    // if(!empty($proptype))
    // {
    //     $sql .= " AND propType = '$proptype'";
    // }
    // if(!empty($maxPrice))
    // {
    //     $sql .= "AND price <= $maxPrice";
    // }
    // if(!empty($minPrice))
    // {
    //     $sql .= "AND price >= $minPrice";
    // }
    // if(!empty($location))
    // {
    //     $sql .= "AND location = '$location'";
    // }
    
    // $stmt = $pdo->prepare($sql);
    // // $stmt->bindparam(":propName",$propName);
    // // $stmt->bindparam(":propType",$proptype);
    // // $stmt->bindparam(":maxPrice",$maxPrice);
    // // $stmt->bindparam(":minPrice",$minPrice);
    // // $stmt->bindparam(":location", $location);
    // $stmt->execute();
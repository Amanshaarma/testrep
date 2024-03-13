<?php

    function set_property($pdo,$propName,$price,$propType,$location,$description,$image,$signup_id)
    {
        $propName = inputTrim($propName);
        $price = inputTrim($price);
        $location = inputTrim($location);
        $description = inputTrim($description);
        $query = "INSERT INTO property(propName,price,propType,location,description,image,signup_id)
                VALUES(:propName,:price,:propType,:location,:description,:image,:signup_id);";   
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":propName",$propName); 
        $stmt->bindParam(":price",$price); 
        $stmt->bindParam(":propType",$propType); 
        $stmt->bindParam(":location",$location); 
        $stmt->bindParam(":description",$description); 
        $stmt->bindParam(":image",$image,PDO::PARAM_LOB);
        $stmt->bindParam(":signup_id",$signup_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;        
    }

    function inputTrim($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data =  htmlspecialchars($data);
        return $data;
    }
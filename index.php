<?php

    $customer_list = array(
        "0" => array("name" => "Mai Văn Hoàn", "day_of_birth" => "1983/08/20", "address" => "Hà Nội", "image" => "images/img1.jpg"),
        "1" => array("name" => "Nguyễn Văn Nam", "day_of_birth" => "1983/08/21", "address" => "Bắc Giang", "image" => "images/img2.jpg"),
        "2" => array("name" => "Nguyễn Thái Hòa", "day_of_birth" => "1983/08/22", "address" => "Nam Định", "image" => "images/img3.jpg"),
        "3" => array("name" => "Trần Đăng Khoa", "day_of_birth" => "1983/08/17", "address" => "Hà Tây", "image" => "images/img4.jpg"),
        "4" => array("name" => "Nguyễn Đình Thi", "day_of_birth" => "1983/08/19", "address" => "Hà Nội", "image" => "images/img5.jpg")
    );



    if ($_SERVER['REQUEST_METHOD']){

        $from_date = preg_replace('/-/','/',$_POST['from']);
        $to_date = preg_replace('/-/','/',$_POST['to']);

        $fillter =  searchByDate($customer_list,$from_date,$to_date);


    }
    function searchByDate($customers, $from_date, $to_date) {
        if(empty($from_date) && empty($to_date)){
            return $customers;
        }
        $filtered_customers = [];

        foreach($customers as $customer){
            if(!empty($from_date) && (strtotime($customer['day_of_birth']) < strtotime($from_date)))
                continue;
            if(!empty($to_date) && (strtotime($customer['day_of_birth']) > strtotime($to_date)))
                continue;
            $filtered_customers[] = $customer;
        }
        return $filtered_customers;
    }


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Title</title>
		<meta charset="UTF-8">
		<meta name=description content="">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
	<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form action="" method="post" role="form">
                	<legend>Search</legend>

                	<div class="form-group">
                		<label for="">From :</label>
                		<input type="date" class="form-control" name="from" id="" placeholder="yyyyy/mm/dd">
                        <label for="">To :</label>
                		<input type="date" class="form-control" name="to" id="" placeholder="yyyyy/mm/dd">
                	</div>

                	<button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Image</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($fillter)==0){?>
                        <tr>
                            <td colspan="5" class="message">Không tìm thấy khách hàng nào</td>
                        </tr>
                    <?php
                    }else{
                    foreach ($fillter as $key => $item) {
                    ?>
                        <tr>
                            <td><?=$key+1;?></td>
                            <td><?=$item['name'];?></td>
                            <td><?=$item['day_of_birth'];?></td>
                            <td><?=$item['address'];?></td>
                            <td><?=$item['image'];?></td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	</body>
</html>



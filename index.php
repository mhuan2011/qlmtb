<?php
    require_once ('database/dbhelper.php');

    $sql = "select * from thietbi";
    $ListItems = executeResult($sql);
    $avaiable = 0;
    $broken = 0;
    $repair = 0;
    $busy = 0;
    foreach ($ListItems as $items) {
        $status = $items['TINHTRANG'];
        switch($status) {
            case "Có sẵn":
                $avaiable++;
                break;
            case "Hỏng":
                $broken++;
                break;
            case "Bảo trì":
                $repair;
                break;
            case "Đang mượn":
                $busy++;
                break;
            default:
                break;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary"> 
  <a class="navbar-brand" href="#">THIẾT BỊ PTIT</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Bảng thiết bị <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Chức năng
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Thiết bị có sẵn</a>
          <a class="dropdown-item" href="#">Thiết bị đang mượn</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Lịch sử mượn</a>
        </div>
      </li>
 
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="tìm kiếm..." aria-label="Search">
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Tìm kiếm</button>
    </form>
  </div>
</nav>

    <!--  -->
    <div class="container "  >
    
    <p class="h1 text-center mb-4 mt-4">BẢNG THÔNG TIN THIẾT BỊ</p>
    <div class="container ">
        
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Mã thiết bi</th>
                <th scope="col">Tên thiêt bị</th>
                <th scope="col">Mã loại</th>
                <th scope="col">Ngày nhập kho</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Tình trạng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "select * from thietbi";
                    $productList = executeResult($sql);

                    
                    foreach($productList as $item) {
                        $status = "";
                        switch($item['TINHTRANG']){
                            case "Đang mượn":
                                $status = "warning";
                                break;
                            case "Có sẵn": 
                                $status = "success";
                                break;
                            case "Hỏng": 
                                $status = "danger";
                                break;
                            default:
                                break;
                        }

                        echo'
                            <tr>
                                <th scope="row">'.$item['MATB'].'</th>
                                <td>'.$item['TENTB'].'</td>
                                <td>'.$item['MALOAI'].'</td>
                                <td>'.$item['NGAYNHAPKHO'].'</td>
                                <td>'.$item['MOTA'].'</td>
                                <td>
                                    <!-- Trang thai cua thiet bi -->
                                    <span class="badge badge-'.$status.'">'.$item['TINHTRANG'].'</span>
                                </td>
                            </tr>
                        
                        ';
                    }

                ?>


                
                
            </tbody>
        </table>
        <div class="card mb-3 mt-4" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Tổng quan</h5>
                <hr>
                <div class="container">
                <button type="button" class="btn btn-warning  mb-2">
                        Đang mượn: <span class="badge badge-light"><?php echo $busy ?></span>
                        <span class="sr-only">unread messages</span>
                    </button>
                </div>
                <div class="container">
                    <button type="button" class="btn btn-success  mb-2">
                        Có sẵn: <span class="badge badge-light"><?php echo $avaiable ?></span>
                        <span class="sr-only">unread messages</span>
                    </button>
                </div>
                <div class="container">
                <button type="button" class="btn btn-danger mb-2">
                        Hư hỏng: <span class="badge badge-light"><?php echo $broken ?></span>
                        <span class="sr-only">unread messages</span>
                    </button>
                </div>
                <div class="container">
                    <button type="button" class="btn btn-primary  mb-2">
                        Bảo trì: <span class="badge badge-light"><?php echo $repair ?></span>
                        <span class="sr-only">unread messages</span>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
        <div class="card text-center">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <h5 class="card-title">PTIT-HCM</h5>
                <p class="card-text">Nhập môn công nghệ phần mềm</p>
                <a href="#" class="btn btn-primary">Minh Huấn</a>
            </div>
        <div class="card-footer text-muted">
    
  </div>
</div>
</body>
</html>
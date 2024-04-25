<?php
    $host = "localhost";
    $user = "root";
    $pass = "root";
    $db = "t2311e_php";

    $conn = new mysqli($host,$user,$pass,$db);
    if($conn->connect_error){
        die("Connect Database Failed");
    }

    $limit = isset($_GET["limit"]) && $_GET["limit"]!= "" ?$_GET["limit"]:20;
    $search = isset($_GET["search"])?$_GET["search"]:"";

    $sql = "SELECT * FROM categories WHERE name like '%$search%' LIMIT $limit";
    $result = $conn->query($sql);
    $list =[];
    while($row = $result->fetch_assoc()){
      $list[]=$row;
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <form>
      <div class="row">
        <div class="col">
          <input value="<?php echo $search; ?>" name="search" placeholder="Search" type="text" class="form-control"/>
        </div>
        <div class="col">
          <input value="<?php echo $limit; ?> name="limit" placeholder="Limit" type="number" class="form-control"/>
        </div>
        <div class="col">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
    </div>

    <div class="container">
        <a href="/create_category.php">Create new Category</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($list as $item):?>
                    <tr>
                        <th scope="row"><?php echo $item["id"];?></th>
                        <td><?php echo $item["name"];?></td>
                        <td><a href="/edit_category.php?id=<?php echo $item["id"];?>">Edit</a></td>
                        <td><a class="text-danger" onclick="return confirm('Are u sure want to delete this category ?')"
                        href="/delete_category.php?id=<?php echo $item["id"];?>">Delete</a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>
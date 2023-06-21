<?php
$pageTitle = 'Lands';
include('includes/header.php');
$page = $_GET['page'] ??  1;
$limit = $_GET['limit'] ??  6;
$latest = mysqli_query($link, 'SELECT * FROM lands ORDER BY id DESC LIMIT 3');
$properties = mysqli_query($link, 'SELECT * FROM lands ORDER BY id DESC LIMIT ' . $limit . ' OFFSET ' . $limit * ($page - 1));
$totalProp = count(mysqli_query($link, 'SELECT * FROM lands')->fetch_all());
?>
<section id="latestProp" class="propSect">
  <?php
  // $trending = [
  //   [
  //     'availability' => 'Available Now',
  //     'images' => [
  //       $assets . 'images/properties/prop.png',
  //       $assets . 'images/properties/prop2.png',
  //       $assets . 'images/properties/prop3.png',
  //     ],
  //     'price' => 20000000,
  //     'name' => '300SQM There are many variations of passages of Lorem',
  //     'location' => 'Lagos',
  //     'size' => 300,
  //   ],
  //   [
  //     'availability' => 'Available Now',
  //     'images' => [
  //       $assets . 'images/properties/prop.png',
  //       $assets . 'images/properties/prop2.png',
  //       $assets . 'images/properties/prop3.png',
  //     ],
  //     'price' => 20000000,
  //     'name' => '300SQM There are many variations of passages of Lorem',
  //     'location' => 'Lagos',
  //     'size' => 300,
  //   ],
  //   [
  //     'availability' => 'Available Now',
  //     'images' => [
  //       $assets . 'images/properties/prop.png',
  //       $assets . 'images/properties/prop2.png',
  //       $assets . 'images/properties/prop3.png',
  //     ],
  //     'price' => 20000000,
  //     'name' => '300SQM There are many variations of passages of Lorem',
  //     'location' => 'Lagos',
  //     'size' => 300,
  //   ],
  // ];
  ?>
  <div class="bodyCont">
    <h2>Latest Properties</h2>
    <div class="bodyPart">
      <div class="gridCont">
        <?php foreach ($latest as $i => $prop) { ?>
          <div class="gridItem">
            <?php include('includes/eachProp.php'); ?>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
<section id="popularProp" class="propSect">
  <?php
  // $popular = [
  //   [
  //     'availability' => 'Available Now',
  //     'images' => [
  //       $assets . 'images/properties/prop.png',
  //       $assets . 'images/properties/prop2.png',
  //       $assets . 'images/properties/prop3.png',
  //     ],
  //     'price' => 20000000,
  //     'name' => '300SQM There are many variations of passages of Lorem',
  //     'location' => 'Lagos',
  //     'size' => 300,
  //   ],
  //   [
  //     'availability' => 'Available Now',
  //     'images' => [
  //       $assets . 'images/properties/prop.png',
  //       $assets . 'images/properties/prop2.png',
  //       $assets . 'images/properties/prop3.png',
  //     ],
  //     'price' => 20000000,
  //     'name' => '300SQM There are many variations of passages of Lorem',
  //     'location' => 'Lagos',
  //     'size' => 300,
  //   ],
  //   [
  //     'availability' => 'Available Now',
  //     'images' => [
  //       $assets . 'images/properties/prop.png',
  //       $assets . 'images/properties/prop2.png',
  //       $assets . 'images/properties/prop3.png',
  //     ],
  //     'price' => 20000000,
  //     'name' => '300SQM There are many variations of passages of Lorem',
  //     'location' => 'Lagos',
  //     'size' => 300,
  //   ],
  //   [
  //     'availability' => 'Available Now',
  //     'images' => [
  //       $assets . 'images/properties/prop.png',
  //       $assets . 'images/properties/prop2.png',
  //       $assets . 'images/properties/prop3.png',
  //     ],
  //     'price' => 20000000,
  //     'name' => '300SQM There are many variations of passages of Lorem',
  //     'location' => 'Lagos',
  //     'size' => 300,
  //   ],
  //   [
  //     'availability' => 'Available Now',
  //     'images' => [
  //       $assets . 'images/properties/prop.png',
  //       $assets . 'images/properties/prop2.png',
  //       $assets . 'images/properties/prop3.png',
  //     ],
  //     'price' => 20000000,
  //     'name' => '300SQM There are many variations of passages of Lorem',
  //     'location' => 'Lagos',
  //     'size' => 300,
  //   ],
  //   [
  //     'availability' => 'Available Now',
  //     'images' => [
  //       $assets . 'images/properties/prop.png',
  //       $assets . 'images/properties/prop2.png',
  //       $assets . 'images/properties/prop3.png',
  //     ],
  //     'price' => 20000000,
  //     'name' => '300SQM There are many variations of passages of Lorem',
  //     'location' => 'Lagos',
  //     'size' => 300,
  //   ],
  // ];
  ?>
  <div class="bodyCont">
    <h2>Our Properties</h2>
    <div class="bodyPart">
      <div class="gridCont">
        <?php foreach ($properties as $i => $prop) { ?>
          <div class="gridItem">
            <?php include('includes/eachProp.php'); ?>
          </div>
        <?php } ?>
      </div>
      <div class="cusPagination">
        <span>Page</span>
        <input type="number" value="<?= $page ?>" class="page">
        <span>of</span>
        <span class="total"><?= ceil($totalProp / $limit) ?></span>
        <?php if ($page > 1) { ?>
          <a href="<?= $baseUrl ?>lands.php?limit=<?= $limit ?>&page=<?= $page - 1 ?>" class="prev"><i class="fa fa-angle-left"></i></a>
        <?php } else { ?>
          <a href="javascript:void(0)" class="prev"><i class="fa fa-angle-left"></i></a>
        <?php } ?>
        <?php if ($page < ceil($totalProp / $limit)) { ?>
          <a href="<?= $baseUrl ?>lands.php?limit=<?= $limit ?>&page=<?= $page + 1 ?>" class="prev"><i class="fa fa-angle-right"></i></a>
        <?php } else { ?>
          <a href="javascript:void(0)" class="prev"><i class="fa fa-angle-right"></i></a>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
<?php
include('includes/anyQuest.php');
include('includes/footer.php');
?>
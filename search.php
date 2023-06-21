<?php
$pageTitle = 'Search';
include('includes/header.php');
$page = $_GET['page'] ??  1;
$limit = $_GET['limit'] ?? 6;
$location = $_GET['location'] ?? '';
$minP = $_GET['minPrice'];
$maxP = $_GET['maxPrice'];
$minSz = $_GET['minSize'];
$maxSz = $_GET['maxSize'];
$query = "SELECT * FROM lands WHERE " . ($location ? ("location = '" . $location . "' AND ") : '') . "price BETWEEN " . $minP . " AND " . $maxP . " AND size BETWEEN " . $minSz . " AND " . $maxSz . " ORDER BY id LIMIT " . $limit . ' OFFSET ' . $limit * ($page - 1);
$searchResult = mysqli_query($link, $query);
$totalProp = count(mysqli_query($link, "SELECT * FROM lands WHERE " . ($location ? ("location = '" . $location . "' AND ") : '') . "price BETWEEN " . $minP . " AND " . $maxP . " AND size BETWEEN " . $minSz . " AND " . $maxSz . " ORDER BY id")->fetch_all());
// echo (json_encode((object) $searchResult->));
// echo (json_encode($totalProp));
?>
<main id="searchPage">
  <section id="searchParent">
    <div class="bodyCont">
      <h1>Find a <span class="priCol">Property</span></h1>
      <?php include('includes/search.php'); ?>
    </div>
  </section>
  <section id="searchResParent">
    <?php
    // $result = [
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
      <div class="resultCont">
        <?php if ($totalProp) { ?>
          <div class="gridCont">
            <?php foreach ($searchResult as $i => $prop) { ?>
              <div class="gridItem">
                <?php include('includes/eachProp.php'); ?>
              </div>
            <?php } ?>
          </div>
          <?php if ($page < ceil($totalProp/$limit)) { ?>
            <div class="btnCont">
              <script>
                document.write(`<a href="${location.href.includes('&limit=') ? location.href.replace(/&limit=\d+&page=\d+/, '&limit=<?= json_encode($limit * ($page + 1)) ?>&page=<?= json_encode($page) ?>') : `${location.href}&limit=<?= json_encode($limit * ($page + 1)) ?>&page=<?= json_encode($page) ?>`}" class="primBtn">See More</a>`);
              </script>
              <!-- <a href="" class="primBtn">See More</a> -->
            </div>
          <?php } ?>
        <?php } else {
          include('includes/noResult.php');
        }
        ?>
      </div>
    </div>
  </section>
</main>
<?php include('includes/footer.php'); ?>
 <!doctype html>
 <html lang="en">


 <head>
     <?php
        if (!session()->get('isLogin'))
            redirect()->to('/');
        ?>



     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- style.css -->
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="stylesheet" href="<?= base_url(); ?>/css/<?= $css; ?>.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/css/main.css">
     <link rel="stylesheet" href="<?= base_url() . 'https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css' ?>">
     <link rel="stylesheet" href="<?= base_url() . 'https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' ?>">
     <link rel="stylesheet" href="<?= base_url() . 'https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.min.css' ?>">
     <link rel="stylesheet" href="<?= base_url() . 'https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css' ?>">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
     <script src="http://code.jquery.com/jquery-3.5.1.js"></script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
     <script src="http://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
     <title><?= $title; ?></title>

 </head>


 <body>



     <?= $this->include('layout/navbar'); ?>
     <?= $this->include('layout/sidebar'); ?>

     <?= $this->renderSection('content'); ?>


     <!-- Optional JavaScript; choose one of the two! -->

     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

     <!-- Option 2: Separate Popper and Bootstrap JS -->
     <!--
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   -->
 </body>

 </html>
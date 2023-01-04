 <!-- Bagian Show Tabel -->
 <div class="table-responsive">
     <table class="table table-striped" id="datauser">
         <thead>
             <tr>
                 <th scope="col">No</th>
                 <th scope="col">Nama</th>
                 <th scope="col">Username</th>
                 <th scope="col">Password</th>
                 <th scope="col">Nomor HP</th>
                 <th scope="col">Level</th>
                 <th scope="col">Info</th>
             </tr>
         </thead>
         <tbody>
             <?php $i = 1 + (10 * (1 - 1)); ?>

             <?php foreach ($tampildata as $u) : ?>
                 <tr>
                     <?php
                        if ($u['level'] == 'admin') {
                            $level = "Admin";
                        }
                        if ($u['level'] == 'pegawai') {
                            $level = "Pegawai";
                        }
                        if ($u['level'] == 'klien') {
                            $level = "Klien";
                        }
                        ?>
                     <th scope="row"><?= $i++; ?></th>
                     <td><?= $u['nama']; ?></td>
                     <td><?= $u['username']; ?></td>
                     <td><?= $u['password']; ?></td>
                     <td><?= $u['notelp']; ?></td>
                     <td><?= $level; ?></td>
                     <td width="9%">
                         <button type="button" class="btn btn-primary btn-sm" title="Edit" onclick="edit('<?= $u['id']; ?>')">
                             <i class="fa fa-edit"></i></button>


                         <?php if ($u['level'] != 'admin') : ?>
                             <button type="button" class="btn btn-danger btn-sm" title="Hapus" onclick="hapus('<?= $u['id']; ?>')">
                                 <i class="fa fa-trash"></i></button>
                         <?php endif; ?>
                     </td>

                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>
 <!-- End Tabel -->
 <script>
     $(document).ready(function() {
         $('#datauser').DataTable({
             ordering: true,
             language: {
                 searchPlaceholder: "Cari User ..."
             },
             //  rowReorder: {
             //      selector: 'td:nth-child(2)'
             //  },
             //  responsive: true
             // info: false
         })
     });

     function edit(id) {
         $.ajax({
             type: 'post',
             url: '<?= site_url('users/formedit') ?>',
             data: {
                 id: id
             },
             dataType: 'json',
             success: function(response) {
                 if (response.sukses) {
                     $('.modaledit').html(response.sukses).show();
                     $('#modaledit').modal('show');
                 }
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
             }
         });
     }

     function hapus(id) {
         Swal.fire({
             title: 'Hapus',
             text: "Yakin menghapus data ini ?",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Hapus',
             cancelButtonText: 'Batal',
         }).then((result) => {
             if (result.isConfirmed) {
                 $.ajax({
                     type: 'post',
                     url: '<?= site_url('users/delete') ?>',
                     data: {
                         id: id
                     },
                     dataType: 'json',
                     success: function(response) {
                         if (response.sukses) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Berhasil dihapus',
                                 text: response.sukses,
                             });
                             datauser();
                         }
                     },
                     error: function(xhr, ajaxOptions, thrownError) {
                         alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                     }
                 });
             }
         })
     }
 </script>
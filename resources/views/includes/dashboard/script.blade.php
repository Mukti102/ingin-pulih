 <!--   Core JS Files   -->
 <script src="/assets/js/core/jquery-3.7.1.min.js"></script>
 <script src="/assets/js/core/popper.min.js"></script>
 <script src="/assets/js/core/bootstrap.min.js"></script>

 <!-- jQuery Scrollbar -->
 <script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

 <!-- jQuery Sparkline -->
 <script src="/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

 <!-- Datatables -->
 <script src="/assets/js/plugin/datatables/datatables.min.js"></script>

 <!-- Bootstrap Notify -->
 {{-- <script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> --}}

 <!-- jQuery Vector Maps -->
 <script src="/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
 <script src="/assets/js/plugin/jsvectormap/world.js"></script>

 <!-- Sweet Alert -->
 <script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <!-- Kaiadmin JS -->
 <script src="/assets/js/kaiadmin.min.js"></script>


 {{-- chart --}}
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


 <!-- Kaiadmin DEMO methods, don't include it in your project! -->
 <script src="/assets/js/setting-demo.js"></script>
 <script src="/assets/js/demo.js"></script>
 <script>
     $(document).ready(function() {
         $("#basic-datatables").DataTable({});
     });
 </script>

 <script>
     document.addEventListener('DOMContentLoaded', function() {

         document.querySelectorAll('.form-delete').forEach(function(form) {

             form.addEventListener('submit', function(e) {
                 e.preventDefault();

                 Swal.fire({
                     title: 'Yakin ingin menghapus?',
                     text: "Data tidak bisa dikembalikan!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#d33',
                     cancelButtonColor: '#6c757d',
                     confirmButtonText: 'Ya, hapus!',
                     cancelButtonText: 'Batal'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         form.submit();
                     }
                 });

             });

         });

     });
 </script>

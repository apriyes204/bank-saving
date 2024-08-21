    <!-- Bootstrap core JavaScript-->
    <script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{url('assets/vendor/chart.js/Chart.min.js')}}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script>
        function autoHideAlert(id, delay) {
            var alertElement = document.getElementById(id);
            if (alertElement) {
                // Menambahkan kelas 'show' untuk menampilkan alert dengan animasi
                alertElement.classList.add('show');
    
                // Menghapus alert setelah delay
                setTimeout(function () {
                    alertElement.classList.remove('show'); // Menghilangkan alert dengan animasi
                    alertElement.classList.add('hide'); // Menambahkan kelas hide
    
                    // Menghapus elemen dari DOM setelah transisi selesai
                    setTimeout(function () {
                        alertElement.remove();
                    }, 500); // Durasi transition sesuai dengan CSS
                }, delay);
            }
        }
    
        // Memanggil fungsi dengan id dan durasi
        autoHideAlert('success-alert', 30000); // 1800ms = 1.8 detik
        autoHideAlert('error-alert', 30000); // 1800ms = 1.8 detik
    </script>
    
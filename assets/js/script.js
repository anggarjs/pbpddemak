// Membuat checklist
document.addEventListener("DOMContentLoaded", function () {
      // Daftar elemen checkbox "checklist all" dan checkbox data
      var checkboxGroups = [
        { checklistAll: document.getElementById("checklist-user"), checkboxes: document.querySelectorAll('input[name="check[]"]') },
      ];
      // end checklist
    
      // Tambahkan event listener untuk setiap grup checkbox
      checkboxGroups.forEach(function (group) {
        group.checklistAll.addEventListener("change", function () {
          // Set status checkbox data berdasarkan status checkbox "checklist all"
          group.checkboxes.forEach(function (checkbox) {
            checkbox.checked = group.checklistAll.checked;
          });
        });
      });
    });

    // sweetalert hapus
document.addEventListener('DOMContentLoaded', function() {
  // Daftar tombol hapus
  var deleteButtons = document.querySelectorAll('.hapus-data-surat');

  // Tambahkan event listener untuk setiap tombol hapus
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault(); // Mencegah aksi default dari tombol hapus

      // Tampilkan SweetAlert konfirmasi
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Arahkan ke URL penghapusan data
          button.closest('form').submit();
        }
      });
    });
  });
});
// end sweetalert hapus

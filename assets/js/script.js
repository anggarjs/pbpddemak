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
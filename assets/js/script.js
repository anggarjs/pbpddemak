// Membuat checklist
document.addEventListener("DOMContentLoaded", function () {
      // Daftar elemen checkbox "checklist all" dan checkbox data
      var checkboxGroups = [
        { checklistAll: document.getElementById("checklist-all-surat"), checkboxes: document.querySelectorAll('input[name="check[]"]') },
        { checklistAll: document.getElementById("checklist-all-survey"), checkboxes: document.querySelectorAll('input[name="checkSurvey[]"]') },
        { checklistAll: document.getElementById("checklist-all-rab"), checkboxes: document.querySelectorAll('input[name="checkRab[]"]') },
        { checklistAll: document.getElementById("checklist-all-konfirmasi"), checkboxes: document.querySelectorAll('input[name="checkKonfirmasi[]"]') },
        { checklistAll: document.getElementById("checklist-all-mom"), checkboxes: document.querySelectorAll('input[name="checkMom[]"]') },
        { checklistAll: document.getElementById("checklist-all-amsup3"), checkboxes: document.querySelectorAll('input[name="checkAmsup3[]"]') }
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
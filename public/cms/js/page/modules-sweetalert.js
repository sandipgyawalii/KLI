"use strict";

$("#swal-6").click(function (e) {
  e.preventDefault(); 

  // Show the SweetAlert dialog
  swal({
    title: 'Are you sure?',
    text: 'Once deleted, you will not be able to recover this !',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      // If the user confirms, submit the form
      $(this).closest('form').submit();
    } else {
      swal('Your data was not deleted!');
    }
  });
});


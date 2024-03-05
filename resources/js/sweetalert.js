function deleteData(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This user's data will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete!',
    }).then((result) => {
        if (result.value) {
            // Submit the form using JavaScript
            document.getElementById(`delete ${id}`).submit();
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Form validation for registration and login forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            let valid = true;
            const inputs = form.querySelectorAll('input[required], textarea[required]');
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    valid = false;
                    input.classList.add('error');
                    input.nextElementSibling.textContent = 'This field is required';
                } else {
                    input.classList.remove('error');
                    input.nextElementSibling.textContent = '';
                }
            });
            if (!valid) {
                event.preventDefault();
            }
        });
    });

    // Add book functionality
    const addBookForm = document.querySelector('#addBookForm');
    if (addBookForm) {
        addBookForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(addBookForm);
            fetch('add_book.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                if (data.includes('successfully')) {
                    alert('Book added successfully');
                    addBookForm.reset();
                } else {
                    alert('Error adding book');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Edit book functionality
    const editBookForm = document.querySelector('#editBookForm');
    if (editBookForm) {
        editBookForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(editBookForm);
            fetch('edit_book.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                if (data.includes('successfully')) {
                    alert('Book updated successfully');
                } else {
                    alert('Error updating book');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Delete book functionality
    const deleteButtons = document.querySelectorAll('.delete-book');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this book?')) {
                const bookId = button.getAttribute('data-id');
                fetch(`delete_book.php?id=${bookId}`, {
                    method: 'GET'
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    if (data.includes('successfully')) {
                        alert('Book deleted successfully');
                        button.closest('tr').remove();
                    } else {
                        alert('Error deleting book');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});

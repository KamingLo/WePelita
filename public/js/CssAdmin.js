document.addEventListener('DOMContentLoaded', function() {
    const lampiranInput = document.getElementById('lampiran');
    const previewContainer = document.getElementById('foto-preview-container');
    const previewImage = document.getElementById('foto-preview');
    const fileNameDisplay = document.getElementById('file-name');
    const formLeft = document.querySelector('.form-left');
    const formRight = document.querySelector('.form-right');
    const LayoutNewPost = document.querySelector('.LayoutNewPost');
    const closePreviewBtn = document.getElementById('close-preview');

    function showPreview(file) {
        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                previewImage.src = this.result;
                previewImage.style.display = 'block';
                previewContainer.classList.add('has-preview');

                if (fileNameDisplay) {
                    fileNameDisplay.textContent = file.name;
                    fileNameDisplay.style.display = 'block';
                }

                formLeft.classList.add('preview-active');
                formRight.classList.add('preview-active');
                LayoutNewPost.classList.add('preview-active');
            });

            reader.readAsDataURL(file);
        }
    }

    function hidePreview() {
        previewImage.style.display = 'none';
        previewContainer.classList.remove('has-preview');

        if (fileNameDisplay) {
            fileNameDisplay.style.display = 'none';
        }

        formLeft.classList.remove('preview-active');
        formRight.classList.remove('preview-active');
        LayoutNewPost.classList.remove('preview-active');

        lampiranInput.value = '';
    }

    lampiranInput.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            showPreview(file);
        } else {
            hidePreview();
        }
    });

    if (closePreviewBtn) {
        closePreviewBtn.addEventListener('click', function(e) {
            e.preventDefault();
            hidePreview();
        });
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('lampiran');
    const fileNameDisplay = document.getElementById('FileNamaFoto');
    const preview = {
        container: document.getElementById('PreviewLayoutFoto'),
        image: document.getElementById('PreviewFoto'),
        name: document.getElementById('NamaFileFoto')
    };
    const forms = {
        left: document.querySelector('.FormKiri'),
        right: document.querySelector('.FormKanan'),
        layout: document.querySelector('.LayoutNewPost')
    };
    const closeBtn = document.getElementById('MenutupPreview');

    const togglePreview = (show, file) => {
        preview.image.style.display = show ? 'block' : 'none';
        preview.name.style.display = show ? 'block' : 'none';
        preview.container.classList.toggle('has-preview', show);
        
        [forms.left, forms.right, forms.layout].forEach(el => 
            el.classList.toggle('preview-active', show));
        
        if (show) {
            const reader = new FileReader();
            reader.onload = e => preview.image.src = e.target.result;
            reader.readAsDataURL(file);
            preview.name.textContent = file.name;
            
            if (fileNameDisplay) {
                fileNameDisplay.textContent = 'File dipilih: ' + file.name;
            }
        } else {
            preview.image.src = '';
            preview.name.textContent = '';
            fileInput.value = '';
            
            if (fileNameDisplay) {
                fileNameDisplay.textContent = 'Pilih file';
            }
        }
    };

    fileInput.addEventListener('change', () => 
        fileInput.files[0] 
            ? togglePreview(true, fileInput.files[0]) 
            : togglePreview(false));
    
    closeBtn?.addEventListener('click', e => {
        e.preventDefault();
        togglePreview(false);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('UserUntuk');
    const muridFields = document.getElementById('FormUntukMurid');
    const guruFields = document.getElementById('FormUntukGuru');
    const TanggalLahir = document.getElementById("tanggal_lahir");
    const TanggalLahirOrtu = document.getElementById("ortu_tanggal_lahir");

    // Validasi Tanggal Lahir: Tahun gak boleh lebih dari 4 digit
    function validateYear(input) {
        input.addEventListener("change", function () {
            const dateValue = this.value;
            const year = dateValue.split("-")[0];
            if (year.length > 4) {
                alert("Tahun tidak boleh lebih dari 4 digit, bre!");
                this.value = "";
            }
        });
    }

    if (TanggalLahir) validateYear(TanggalLahir);
    if (TanggalLahirOrtu) validateYear(TanggalLahirOrtu);

    // Toggling form berdasarkan role
    function toggleFields() {
        const selectedRole = roleSelect.value;
        muridFields.style.display = selectedRole === 'murid' ? 'block' : 'none';
        guruFields.style.display = selectedRole === 'guru' ? 'block' : 'none';
    }

    toggleFields();
    roleSelect.addEventListener('change', toggleFields);

    // Biar input nomor cuma boleh angka dan diawali optional +
    document.querySelectorAll(".NomorOnly").forEach(function (input) {
        input.addEventListener("input", function () {
            let value = this.value;

            // Boleh diawali +, sisanya harus angka
            if (value.startsWith("+")) {
                value = "+" + value.substring(1).replace(/[^0-9]/g, "");
            } else {
                value = value.replace(/[^0-9]/g, "");
            }

            this.value = value;
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {

    function setupClearButton(inputId, buttonId) {
        const input = document.getElementById(inputId);
        const clearBtn = document.getElementById(buttonId);
        
        if (!input || !clearBtn) {
            return;
        }
        
        function toggleClearButton() {
            if (input.value.trim() !== "") {
                clearBtn.style.display = "inline-block";
            } else {
                clearBtn.style.display = "none";
            }
        }

        input.addEventListener("input", toggleClearButton);

        clearBtn.addEventListener("click", function () {
            input.value = "";
            toggleClearButton();
            input.focus();
        });

        toggleClearButton();
    }

        
    // Main user fields
    setupClearButton("name", "clearName");
    setupClearButton("email", "clearEmail");
    setupClearButton("alamat", "clearAlamat");
    setupClearButton("jenis_kelamin", "clearJenisKelamin");
    setupClearButton("tanggal_lahir", "clearTanggalLahir");
    setupClearButton("tempat_lahir", "clearTempatLahir");
    setupClearButton("pendidikan", "clearPendidikan");
    setupClearButton("no_telp", "clearNoTelp");
    setupClearButton("password", "clearPassword");
    setupClearButton("UserUntuk", "clearRole");
    
    // Student fields
    setupClearButton("asal_sekolah", "clearAsalSekolah");
    setupClearButton("nis", "clearNis");
    setupClearButton("nisn", "clearNisn");
    setupClearButton("kelas_id", "clearKelasId");
    
    // Parent fields
    setupClearButton("ortu_name", "clearOrtuName");
    setupClearButton("ortu_email", "clearOrtuEmail");
    setupClearButton("ortu_alamat", "clearOrtuAlamat");
    setupClearButton("ortu_jenis_kelamin", "clearOrtuJenisKelamin");
    setupClearButton("ortu_tempat_lahir", "clearOrtuTempatLahir");
    setupClearButton("ortu_tanggal_lahir", "clearOrtuTanggalLahir");
    setupClearButton("ortu_profesi", "clearOrtuProfesi");
    setupClearButton("ortu_pendidikan", "clearOrtuPendidikan");
    setupClearButton("ortu_no_telp", "clearOrtuNoTelp");
    setupClearButton("ortu_password", "clearOrtuPassword");
    
    // Teacher fields
    setupClearButton("gelar", "clearGelar");
    setupClearButton("nuptk", "clearNuptk");
    setupClearButton("statusMenikah", "clearStatusMenikah");
    setupClearButton("statusKerja", "clearStatusKerja");

    // Tambah Pelajaran
    setupClearButton("namaPelajaran", "clearNamaPelajaran");

    // Manajemen Kelas
    setupClearButton("nama_kelas", "clearNamaKelas");

});


// File: public/js/post-management.js

document.addEventListener('DOMContentLoaded', function() {
    // Handle file input for post form
    const handleFileInputs = () => {
        const inputFile = document.getElementById('lampiran');
        if (!inputFile) return;
        
        const fileNameDisplay = document.getElementById('FileNamaFoto');
        const browseButton = document.querySelector('.BrowseFoto');
        
        // Trigger file input when browse button is clicked
        if (browseButton) {
            browseButton.addEventListener('click', function() {
                inputFile.click();
            });
        }
        
        // Update file name display when file is selected
        inputFile.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                if (fileNameDisplay) {
                    fileNameDisplay.textContent = fileName;
                }
                
                // The preview functionality is handled by Livewire in post-form.blade.php
            }
        });
    };
    
    // Handle success messages
    const handleSuccessMessages = () => {
        const successMessages = document.querySelectorAll('.alert-success, .PsnBerhasil');
        
        successMessages.forEach(message => {
            // Auto-hide success messages after 3 seconds
            setTimeout(() => {
                message.style.opacity = '0';
                message.style.transition = 'opacity 0.5s ease-out';
                
                setTimeout(() => {
                    message.style.display = 'none';
                }, 500);
            }, 3000);
        });
    };
    
    // Handle post preview hover effects
    const handlePostPreviews = () => {
        const postPreviews = document.querySelectorAll('.mini-post-preview');
        
        postPreviews.forEach(preview => {
            preview.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 8px 15px rgba(0,0,0,0.1)';
            });
            
            preview.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
            });
        });
    };
    
    // Handle delete confirmation with improved UI
    const handleDeleteConfirmations = () => {
        const deleteButtons = document.querySelectorAll('.btn-danger[onclick*="confirm"]');
        
        deleteButtons.forEach(button => {
            button.removeAttribute('onclick');
            
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const form = this.closest('form');
                const postType = form.action.includes('pengumuman') ? 'pengumuman' : 'kegiatan';
                const postTitle = this.closest('.mini-post-preview').querySelector('.mini-post-title').textContent;
                
                if (confirm(`Yakin ingin menghapus ${postType} "${postTitle}"?`)) {
                    form.submit();
                }
            });
        });
    };
    
    // Initialize all handlers
    handleFileInputs();
    handleSuccessMessages();
    handlePostPreviews();
    handleDeleteConfirmations();
    
    // Re-initialize handlers after Livewire updates
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', (message, component) => {
            handleFileInputs();
            handleSuccessMessages();
            handlePostPreviews();
            handleDeleteConfirmations();
        });
    });
});